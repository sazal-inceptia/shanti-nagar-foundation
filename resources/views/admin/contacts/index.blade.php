@extends('admin.app')
@section('title')
    Contact Inquiries &amp; Messages
@endsection

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Contact Inquiries &amp; Messages</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Contact Inquiries</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    {{-- Filter Bar --}}
                    <div class="card-body border-bottom" style="background-color: #f8fafc; padding: 14px 20px;">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-2 col-sm-4">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Inquiry Status</label>
                                <select id="filter_status" class="form-select form-select-sm custom-input" style="height: 32px; font-size: 13px;">
                                    <option value="">All Inquiries</option>
                                    <option value="unread">Unread</option>
                                    <option value="read">Read</option>
                                </select>
                            </div>
                            <div class="col-auto d-flex align-items-end">
                                <button type="button" id="reset_filters" class="btn btn-sm btn-outline-secondary"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Reset Filters"
                                    style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; font-size: 15px;">
                                    <i class="ri-refresh-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Data Table Body --}}
                    <div class="card-body table-body">
                        <div class="table-responsive">
                            <table class="table dataTable table-hover align-middle w-100" id="contacts-table" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th style="width: 45px;">SL</th>
                                        <th style="min-width: 180px;">Sender</th>
                                        <th style="min-width: 160px;">Email</th>
                                        <th style="min-width: 250px;">Subject &amp; Message</th>
                                        <th style="width: 100px;">Status</th>
                                        <th style="width: 130px;">Received At</th>
                                        <th style="width: 110px; text-align: center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- View Contact Message Modal --}}
    <div class="modal fade" id="viewContactModal" tabindex="-1" aria-labelledby="viewContactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(11, 15, 23, 0.1);">
                <div class="modal-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 16px 22px;">
                    <div class="d-flex align-items-center gap-2">
                        <div class="d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; border-radius: 8px; background-color: #e8f1f8; color: #005daa; font-size: 18px;">
                            <i class="ri-mail-open-line"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-dark mb-0" id="viewContactModalLabel" style="font-size: 16px;">
                                Contact Inquiry Details
                            </h5>
                            <span class="text-muted" style="font-size: 12px;">Auto-marked as Read</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 24px;">
                    {{-- Sender Info Header Row --}}
                    <div class="row g-3 p-3 rounded mb-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Sender Name</span>
                            <strong class="text-dark" id="modal_sender_name" style="font-size: 14.5px;">-</strong>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Received At</span>
                            <span class="text-dark fw-semibold" id="modal_received_at" style="font-size: 13.5px;">-</span>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Email Address</span>
                            <a href="#" id="modal_sender_email_link" class="text-primary text-decoration-none fw-semibold" style="font-size: 13.5px;">-</a>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Phone Number</span>
                            <a href="#" id="modal_sender_phone_link" class="text-dark text-decoration-none fw-semibold" style="font-size: 13.5px;">-</a>
                        </div>
                    </div>

                    {{-- Subject --}}
                    <div class="mb-3">
                        <span class="text-muted d-block mb-1" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Subject</span>
                        <div class="p-2 px-3 rounded text-dark fw-bold" id="modal_subject" style="background-color: #ffffff; border: 1px solid #cbd5e1; font-size: 14px;">
                            -
                        </div>
                    </div>

                    {{-- Full Message Body --}}
                    <div>
                        <span class="text-muted d-block mb-1" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Message Body</span>
                        <div class="p-3 rounded text-dark" id="modal_message_body" style="background-color: #ffffff; border: 1px solid #cbd5e1; font-size: 13.5px; line-height: 1.6; min-height: 120px; white-space: pre-wrap;">
                            -
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 12px 22px;">
                    <a href="#" id="modal_reply_mail_btn" class="btn btn-sm btn-primary px-3" style="font-size: 13px; height: 36px; display: inline-flex; align-items: center; border-radius: 6px;">
                        <i class="ri-reply-line me-1"></i> Reply via Email
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal" style="font-size: 13px; height: 36px; border-radius: 6px;">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteContactModal" tabindex="-1" aria-labelledby="deleteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 10px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(11, 15, 23, 0.1);">
                <div class="modal-header" style="background-color: #fee2e2; border-bottom: 1px solid #fca5a5; padding: 16px 20px;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="ri-error-warning-line text-danger" style="font-size: 22px;"></i>
                        <h5 class="modal-title fw-bold text-danger mb-0" id="deleteModalTitle" style="font-size: 16px;">
                            Confirm Message Deletion</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <p class="mb-2" style="font-size: 14px; color: #334155;">
                        Are you sure you want to delete inquiry message from <strong id="deleteContactTitle" class="text-dark"></strong>?
                    </p>
                    <p class="text-muted mb-0" style="font-size: 12.5px;">
                        This inquiry message will be permanently removed from your records.
                    </p>
                </div>
                <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal" style="font-size: 13px; height: 36px; border-radius: 6px;">Cancel</button>
                    <form id="deleteContactForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger px-4" style="font-size: 13px; height: 36px; border-radius: 6px; font-weight: 600;">
                            Delete Permanently
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#contacts-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.contacts.index') }}",
                    data: function (d) {
                        d.status = $('#filter_status').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'message', name: 'message' },
                    { data: 'status', name: 'status' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
                ],
                order: [[5, 'desc']],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search...",
                    paginate: {
                        next: '<i class="ri-arrow-right-s-line"></i>',
                        previous: '<i class="ri-arrow-left-s-line"></i>'
                    }
                }
            });

            // Filter triggers
            $('#filter_status').on('change', function () {
                table.draw();
            });

            // Reset filters
            $('#reset_filters').on('click', function () {
                $('#filter_status').val('');
                table.draw();
            });

            // Handle View Message Modal with Auto-Read
            $(document).on('click', '.btn-view-contact', function () {
                var url = $(this).data('url');

                $('#modal_sender_name').text('Loading...');
                $('#modal_received_at').text('Loading...');
                $('#modal_sender_email_link').text('Loading...').attr('href', '#');
                $('#modal_sender_phone_link').text('Loading...').attr('href', '#');
                $('#modal_subject').text('Loading...');
                $('#modal_message_body').text('Loading inquiry content...');

                $('#viewContactModal').modal('show');

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function (res) {
                        if (res.success && res.data) {
                            var data = res.data;
                            $('#modal_sender_name').text(data.name);
                            $('#modal_received_at').text(data.received_at);
                            $('#modal_sender_email_link').text(data.email).attr('href', 'mailto:' + data.email);
                            $('#modal_sender_phone_link').text(data.phone).attr('href', data.phone !== 'Not provided' ? 'tel:' + data.phone : '#');
                            $('#modal_subject').text(data.subject);
                            $('#modal_message_body').text(data.message);
                            $('#modal_reply_mail_btn').attr('href', 'mailto:' + data.email + '?subject=' + encodeURIComponent('Re: ' + data.subject));

                            // Refresh table row without resetting pagination so status immediately updates to Read
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function () {
                        $('#modal_message_body').text('Failed to load inquiry details. Please try again.');
                    }
                });
            });

            // Handle Delete Modal
            $(document).on('click', '.btn-delete-contact', function () {
                var url = $(this).data('url');
                var title = $(this).data('title');
                $('#deleteContactTitle').text(title);
                $('#deleteContactForm').attr('action', url);
                $('#deleteContactModal').modal('show');
            });
        });
    </script>
@endpush
