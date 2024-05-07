@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{route('add.state')}}" class="btn btn-inverse-info px-3">Add State</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total State <span class="badge bg-danger">{{count($state)}}</span> </h4>
                        
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach ($state as $key=>$item)
                                  <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <img src="{{asset($item->image)}}" style="width: 60px; height: 60px;" class="rounded-0" alt="">
                                    </td>
                                    <td>{{$item->state_name}}</td>
                                    <td>
                                        <a href="{{route('edit.state',$item->id)}}" class="btn btn-inverse-success" title="Edit"><i data-feather="edit"></i></a>
                                        <a href="{{route('delete.state',$item->id)}}" class="btn btn-inverse-warning" title="delete" id="delete"><i data-feather="trash"></i></a>
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
