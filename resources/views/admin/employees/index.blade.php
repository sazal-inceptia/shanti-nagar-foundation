@extends('admin.app')
@section('title')
    Staff &amp; Employees Directory
@endsection

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Staff &amp; Employees Directory</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Staff Members</li>
                                </ol>
                            </nav>
                        </div>
                        <a href="{{ route('admin.employees.create') }}" class="add-new">
                            Register New Employee <i class="ms-1 ri-user-add-line"></i>
                        </a>
                    </div>

                    {{-- Filter Bar --}}
                    <div class="card-body border-bottom" style="background-color: #f8fafc; padding: 14px 20px;">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Employment Status</label>
                                <select id="filter_status" class="form-select form-select-sm custom-input" style="height: 32px; font-size: 13px;">
                                    <option value="">All Statuses</option>
                                    @foreach($statuses as $stVal => $stLabel)
                                        <option value="{{ $stVal }}" {{ request('employment_status') == $stVal ? 'selected' : '' }}>
                                            {{ $stLabel }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Department</label>
                                <select id="filter_department" class="form-select form-select-sm custom-input" style="height: 32px; font-size: 13px;">
                                    <option value="">All Departments</option>
                                    @foreach($departments as $deptKey => $deptName)
                                        <option value="{{ $deptKey }}" {{ request('department') == $deptKey ? 'selected' : '' }}>
                                            {{ $deptName }}
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
                        <table class="table dataTable w-100" id="employees-table" style="min-width: 850px;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 45px;">SL</th>
                                    <th scope="col" style="width: 55px;" class="text-center">Photo</th>
                                    <th scope="col" style="min-width: 130px;">Employee &amp; ID</th>
                                    <th scope="col" style="width: 300px;">Role &amp; Department</th>
                                    <th scope="col" style="width: 150px;">Contact Details</th>
                                    <th scope="col" style="width: 130px;">Base Salary</th>
                                    <th scope="col" style="width: 110px;">Status</th>
                                    <th scope="col" style="width: 100px;" class="text-center">Action</th>
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

    {{-- Delete / Archive Confirmation Modal --}}
    <div class="modal fade" id="deleteEmployeeModal" tabindex="-1" aria-labelledby="deleteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 10px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(11, 15, 23, 0.1);">
                <div class="modal-header" style="background-color: #fee2e2; border-bottom: 1px solid #fca5a5; padding: 16px 20px;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="ri-error-warning-line text-danger" style="font-size: 22px;"></i>
                        <h5 class="modal-title fw-bold text-danger mb-0" id="deleteModalTitle" style="font-size: 16px;">
                            Confirm Staff Profile Archival</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <p class="mb-2" style="font-size: 14px; color: #334155;">
                        Are you sure you want to archive staff member <strong id="deleteEmployeeTitle" class="text-dark"></strong>?
                    </p>
                    <p class="text-muted mb-0" style="font-size: 12.5px;">
                        This action will soft-delete their profile. Existing salary vouchers and ledger history remain preserved.
                    </p>
                </div>
                <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal" style="font-size: 13px; height: 36px; border-radius: 6px;">Cancel</button>
                    <form id="deleteEmployeeForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger px-4" style="font-size: 13px; height: 36px; border-radius: 6px; font-weight: 600;">
                            Archive Employee
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
            var listUrl = "{{ route('admin.employees.index') }}";

            var table = $('#employees-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 15,
                lengthMenu: [10, 15, 25, 50, 100],
                ajax: {
                    url: listUrl,
                    data: function (d) {
                        d.employment_status = $('#filter_status').val();
                        d.department = $('#filter_department').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'photo_display', name: 'photo_display', orderable: false, searchable: false, className: 'text-center' },
                    { data: 'employee_info', name: 'name', orderable: true },
                    { data: 'role_department', name: 'designation', orderable: true },
                    { data: 'contact_info', name: 'phone', orderable: true },
                    { data: 'formatted_salary', name: 'base_salary', orderable: true },
                    { data: 'status_badge', name: 'employment_status', orderable: true },
                    {
                        data: 'action-btn',
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            var id = data.id;
                            var name = (data.name || '').replace(/"/g, '&quot;');
                            var showUrl = "{{ url('/admin/employees') }}/" + id;
                            var editUrl = "{{ url('/admin/employees') }}/" + id + "/edit";
                            var deleteUrl = "{{ url('/admin/employees') }}/" + id;

                            var html = '<div class="action-btn justify-content-center">';
                            html += '<a href="' + showUrl + '" class="btn btn-view" title="View Profile & Salary Ledger"><i class="ri-eye-line"></i></a>';
                            html += '<a href="' + editUrl + '" class="btn btn-edit" title="Edit Profile"><i class="ri-edit-line"></i></a>';
                            html += '<button type="button" class="btn btn-delete btn-delete-modal" data-id="' + id + '" data-title="' + name + '" data-url="' + deleteUrl + '" title="Archive Employee"><i class="ri-delete-bin-line"></i></button>';
                            html += '</div>';
                            return html;
                        }
                    }
                ],
                order: [[2, 'asc']],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search by name, ID, phone, email...",
                    processing: '<div class="spinner-border spinner-border-sm text-primary" role="status"></div> Loading staff list...'
                }
            });

            // Tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            $('#filter_status, #filter_department').on('change', function () {
                table.draw();
            });

            $('#reset_filters').on('click', function () {
                $('#filter_status').val('');
                $('#filter_department').val('');
                table.draw();
            });

            // Delete Modal
            $(document).on('click', '.btn-delete-modal', function () {
                var title = $(this).data('title');
                var url = $(this).data('url');

                $('#deleteEmployeeTitle').text(title);
                $('#deleteEmployeeForm').attr('action', url);
                $('#deleteEmployeeModal').modal('show');
            });
        });
    </script>
@endpush
