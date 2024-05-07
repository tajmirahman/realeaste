@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.property') }}" class="btn btn-inverse-info px-3">Add Property</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Property <span class="badge bg-danger">{{ count($property) }}</span>
                        </h4>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Property Type</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($property as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <img src="{{ asset($item->image) }}" style="width: 60px; height: 60px;"
                                                    class="rounded-0" alt="">
                                            </td>
                                            <td>{{ $item->property_name }}</td>
                                            <td>{{ $item->property_status }}</td>
                                            <td>{{ $item['type']['type_name'] }}</td>
                                            <td>
                                                @if ($item->status == '1')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.property', $item->id) }}"
                                                    class="btn btn-inverse-success" title="Edit"><i
                                                        data-feather="edit"></i></a>
                                                <a href="{{ route('delete.property', $item->id) }}"
                                                    class="btn btn-inverse-warning" title="delete" id="delete"><i
                                                        data-feather="trash-2"></i></a>

                                                @if ($item->status == '1')
                                                    <a href="{{route('inactive.property',$item->id)}}" class="btn btn-inverse-primary"><i
                                                            data-feather="thumbs-down"></i> </a>
                                                @else
                                                    <a href="{{route('active.property',$item->id)}}" class="btn btn-inverse-primary"><i
                                                            data-feather="thumbs-up"></i> </a>
                                                @endif
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
