@extends('admin.app')
@section('title')
    Activity Logs
@endsection

@section('content')
    <style>
        .info-pill {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px 14px;
        }
        .info-pill-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            margin-bottom: 4px;
        }
        .info-pill-val {
            font-size: 13.5px;
            font-weight: 500;
            color: #1e293b;
            word-break: break-word;
        }
    </style>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Activity Logs</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Activity Logs</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    {{-- Dynamic Filter Bar --}}
                    <div class="card-body border-bottom" style="background-color: #f8fafc; padding: 14px 20px;">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-2 col-sm-4">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Module</label>
                                <select id="filter_module" class="form-select form-select-sm custom-input"
                                    style="height: 32px; font-size: 13px;">
                                    <option value="">All Modules</option>
                                    @foreach($modules as $module)
                                        <option value="{{ $module }}">{{ ucfirst($module) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Action
                                    Type</label>
                                <select id="filter_action" class="form-select form-select-sm custom-input"
                                    style="height: 32px; font-size: 13px;">
                                    <option value="">All Actions</option>
                                    @foreach($actions as $act)
                                        <option value="{{ $act }}">{{ ucwords(str_replace('_', ' ', $act)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">User
                                    / Operator</label>
                                <select id="filter_user" class="form-select form-select-sm custom-input"
                                    style="height: 32px; font-size: 13px;">
                                    <option value="">All Users</option>
                                    @foreach($users as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-4 d-flex align-items-end">
                                <button type="button" id="reset_filters" class="btn btn-sm btn-outline-secondary w-100"
                                    style="height: 32px; font-size: 13px; font-weight: 600; border-radius: 6px;">
                                    <i class="ri-refresh-line me-1"></i> Reset Filters
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Table Area --}}
                    <div class="card-body" style="padding: 20px;">
                        <table class="table dataTable w-100" id="activity-logs-table" style="min-width: 950px;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 45px;">SL</th>
                                    <th scope="col" style="width: 180px;">User</th>
                                    <th scope="col" style="width: 100px;">Action</th>
                                    <th scope="col" style="width: 110px;">Module</th>
                                    <th scope="col">Description</th>
                                    <th scope="col" style="width: 120px;">IP Address</th>
                                    <th scope="col" style="width: 140px;">Timestamp</th>
                                    <th scope="col" style="width: 70px;" class="text-center">Action</th>
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

    {{-- View Activity Log Modal --}}
    <div class="modal fade" id="viewActivityLogModal" tabindex="-1" aria-labelledby="viewActivityLogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <h5 class="modal-title fw-bold text-dark" id="viewActivityLogModalLabel" style="font-size: 16px;">
                        <i class="ri-file-search-line text-primary me-1"></i> Audit Log Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="info-pill mb-2">
                                <div class="info-pill-label">Action Performed</div>
                                <div class="info-pill-val" id="modalAction">—</div>
                            </div>
                            <div class="info-pill mb-2">
                                <div class="info-pill-label">Module</div>
                                <div class="info-pill-val" id="modalModule">—</div>
                            </div>
                            <div class="info-pill">
                                <div class="info-pill-label">IP Address</div>
                                <div class="info-pill-val"><code id="modalIpAddress" class="text-muted">—</code></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-pill mb-2">
                                <div class="info-pill-label">User / Operator</div>
                                <div class="info-pill-val" id="modalUser">—</div>
                            </div>
                            <div class="info-pill mb-2">
                                <div class="info-pill-label">Timestamp</div>
                                <div class="info-pill-val" id="modalTimestamp">—</div>
                            </div>
                            <div class="info-pill">
                                <div class="info-pill-label">Subject (Model) ID</div>
                                <div class="info-pill-val" id="modalSubjectId">—</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="info-pill">
                                <div class="info-pill-label">Description</div>
                                <div class="info-pill-val" id="modalDescription" style="white-space: pre-wrap; font-size: 13px;">—</div>
                            </div>
                        </div>
                        <div class="col-6" id="modalOldValuesWrapper">
                            <div class="info-pill h-100">
                                <div class="info-pill-label text-danger">Old Values</div>
                                <pre class="info-pill-val bg-white p-2 rounded border" id="modalOldValues" style="max-height: 250px; overflow-y: auto; font-size: 12px;"></pre>
                            </div>
                        </div>
                        <div class="col-6" id="modalNewValuesWrapper">
                            <div class="info-pill h-100">
                                <div class="info-pill-label text-success">New Values</div>
                                <pre class="info-pill-val bg-white p-2 rounded border" id="modalNewValues" style="max-height: 250px; overflow-y: auto; font-size: 12px;"></pre>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0;">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    <script type="text/javascript">
        $(document).ready(function () {
            var listUrl = "{{ route('activity-logs.index') }}";

            var table = $('#activity-logs-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                lengthMenu: [10, 25, 50, 100],
                ajax: {
                    url: listUrl,
                    data: function (d) {
                        d.module = $('#filter_module').val();
                        d.action = $('#filter_action').val();
                        d.user_id = $('#filter_user').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'user', name: 'user.name', orderable: false },
                    { data: 'action_badge', name: 'action', orderable: true },
                    { data: 'module_badge', name: 'module', orderable: true },
                    { data: 'description_text', name: 'description', orderable: true },
                    { data: 'ip_address', name: 'ip_address', orderable: false },
                    { data: 'timestamp', name: 'created_at', orderable: true },
                    {
                        data: 'action-btn',
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            var id = data.id;
                            return '<div class="action-btn justify-content-center">' +
                                '<button type="button" onclick="viewActivityLog(' + id + ')" class="btn btn-edit" title="View Audit Details" style="background-color: #f1f5f9; color: #334155;"><i class="ri-eye-line"></i></button>' +
                                '</div>';
                        }
                    }
                ],
                order: [[6, 'desc']],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search...",
                    processing: '<div class="spinner-border spinner-border-sm text-primary" role="status"></div> Loading audit logs...'
                }
            });

            // Filter trigger handlers
            $('#filter_module, #filter_action, #filter_user').on('change', function () {
                table.draw();
            });

            $('#reset_filters').on('click', function () {
                $('#filter_module').val('');
                $('#filter_action').val('');
                $('#filter_user').val('');
                table.draw();
            });

            // View Activity Log Details in Modal
            window.viewActivityLog = function (id) {
                var url = "{{ url('/dashboard/activity-logs') }}/" + id;
                $.ajax({
                    url: url,
                    type: 'GET',
                    headers: { 'Accept': 'application/json' },
                    success: function (res) {
                        if (!res.success || !res.data) return;
                        var log = res.data;

                        $('#modalAction').text(log.action.replace(/_/g, ' ').toUpperCase());
                        $('#modalModule').text(log.module.toUpperCase());
                        $('#modalIpAddress').text(log.ip_address || '—');
                        $('#modalUser').text(log.user ? (log.user.name + ' (' + log.user.email + ')') : 'System / Guest');
                        
                        var d = new Date(log.created_at);
                        $('#modalTimestamp').text(d.toLocaleString());
                        
                        $('#modalSubjectId').text(log.subject_id || '—');
                        $('#modalDescription').text(log.description || '—');

                        if (log.old_values) {
                            $('#modalOldValues').text(JSON.stringify(log.old_values, null, 2));
                            $('#modalOldValuesWrapper').show();
                        } else {
                            $('#modalOldValuesWrapper').hide();
                        }

                        if (log.new_values) {
                            $('#modalNewValues').text(JSON.stringify(log.new_values, null, 2));
                            $('#modalNewValuesWrapper').show();
                        } else {
                            $('#modalNewValuesWrapper').hide();
                        }

                        // Adjust columns if one is missing
                        if (!log.old_values && log.new_values) {
                            $('#modalNewValuesWrapper').removeClass('col-6').addClass('col-12');
                        } else if (log.old_values && !log.new_values) {
                            $('#modalOldValuesWrapper').removeClass('col-6').addClass('col-12');
                        } else {
                            $('#modalNewValuesWrapper').removeClass('col-12').addClass('col-6');
                            $('#modalOldValuesWrapper').removeClass('col-12').addClass('col-6');
                        }

                        $('#viewActivityLogModal').modal('show');
                    },
                    error: function () {
                        toastr.error('Could not load activity log details', 'Error');
                    }
                });
            };
        });
    </script>
@endpush