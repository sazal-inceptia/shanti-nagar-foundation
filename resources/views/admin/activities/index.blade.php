@extends('admin.app')
@section('title')
    Club Activities &amp; Events
@endsection

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Club Activities &amp; Field Programs</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Activities</li>
                                </ol>
                            </nav>
                        </div>
                        <a href="{{ route('admin.activities.create') }}" class="add-new">
                            <i class="ri-add-line me-1"></i> Add Activity
                        </a>
                    </div>

                    {{-- Filter Bar --}}
                    <div class="card-body border-bottom" style="background-color: #f8fafc; padding: 14px 20px;">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Activity Status</label>
                                <select id="filter_status" class="form-select form-select-sm custom-input"
                                    style="height: 32px; font-size: 13px;">
                                    <option value="">All Statuses</option>
                                    @foreach($statuses as $val => $label)
                                        <option value="{{ $val }}" {{ request('status') == $val ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
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

                    {{-- DataTables Table Area --}}
                    <div class="card-body" style="padding: 20px;">
                        <table class="table dataTable w-100" id="activities-table" style="min-width: 850px;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 45px;">SL</th>
                                    <th scope="col" style="width: 65px;">Photo</th>
                                    <th scope="col">Activity Title &amp; Venue</th>
                                    <th scope="col" style="width: 150px;">Date &amp; Time</th>
                                    <th scope="col" style="width: 110px;">Status</th>
                                    <th scope="col" style="width: 90px;" class="text-center">Published</th>
                                    <th scope="col" style="width: 110px;" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 10px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(11, 15, 23, 0.1);">
                <div class="modal-header" style="background-color: #fee2e2; border-bottom: 1px solid #fca5a5; padding: 16px 20px;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="ri-error-warning-line text-danger" style="font-size: 22px;"></i>
                        <h5 class="modal-title fw-bold text-danger mb-0" id="deleteModalTitle" style="font-size: 16px;">
                            Confirm Activity Deletion</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <p class="mb-2" style="font-size: 14px; color: #334155;">
                        Are you sure you want to delete activity: <strong id="deleteItemTitle" class="text-dark"></strong>?
                    </p>
                    <p class="text-muted mb-0" style="font-size: 12.5px;">
                        This activity record will be archived.
                    </p>
                </div>
                <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 13px; height: 36px; border-radius: 6px;">Cancel</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger px-4"
                            style="font-size: 13px; height: 36px; border-radius: 6px; font-weight: 600;">
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
            var listUrl = "{{ route('admin.activities.index') }}";

            var table = $('#activities-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 15,
                lengthMenu: [10, 15, 25, 50, 100],
                ajax: {
                    url: listUrl,
                    data: function (d) {
                        d.status = $('#filter_status').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'thumbnail', name: 'thumbnail', orderable: false, searchable: false },
                    { data: 'title_details', name: 'title', orderable: true },
                    { data: 'event_date_time', name: 'event_date', orderable: true },
                    { data: 'status_badge', name: 'status', orderable: true },
                    { data: 'published_toggle', name: 'is_published', orderable: false, searchable: false, className: 'text-center' },
                    {
                        data: 'action-btn',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            var id = (data && data.id) ? data.id : (row && row.id ? row.id : '');
                            var name = (data && data.name ? data.name : (row && row.title ? row.title : '')).replace(/"/g, '&quot;');
                            var showUrl = "{{ url('/admin/activities') }}/" + id;
                            var editUrl = "{{ url('/admin/activities') }}/" + id + "/edit";
                            var deleteUrl = "{{ url('/admin/activities') }}/" + id;

                            var html = '<div class="action-btn justify-content-center">';
                            html += '<a href="' + showUrl + '" class="btn btn-view" title="View Details"><i class="ri-eye-line"></i></a>';
                            html += '<a href="' + editUrl + '" class="btn btn-edit" title="Edit Activity"><i class="ri-edit-line"></i></a>';
                            html += '<button type="button" class="btn btn-delete btn-delete-modal" data-id="' + id + '" data-title="' + name + '" data-url="' + deleteUrl + '" title="Delete Activity"><i class="ri-delete-bin-line"></i></button>';
                            html += '</div>';
                            return html;
                        }
                    }
                ],
                order: [[3, 'desc']],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search...",
                    processing: '<div class="spinner-border spinner-border-sm text-primary" role="status"></div> Loading activities...'
                }
            });

            // Initialize Bootstrap Tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Filter trigger
            $('#filter_status').on('change', function () {
                table.draw();
            });

            $('#reset_filters').on('click', function () {
                $('#filter_status').val('');
                table.draw();
            });

            // AJAX Toggle Switch for Published
            $(document).on('change', '.toggle-activity-publish', function () {
                var activityId = $(this).data('id');
                var isChecked = $(this).is(':checked') ? 1 : 0;
                var $switch = $(this);

                $.ajax({
                    url: "{{ url('/admin/activities') }}/" + activityId + "/toggle-status",
                    type: 'POST',
                    data: {
                        field: 'is_published',
                        value: isChecked,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        if (res.success) {
                            toastr.success(res.message || 'Published status updated');
                        } else {
                            toastr.error('Failed to update published status');
                            $switch.prop('checked', !isChecked);
                        }
                    },
                    error: function () {
                        toastr.error('Network error updating status');
                        $switch.prop('checked', !isChecked);
                    }
                });
            });

            // Delete Modal Trigger
            $(document).on('click', '.btn-delete-modal', function () {
                var url = $(this).data('url');
                var title = $(this).data('title');
                $('#deleteItemTitle').text(title);
                $('#deleteForm').attr('action', url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endpush
