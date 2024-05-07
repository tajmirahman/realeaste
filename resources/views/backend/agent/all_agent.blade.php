@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        {{-- <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{route('add.testimonial')}}" class="btn btn-inverse-info px-3">Add Testimonial</a>
            </ol>
        </nav> --}}

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Agent <span class="badge bg-danger">{{ count($agent) }}</span> </h4>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($agent as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <img src="{{ !empty($item->photo) ? url('upload/agent_images/' . $item->photo) : url('upload/no_image.jpg') }}"
                                                    style="width: 60px; height: 60px;" class="rounded-0" alt="">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                @if ($item->status == 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inative</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status == 'active')
                                                    <a href="{{ route('inactive.agent', $item->id) }}"
                                                        class="btn btn-inverse-info" title="Edit"><i
                                                            data-feather="thumbs-down"></i></a>
                                                @else
                                                    <a href="{{ route('active.agent', $item->id) }}"
                                                        class="btn btn-inverse-info" title="Edit"><i
                                                            data-feather="thumbs-up"></i></a>
                                                @endif


                                                {{-- <a href="{{ route('edit.testimonial', $item->id) }}"
                                                    class="btn btn-inverse-success" title="Edit"><i
                                                        data-feather="edit"></i></a> --}}

                                                <a href="{{ route('delete.agent', $item->id) }}"
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
