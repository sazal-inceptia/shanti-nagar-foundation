@extends('admin.app')
@section('title')
    Pages
@endsection

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                {{-- Main Pages DataTable Card --}}
                <div class="card table-card">
                    {{-- Card Header --}}
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Website Pages</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pages</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="page-badge">
                                <i class="ri-information-line me-1 text-primary"></i> Click Edit to customize page sections
                            </span>
                        </div>
                    </div>

                    {{-- Data Table --}}
                    <div class="card-body" style="padding: 20px;">
                        <table class="table dataTable w-100" id="pages-table" style="min-width: 800px;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">SL</th>
                                    <th scope="col" style="width: 70px;" class="text-center">Icon</th>
                                    <th scope="col">Page Name</th>
                                    <th scope="col" style="width: 180px;">Identifier / Slug</th>
                                    <th scope="col" style="width: 150px;" class="text-center">Sections</th>
                                    <th scope="col" style="width: 120px;" class="text-center">Action</th>
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
@endsection

@push('custom-script')
    <script type="text/javascript">
        $(document).ready(function () {
            var listUrl = "{{ route('pages.index') }}";

            $('#pages-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 20,
                lengthMenu: [10, 20, 50, 100],
                order: [[0, 'asc']],
                ajax: {
                    url: listUrl
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'align-middle text-center text-muted fw-semibold' },
                    { data: 'thumbnail', name: 'thumbnail', orderable: false, searchable: false, className: 'align-middle text-center' },
                    { data: 'page_title', name: 'page_title', orderable: false, searchable: true, className: 'align-middle' },
                    { data: 'slug', name: 'slug', orderable: false, searchable: true, className: 'align-middle' },
                    { data: 'sections_badge', name: 'sections_badge', orderable: false, searchable: false, className: 'align-middle text-center' },
                    {
                        data: 'action-btn',
                        name: 'action-btn',
                        orderable: false,
                        searchable: false,
                        className: 'align-middle text-center',
                        render: function (data) {
                            var editBtn = data.can_edit
                                ? '<a href="' + data.edit_url + '" class="btn btn-edit" title="Edit Page Content"><i class="ri-edit-line"></i></a>'
                                : '';
                            return '<div class="action-btn justify-content-center">' + editBtn + '</div>';
                        }
                    }
                ],
                language: {
                    paginate: {
                        previous: "<i class='ri-arrow-left-s-line'></i>",
                        next: "<i class='ri-arrow-right-s-line'></i>"
                    },
                    search: "_INPUT_",
                    searchPlaceholder: "Search...",
                    processing: '<div class="spinner-border spinner-border-sm text-primary" role="status"></div> Loading pages...'
                }
            });
        });
    </script>
@endpush
