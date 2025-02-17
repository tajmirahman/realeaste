@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <div class="row">

            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Add Testimonial</h6>

                        <form action="{{ route('store.testimonial') }}" id="myForm" class="forms-sample" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3 ">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9 form-group">
                                    <input type="text" class="form-control" autocomplete="off" name="name">
                                </div>
                            </div>

                            <div class="row mb-3 ">
                                <label class="col-sm-3 col-form-label">Position</label>
                                <div class="col-sm-9 form-group">
                                    <input type="text" class="form-control" autocomplete="off" name="position">
                                </div>
                            </div>

                            <div class="row mb-3 ">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9 form-group">
                                    <textarea name="description" class="form-control" id="" cols="6" rows="6"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control" id="image" autocomplete="off">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <img class="img-xs rounded-0" src="{{ url('upload/no_image.jpg') }}" id="showImage"
                                        style="width: 90px;height: 90px;" alt="">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary me-2 px-3">Submit</button>
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
