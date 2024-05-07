@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{route('add.category')}}" class="btn btn-inverse-info px-3">Add Category</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Category <span class="badge bg-danger">{{count($category)}}</span> </h4>
                        
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach ($category as $key=>$item)
                                  <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->category_name}}</td>
                                    <td>
                                        <a href="{{route('edit.category',$item->id)}}" class="btn btn-inverse-success" title="Edit"><i data-feather="edit"></i></a>
                                        <a href="{{route('delete.category',$item->id)}}" class="btn btn-inverse-danger" title="delete" id="delete"><i data-feather="trash-2"></i></a>
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
