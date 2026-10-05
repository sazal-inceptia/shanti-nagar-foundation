@extends('admin.app')
@section('title')
    All Gallery Photos
@endsection

@section('content')
    <div class="container-fluid my-3">
        @include('admin.includes.gallery-nav')

        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">All Gallery Photos Directory</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Gallery Photos</li>
                                </ol>
                            </nav>
                        </div>
                        <a href="{{ route('admin.gallery-images.create') }}" class="add-new">
                            Upload Photos <i class="ms-1 ri-upload-cloud-2-line"></i>
                        </a>
                    </div>

                    {{-- Filters Bar --}}
                    <div class="card-body border-bottom" style="background-color: #f8fafc; padding: 14px 20px;">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-4 col-sm-6">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Filter by Album</label>
                                <select id="filter_album_id" class="form-select form-select-sm custom-input" style="height: 32px; font-size: 13px;">
                                    <option value="">All Photos (Albums + Standalone)</option>
                                    <option value="standalone">Standalone Photos Only (No Album)</option>
                                    @foreach($albums as $alb)
                                        <option value="{{ $alb->id }}">{{ $alb->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Publication Status</label>
                                <select id="filter_status" class="form-select form-select-sm custom-input" style="height: 32px; font-size: 13px;">
                                    <option value="">All Statuses</option>
                                    <option value="1">Published / Active</option>
                                    <option value="0">Draft / Hidden</option>
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
                                <span class="badge bg-primary" style="font-size: 12px; padding: 6px 12px;">Total: {{ $totalPhotos }} Photos</span>
                                <span class="badge bg-secondary ms-1" style="font-size: 12px; padding: 6px 12px;">Standalone: {{ $standalonePhotos }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Table --}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle" id="gallery-images-table" style="width: 100%; margin-bottom: 0;">
                                <thead style="background-color: #f8fafc;">
                                    <tr>
                                        <th style="width: 50px; font-size: 11.5px; font-weight: 700; color: #475569; text-transform: uppercase;">#</th>
                                        <th style="width: 80px; font-size: 11.5px; font-weight: 700; color: #475569; text-transform: uppercase;">Preview</th>
                                        <th style="font-size: 11.5px; font-weight: 700; color: #475569; text-transform: uppercase;">Title & Caption</th>
                                        <th style="width: 240px; font-size: 11.5px; font-weight: 700; color: #475569; text-transform: uppercase;">Album Assignment</th>
                                        <th style="width: 100px; font-size: 11.5px; font-weight: 700; color: #475569; text-transform: uppercase; text-align: center;">Status</th>
                                        <th style="width: 110px; font-size: 11.5px; font-weight: 700; color: #475569; text-transform: uppercase; text-align: center;">Actions</th>
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
    <div class="modal fade" id="deletePhotoModal" tabindex="-1" aria-labelledby="deletePhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 10px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                <div class="modal-header" style="background-color: #fff1f2; border-bottom: 1px solid #ffe4e6; padding: 16px 20px;">
                    <div class="d-flex align-items-center">
                        <div style="width: 36px; height: 36px; border-radius: 50%; background-color: #fecdd3; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                            <i class="ri-delete-bin-line text-danger" style="font-size: 18px;"></i>
                        </div>
                        <h5 class="modal-title fw-bold text-danger mb-0" id="deletePhotoModalLabel" style="font-size: 16px;">
                            Confirm Photo Removal
                        </h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <p class="mb-2" style="font-size: 14px; color: #334155;">
                        Are you sure you want to remove photo <strong id="deletePhotoTitle" class="text-dark"></strong>?
                    </p>
                    <p class="text-muted mb-0" style="font-size: 12.5px;">
                        This will permanently delete the photograph file from storage.
                    </p>
                </div>
                <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal" style="font-size: 13px; height: 36px; border-radius: 6px;">Cancel</button>
                    <form id="deletePhotoForm" method="POST" action="">
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
            var listUrl = "{{ route('admin.gallery-images.index') }}";

            var table = $('#gallery-images-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 15,
                lengthMenu: [10, 15, 25, 50, 100],
                ajax: {
                    url: listUrl,
                    data: function (d) {
                        d.album_id = $('#filter_album_id').val();
                        d.status = $('#filter_status').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'preview', name: 'preview', orderable: false, searchable: false },
                    { data: 'title_caption', name: 'title', orderable: true },
                    { data: 'album_badge', name: 'album_id', orderable: true },
                    { data: 'status_toggle', name: 'is_active', orderable: false, searchable: false, className: 'text-center' },
                    {
                        data: 'action-btn',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            var id = (data && data.id) ? data.id : (row && row.id ? row.id : '');
                            var name = (data && data.title ? data.title : (row && row.title ? row.title : 'Gallery Photo')).replace(/"/g, '&quot;');
                            var editUrl = "{{ url('/admin/gallery-images') }}/" + id + "/edit";
                            var deleteUrl = "{{ url('/admin/gallery-images') }}/" + id;

                            var html = '<div class="action-btn justify-content-center">';
                            html += '<a href="' + editUrl + '" class="btn btn-edit" title="Edit Photo"><i class="ri-edit-line"></i></a>';
                            html += '<button type="button" class="btn btn-delete btn-delete-modal" data-id="' + id + '" data-title="' + name + '" data-url="' + deleteUrl + '" title="Delete Photo"><i class="ri-delete-bin-line"></i></button>';
                            html += '</div>';
                            return html;
                        }
                    }
                ],
                order: [[0, 'desc']],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search...",
                    processing: '<div class="spinner-border spinner-border-sm text-primary" role="status"></div> Loading photos...'
                }
            });

            // Initialize Bootstrap Tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Filter trigger
            $('#filter_album_id, #filter_status').on('change', function () {
                table.draw();
            });

            // Reset filters
            $('#reset_filters').on('click', function () {
                $('#filter_album_id').val('');
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

                $('#deletePhotoTitle').text(title);
                $('#deletePhotoForm').attr('action', url);
                $('#deletePhotoModal').modal('show');
            });
        });
    </script>
@endpush
