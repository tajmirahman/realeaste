@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{route('add.site')}}" class="btn btn-inverse-info px-3">Add Site</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Site <span class="badge bg-danger">{{count($site)}}</span> </h4>
                        
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Time</th>
                                        <th>Mobile</th>
                                        <th>Facebook</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach ($site as $key=>$item)
                                  <tr>
                                    <td>{{$key+1}}</td>
                                    
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{$item->open_time}}</td>
                                    <td>{{$item->mobile}}</td>
                                    <td>{{$item->facebook}}</td>
                                    <td>
                                        <a href="{{route('edit.site',$item->id)}}" class="btn btn-inverse-success" title="Edit"><i data-feather="edit"></i></a>
                                        {{-- <a href="{{route('delete.state',$item->id)}}" class="btn btn-inverse-warning" title="delete" id="delete"><i data-feather="trash"></i></a> --}}
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
