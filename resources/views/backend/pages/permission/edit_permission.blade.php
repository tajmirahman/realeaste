@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <div class="row">

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Permission</h6>

                        <form action="{{ route('update.permission') }}" id="myForm" class="forms-sample" method="POST">
                            @csrf
                            
                            <input type="hidden" name="id" value="{{ $permission->id }}">

                            <div class="row mt-4">

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $permission->name }}" name="name">
                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Group Name</label>
                                    <select class="form-select" name="group_name">
                                        <option selected disabled>Select Permission Name</option>

                                        <option {{ $permission->group_name == 'comment' ? 'selected' : '' }}
                                            value="comment">Comment</option>
                                        <option {{ $permission->group_name == 'type' ? 'selected' : '' }} value="type">
                                            Type</option>
                                        <option {{ $permission->group_name == 'amenitie' ? 'selected' : '' }}
                                            value="amenitie">Amenitie</option>
                                        <option {{ $permission->group_name == 'state' ? 'selected' : '' }} value="state">
                                            State</option>
                                        <option {{ $permission->group_name == 'property' ? 'selected' : '' }}
                                            value="property">Property</option>
                                        <option {{ $permission->group_name == 'testimonial' ? 'selected' : '' }}
                                            value="testimonial">Testimonial</option>
                                        <option {{ $permission->group_name == 'category' ? 'selected' : '' }}
                                            value="category">Category</option>
                                        <option {{ $permission->group_name == 'post' ? 'selected' : '' }} value="post">
                                            Post</option>
                                        <option {{ $permission->group_name == 'site' ? 'selected' : '' }} value="site">
                                            Site Setting</option>
                                        <option {{ $permission->group_name == 'agent' ? 'selected' : '' }} value="agent">
                                            Agent</option>

                                        <option {{ $permission->group_name == 'role' ? 'selected' : '' }} value="role">
                                            Role & Permission</option>

                                        <option {{ $permission->group_name == 'admin' ? 'selected' : '' }} value="admin">
                                                Admin Manage</option>

                                    </select>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-inverse-primary me-2 px-3">Submit</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>



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
                        required: 'Please Enter Permission Name',
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
