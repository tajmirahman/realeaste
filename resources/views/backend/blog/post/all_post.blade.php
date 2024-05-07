@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{route('add.post')}}" class="btn btn-inverse-info px-3">Add Post</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Post <span class="badge bg-danger">{{count($post)}}</span> </h4>
                        
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Categoty Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach ($post as $key=>$item)
                                  <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <img src="{{asset($item->post_image)}}" style="width: 60px; height: 60px;" alt="">
                                    </td>
                                    <td>{{$item->post_title}}</td>
                                    <td>{{$item['category']['category_name'] }}</td>
                                    <td>
                                        <a href="{{route('edit.post',$item->id)}}" class="btn btn-inverse-success" title="Edit"><i data-feather="edit"></i></a>
                                        <a href="{{route('delete.post',$item->id)}}" class="btn btn-inverse-danger" title="delete" id="delete"><i data-feather="trash-2"></i></a>
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
