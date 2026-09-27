@extends('admin.app')
@section('title')
    Volunteer Registrations
@endsection

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Volunteer Registrations</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Volunteers</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    {{-- Filter Bar --}}
                    <div class="card-body border-bottom" style="background-color: #f8fafc; padding: 14px 20px;">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-2 col-sm-4">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Application Status</label>
                                <select id="filter_status" class="form-select form-select-sm custom-input" style="height: 32px; font-size: 13px;">
                                    <option value="">All Applications</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Gender</label>
                                <select id="filter_gender" class="form-select form-select-sm custom-input" style="height: 32px; font-size: 13px;">
                                    <option value="">All Genders</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
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
                            <table class="table dataTable table-hover align-middle w-100" id="volunteers-table" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th style="width: 45px;">SL</th>
                                        <th style="min-width: 180px;">Volunteer Name</th>
                                        <th style="min-width: 180px;">Contact Details</th>
                                        <th style="min-width: 220px;">Address &amp; Location</th>
                                        <th style="width: 100px;">Status</th>
                                        <th style="width: 110px;">Applied Date</th>
                                        <th style="width: 120px; text-align: center;">Actions</th>
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
            var table = $('#volunteers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.volunteers.index') }}",
                    data: function (d) {
                        d.status = $('#filter_status').val();
                        d.gender = $('#filter_gender').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'contact', name: 'contact' },
                    { data: 'address', name: 'address' },
                    { data: 'status', name: 'status' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
                ],
                order: [[5, 'desc']],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search volunteer name, email, phone...",
                    paginate: {
                        next: '<i class="ri-arrow-right-s-line"></i>',
                        previous: '<i class="ri-arrow-left-s-line"></i>'
                    }
                }
            });

            // Filter triggers
            $('#filter_status, #filter_gender').on('change', function () {
                table.draw();
            });

            // Reset filters
            $('#reset_filters').on('click', function () {
                $('#filter_status').val('');
                $('#filter_gender').val('');
                table.draw();
            });
        });
    </script>
@endpush
