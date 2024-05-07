@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{route('add.admin')}}" class="btn btn-inverse-info px-3">Add Admin</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Admin <span class="badge bg-danger">{{ count($profileData) }}</span>
                        </h4>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($profileData as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <img src="{{ !empty($item->photo) ? url('upload/admin_images/' . $item->photo) : url('upload/no_image.jpg') }}"
                                                    style="width: 60px; height: 60px;" class="rounded-0" alt="">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                @foreach ($item->roles as $role)
                                                    <span class="badge bg-danger">{{$role->name}}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.admin', $item->id) }}"
                                                    class="btn btn-inverse-success" title="Edit"><i
                                                        data-feather="edit"></i></a>
                                                <a href="{{ route('delete.admin', $item->id) }}"
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
