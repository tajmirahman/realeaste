@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <div class="row">

            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Admin</h6>

                        <form action="{{ route('update.admin',$user->id) }}" id="myForm" class="forms-sample" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3 ">
                                <label class="col-sm-3 col-form-label">Admin Name</label>
                                <div class="col-sm-9 form-group">
                                    <input type="text" class="form-control" autocomplete="off" value="{{$user->name}}" name="name">
                                </div>
                            </div>

                            <div class="row mb-3 ">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9 form-group">
                                    <input type="text" class="form-control" autocomplete="off" value="{{$user->email}}" name="email">
                                </div>
                            </div>

                            <div class="row mb-3 ">
                                <label class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9 form-group">
                                    <input type="text" class="form-control" autocomplete="off" value="{{$user->phone}}" name="phone">
                                </div>
                            </div>

                            <div class="row mb-3 ">
                                <label class="col-sm-3 col-form-label">Admin Role</label>
                                <div class="col-sm-9 form-group">
                                    <select class="form-select" name="roles">
                                        <option selected disabled>Select Role Name</option>
    
                                        @foreach ($role as $item)
                                            <option value="{{ $item->id }}" {{$user->hasRole($item->name) ? 'selected' : ''}} >{{ $item->name }}</option>
                                        @endforeach
    
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary me-2 px-3">Update Multi Admin</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    {{-- validate code  --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please Enter Name',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
