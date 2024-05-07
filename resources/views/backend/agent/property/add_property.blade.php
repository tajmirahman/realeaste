@extends('agent.agent_dashboard')
@section('agent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Add Property</h6>

                        <form action="{{ route('store.agent.property') }}" id="myForm" class="forms-sample" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">

                                <div class="col-5 form-group mb-3">
                                    <label class="form-label">Property Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="property_name">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Property Status</label>
                                    <select class="form-select" name="property_status">
                                        <option selected disabled>Select Property Status</option>
                                        <option value="Buy">Buy</option>
                                        <option value="Rent">Rent</option>
                                    </select>
                                </div>

                                <div class="col-3 form-group mb-3">
                                    <label class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" autocomplete="off" name="zipcode">
                                </div>

                                <div class="col-6 form-group mb-3">
                                    <label class="form-label">Max Price</label>
                                    <input type="text" class="form-control" autocomplete="off" name="max_price">
                                </div>

                                <div class="col-6 form-group mb-3">
                                    <label class="form-label">Min Price</label>
                                    <input type="text" class="form-control" autocomplete="off" name="min_price">
                                </div>

                                <div class="col-3 form-group mb-3">
                                    <label class="form-label">Property Size</label>
                                    <input type="text" class="form-control" autocomplete="off" name="property_size">
                                </div>

                                <div class="col-3 form-group mb-3">
                                    <label class="form-label">Room</label>
                                    <input type="text" class="form-control" autocomplete="off" name="room">
                                </div>

                                <div class="col-3 form-group mb-3">
                                    <label class="form-label">Bed Room</label>
                                    <input type="text" class="form-control" autocomplete="off" name="bedroom">
                                </div>

                                <div class="col-3 form-group mb-3">
                                    <label class="form-label">Bath Room</label>
                                    <input type="text" class="form-control" autocomplete="off" name="bathroom">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Garage</label>
                                    <input type="text" class="form-control" autocomplete="off" name="garage">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Garage Size</label>
                                    <input type="text" class="form-control" autocomplete="off" name="garage_size">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Property Video</label>
                                    <input type="text" class="form-control" autocomplete="off" name="property_video">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" autocomplete="off" name="address">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" autocomplete="off" name="city">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">State</label>
                                    <select class="form-select" name="state_id">
                                        <option selected disabled>Select State</option>
                                        @foreach ($state as $item)
                                            <option value="{{ $item->id }}">{{ $item->state_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" autocomplete="off" name="country">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Latitude</label>
                                    <input type="text" class="form-control" autocomplete="off" name="latitude">
                                    <a href="https://www.latlong.net/">Go to latitude</a>
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Longitude</label>
                                    <input type="text" class="form-control" autocomplete="off" name="longitude">
                                    <a href="https://www.latlong.net/">Go to longitude</a>

                                </div>

                                <div class="col-6 form-group mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select" name="type_id">
                                        <option selected disabled>Select Type</option>
                                        @foreach ($type as $item)
                                            <option value="{{ $item->id }}">{{ $item->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 form-group mb-3">
                                    <label class="form-label">Amenitie</label>
                                    <select class="js-example-basic-multiple form-select" multiple="multiple"
                                        data-width="100%" name="amenitie_id[]">
                                        <option selected disabled>Select Amenitie</option>
                                        @foreach ($amenitie as $item)
                                            <option value="{{ $item->amenitie_name }}">{{ $item->amenitie_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Short Descp</label>
                                    <textarea name="short_descp" class="form-control" cols="4" rows="4"></textarea>
                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Long Descp</label>
                                    <textarea id="myeditorinstance" name="long_descp" class="form-control"></textarea>
                                </div>

                                <div class="col-6 form-group mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control mb-2" id="image"
                                        autocomplete="off">

                                    <img class="img-xs rounded-0" src="{{ url('upload/no_image.jpg') }}" id="showImage"
                                        style="width: 80px;height: 80px;" alt="">
                                </div>

                                <div class="col-6 mb-3">
                                    <label class="form-label">Multi Image</label>
                                    <input type="file" autocomplete="off" class="form-control" id="multiImg"
                                        name="multi_img[]" multiple="">

                                    <div class="row mt-3" id="preview_img"></div>
                                </div>

                            </div>

                            <div class="col-12 form-check mb-2">
                                <input type="checkbox" name="featured" class="form-check-input" id="checkDefault">
                                <label class="form-check-label" for="checkDefault">
                                    Featured
                                </label>
                            </div>

                            <div class="col-12 form-check mb-2">
                                <input type="checkbox" name="hot" class="form-check-input" id="checkDefault">
                                <label class="form-check-label" for="checkDefault">
                                    Hot
                                </label>
                            </div>
                            <hr>

                            <div class="co-12 mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary me-2 px-3">Add Property</button>
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

    {{-- multi image  --}}
    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>

    {{-- validate code  --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    property_name: {
                        required: true,
                    },
                },
                messages: {
                    property_name: {
                        required: 'Please Enter Property Name',
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
