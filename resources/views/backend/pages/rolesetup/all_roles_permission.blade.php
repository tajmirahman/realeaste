@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.roles.permission') }}" class="btn btn-inverse-info px-3">Add Role Permission</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Role Permission <span class="badge bg-danger">{{ count($role) }}</span>
                        </h4>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Role Name</th>
                                        <th>Permission Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($role as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @foreach ($item->permissions as $prem)
                                                    <span class="badge bg-danger">{{ $prem->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.edit.roles', $item->id) }}" class="btn btn-inverse-success"
                                                    title="Edit"><i data-feather="edit"></i></a>
                                                <a href="{{ route('admin.delete.roles', $item->id) }}"
                                                    class="btn btn-inverse-warning" title="delete" id="delete"><i
                                                        data-feather="trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
