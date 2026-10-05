@extends('admin.app')
@section('title')
    Photo Albums Management
@endsection

@section('content')
    <div class="container-fluid my-3">
        @include('admin.includes.gallery-nav')

        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Photo Albums Directory</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Albums</li>
                                </ol>
                            </nav>
                        </div>
                        <a href="{{ route('admin.albums.create') }}" class="add-new">
                            Create Album <i class="ms-1 ri-add-line"></i>
                        </a>
                    </div>

                    {{-- Filter Bar --}}
                    <div class="card-body border-bottom" style="background-color: #f8fafc; padding: 14px 20px;">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Publication Status</label>
                                <select id="filter_status" class="form-select form-select-sm custom-input"
                                    style="height: 32px; font-size: 13px;">
                                    <option value="">All Statuses</option>
                                    <option value="1">Published / Active</option>
                                    <option value="0">Draft / Inactive</option>
                                </select>
                            </div>
                            <div class="col-auto d-flex align-items-end">
                                <button type="button" id="reset_filters" class="btn btn-sm btn-outline-secondary"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Reset Filters"
                                    style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; font-size: 15px;">
                                    <i class="ri-refresh-line"></i>
                                </button>
                            </div>
                            <div class="col text-end d-none d-md-block">
                                <span class="badge bg-primary" style="font-size: 12px; padding: 6px 12px;">Total Albums: {{ $totalAlbums }}</span>
                                <span class="badge bg-success ms-1" style="font-size: 12px; padding: 6px 12px;">Active: {{ $activeAlbums }}</span>
                                <span class="badge bg-info ms-1" style="font-size: 12px; padding: 6px 12px;">Photos: {{ $totalPhotos }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Table --}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle" id="albums-table" style="width: 100%; margin-bottom: 0;">
                                <thead style="background-color: #f8fafc;">
                                    <tr>
                                        <th style="width: 50px; font-size: 11.5px; font-weight: 700; color: #475569; text-transform: uppercase;">#</th>
                                        <th style="width: 75px; font-size: 11.5px; font-weight: 700; color: #475569; text-transform: uppercase;">Cover</th>
                                        <th style="font-size: 11.5px; font-weight: 700; color: #475569; text-transform: uppercase;">Album Title</th>
                                        <th style="width: 120px; font-size: 11.5px; font-weight: 700; color: #475569; text-transform: uppercase;">Photos</th>
                                        <th style="width: 130px; font-size: 11.5px; font-weight: 700; color: #475569; text-transform: uppercase;">Event Date</th>
                                        <th style="width: 100px; font-size: 11.5px; font-weight: 700; color: #475569; text-transform: uppercase; text-align: center;">Status</th>
                                        <th style="width: 130px; font-size: 11.5px; font-weight: 700; color: #475569; text-transform: uppercase; text-align: center;">Actions</th>
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

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteAlbumModal" tabindex="-1" aria-labelledby="deleteAlbumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 10px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                <div class="modal-header" style="background-color: #fff1f2; border-bottom: 1px solid #ffe4e6; padding: 16px 20px;">
                    <div class="d-flex align-items-center">
                        <div style="width: 36px; height: 36px; border-radius: 50%; background-color: #fecdd3; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                            <i class="ri-delete-bin-line text-danger" style="font-size: 18px;"></i>
                        </div>
                        <h5 class="modal-title fw-bold text-danger mb-0" id="deleteAlbumModalLabel" style="font-size: 16px;">
                            Confirm Album Deletion
                        </h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <p class="mb-2" style="font-size: 14px; color: #334155;">
                        Are you sure you want to delete album <strong id="deleteAlbumTitle" class="text-dark"></strong>?
                    </p>
                    <p class="text-muted mb-0" style="font-size: 12.5px;">
                        This will delete the album and all its associated photographs. This action cannot be undone.
                    </p>
                </div>
                <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal" style="font-size: 13px; height: 36px; border-radius: 6px;">Cancel</button>
                    <form id="deleteAlbumForm" method="POST" action="">
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
            var listUrl = "{{ route('admin.albums.index') }}";

            var table = $('#albums-table').DataTable({
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
                    { data: 'cover', name: 'cover', orderable: false, searchable: false },
                    { data: 'title_details', name: 'title', orderable: true },
                    { data: 'photos_count', name: 'id', orderable: false, searchable: false },
                    { data: 'date_display', name: 'event_date', orderable: true },
                    { data: 'status_toggle', name: 'is_active', orderable: false, searchable: false, className: 'text-center' },
                    {
                        data: 'action-btn',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            var id = (data && data.id) ? data.id : (row && row.id ? row.id : '');
                            var name = (data && data.title ? data.title : (row && row.title ? row.title : '')).replace(/"/g, '&quot;');
                            var showUrl = "{{ url('/admin/albums') }}/" + id;
                            var editUrl = "{{ url('/admin/albums') }}/" + id + "/edit";
                            var deleteUrl = "{{ url('/admin/albums') }}/" + id;

                            var html = '<div class="action-btn justify-content-center">';
                            html += '<a href="' + showUrl + '" class="btn btn-view" title="View Album & Photos"><i class="ri-eye-line"></i></a>';
                            html += '<a href="' + editUrl + '" class="btn btn-edit" title="Edit Album"><i class="ri-edit-line"></i></a>';
                            html += '<button type="button" class="btn btn-delete btn-delete-modal" data-id="' + id + '" data-title="' + name + '" data-url="' + deleteUrl + '" title="Delete Album"><i class="ri-delete-bin-line"></i></button>';
                            html += '</div>';
                            return html;
                        }
                    }
                ],
                order: [[4, 'desc']],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search...",
                    processing: '<div class="spinner-border spinner-border-sm text-primary" role="status"></div> Loading albums...'
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

            // Reset filters
            $('#reset_filters').on('click', function () {
                $('#filter_status').val('');
                table.draw();
            });

            // Status Toggle Switch
            $(document).on('change', '.status-toggle', function () {
                var url = $(this).data('url');
                var checkbox = $(this);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message || 'Status updated successfully.');
                        }
                    },
                    error: function () {
                        toastr.error('Failed to update status.');
                        checkbox.prop('checked', !checkbox.prop('checked'));
                    }
                });
            });

            // Modal Delete Trigger
            $(document).on('click', '.btn-delete-modal', function () {
                var title = $(this).data('title');
                var url = $(this).data('url');

                $('#deleteAlbumTitle').text(title);
                $('#deleteAlbumForm').attr('action', url);
                $('#deleteAlbumModal').modal('show');
            });
        });
    </script>
@endpush
