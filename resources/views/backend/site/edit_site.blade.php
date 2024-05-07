@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <div class="row">

            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Add Site</h6>
                        <hr>

                        <form action="{{route('update.site')}}" id="myForm" class="forms-sample" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$editSite->id}}">

                            <div class="row mb-3 ">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9 form-group">
                                    <input type="text" class="form-control" autocomplete="off" value="{{$editSite->email}}" name="email">
                                </div>
                            </div>

                            <div class="row mb-3 ">
                                <label class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9 form-group">
                                    <input type="text" class="form-control" autocomplete="off" value="{{$editSite->address}}"  name="address">
                                </div>
                            </div>

                            <div class="row mb-3 ">
                                <label class="col-sm-3 col-form-label">Time</label>
                                <div class="col-sm-9 form-group">
                                    <input type="text" class="form-control" autocomplete="off" value="{{$editSite->open_time}}"  name="open_time">
                                </div>
                            </div>

                            <div class="row mb-3 ">
                                <label class="col-sm-3 col-form-label">Mobile</label>
                                <div class="col-sm-9 form-group">
                                    <input type="text" class="form-control" autocomplete="off" value="{{$editSite->mobile}}"  name="mobile">
                                </div>
                            </div>

                            <div class="row mb-3 ">
                                <label class="col-sm-3 col-form-label">Facebook</label>
                                <div class="col-sm-9 form-group">
                                    <input type="text" class="form-control" autocomplete="off" value="{{$editSite->facebook}}"  name="facebook">
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary me-2 px-3">Update Site</button>
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
                    amenitie_name: {
                        required: true,
                    },
                },
                messages: {
                    amenitie_name: {
                        required: 'Please Enter Amenitie Name',
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
