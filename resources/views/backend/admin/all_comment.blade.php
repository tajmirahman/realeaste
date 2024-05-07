@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{route('add.testimonial')}}" class="btn btn-inverse-info px-3">Add Testimonial</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Comment <span class="badge bg-danger">{{count($comment)}}</span> </h4>
                        
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>User Name</th>
                                        <th>Blog Title</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach ($comment as $key=>$item)
                                  <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item['user']['name']}}</td>
                                    <td>{{$item['post']['post_title']}}</td>
                                    <td>{{$item->subject}}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                        <a href="{{route('edit.testimonial',$item->id)}}" class="btn btn-inverse-info" title="Edit"><i data-feather="thumbs-down"></i></a> 
                                        @else
                                        <a href="{{route('edit.testimonial',$item->id)}}" class="btn btn-inverse-info" title="Edit"><i data-feather="thumbs-up"></i></a>  
                                        @endif
                                        <a href="{{route('view.comment',$item->id)}}" class="btn btn-inverse-warning"  title="View Comment"><i data-feather="eye"></i></a>
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
