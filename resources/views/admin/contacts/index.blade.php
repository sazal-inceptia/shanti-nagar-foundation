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
                                    <option value="replied">Replied</option>
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
                    searchPlaceholder: "Search sender, email, subject...",
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
        });
    </script>
@endpush
