@extends('adminlte::page')

@section('title', 'Pending Companies')

@section('content_header')
    <h1>Pending Companies for Approval</h1>
@stop

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="GET" action="{{ route('admin.companies.pending') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search for companies..." value="{{ request('search') }}">
        <span class="input-group-append">
            <button type="submit" class="btn btn-primary">Search</button>
        </span>
    </div>
</form>

@if ($companies->isEmpty())
    <p>No companies are pending approval.</p>
@else
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->mobile }}</td>
                    <td>
                        <a href="{{ route('admin.companies.show', $company->id) }}" class="btn btn-warning btn-sm" title="view" title="View">
                            <i class="fas fa-eye"></i> 
                        </a>
                        <button type="button" class="btn btn-success btn-sm" title="Approve"
                                data-toggle="modal" data-target="#approveModal" 
                                data-company-id="{{ $company->id }}">
                            <i class="fas fa-check-circle"></i> 
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" title="Reject"
                                data-toggle="modal" data-target="#rejectModal" 
                                data-company-id="{{ $company->id }}">
                            <i class="fas fa-times-circle"></i> 
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <div class="d-flex justify-content-center">
        {{ $companies->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
    </div>
@endif

<!-- Approve Confirmation Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel">Confirm Approval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to approve this company?
            </div>
            <div class="modal-footer">
                <form id="approveForm" method="POST" action="">
                    @csrf
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Reject Confirmation Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Confirm Rejection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to reject this company?
            </div>
            <div class="modal-footer">
                <form id="rejectForm" method="POST" action="">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#approveModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var companyId = button.data('company-id'); // Extract company ID from data-* attributes
            var action = "{{ route('admin.companies.approve', ':id') }}";
            action = action.replace(':id', companyId);

            var modal = $(this);
            modal.find('#approveForm').attr('action', action);
        });

        $('#rejectModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var companyId = button.data('company-id'); // Extract company ID from data-* attributes
            var action = "{{ route('admin.companies.reject', ':id') }}";
            action = action.replace(':id', companyId);

            var modal = $(this);
            modal.find('#rejectForm').attr('action', action);
        });
    });
</script>
@stop
