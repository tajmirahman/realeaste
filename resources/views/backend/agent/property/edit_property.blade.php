@extends('agent.agent_dashboard')
@section('agent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">

        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Property</h6>

                        <form action="{{ route('update.agent.property') }}" id="myForm" class="forms-sample" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $property->id }}">
                            <input type="hidden" name="old_image" value="{{ $property->image }}">

                            <div class="row mb-3 ">

                                <div class="col-5 form-group mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->property_name }}" name="property_name">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Property Status</label>
                                    <select class="form-select" name="property_status">
                                        <option selected disabled>Select Property Status</option>
                                        <option value="Buy" {{ $property->property_status == 'Buy' ? 'selected' : '' }}>
                                            Buy</option>
                                        <option value="Rent" {{ $property->property_status == 'Rent' ? 'selected' : '' }}>
                                            Rent</option>
                                    </select>
                                </div>

                                <div class="col-3 form-group mb-3">
                                    <label class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->zipcode }}" name="zipcode">
                                </div>

                                <div class="col-6 form-group mb-3">
                                    <label class="form-label">Max Price</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->max_price }}" name="max_price">
                                </div>

                                <div class="col-6 form-group mb-3">
                                    <label class="form-label">Min Price</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->min_price }}" name="min_price">
                                </div>

                                <div class="col-3 form-group mb-3">
                                    <label class="form-label">Property Size</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->property_size }}" name="property_size">
                                </div>

                                <div class="col-3 form-group mb-3">
                                    <label class="form-label">Room</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->room }}" name="room">
                                </div>

                                <div class="col-3 form-group mb-3">
                                    <label class="form-label">Bed Room</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->bedroom }}" name="bedroom">
                                </div>

                                <div class="col-3 form-group mb-3">
                                    <label class="form-label">Bath Room</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->bathroom }}" name="bathroom">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Garage</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->garage }}" name="garage">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Garage Size</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->garage_size }}" name="garage_size">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Property Video</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->property_video }}" name="property_video">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->address }}" name="address">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->city }}" name="city">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">State</label>
                                    <select class="form-select" name="state_id">
                                        <option selected disabled>Select State</option>
                                        @foreach ($state as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $property->state_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->state_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->country }}" name="country">
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Latitude</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->latitude }}" name="latitude">
                                    <a href="https://www.latlong.net/">Go to latitude</a>
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Longitude</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $property->longitude }}" name="longitude">
                                    <a href="https://www.latlong.net/">Go to longitude</a>
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select" name="type_id">
                                        <option selected disabled></option>
                                        @foreach ($type as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $property->type_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4 form-group mb-3">
                                    <label class="form-label">Amenitie</label>
                                    <select class="js-example-basic-multiple form-select" multiple="multiple"
                                        data-width="100%" name="amenitie_id[]">
                                        <option selected disabled></option>
                                        @foreach ($amenitie as $item)
                                            <option value="{{ $item->amenitie_name }}"
                                                {{ in_array($item->amenitie_name, $edit_amenitie) ? 'selected' : '' }}>
                                                {{ $item->amenitie_name }}

                                            </option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Short Descp</label>
                                    <textarea name="short_descp" class="form-control" cols="4" rows="4">{{ $property->short_descp }}</textarea>
                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Long Descp</label>
                                    <textarea id="myeditorinstance" name="long_descp" class="form-control">{{ $property->long_descp }}</textarea>
                                </div>

                                <div class="col-6 form-group mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control mb-2" id="image"
                                        autocomplete="off">

                                    <img class="img-xs rounded-0" src="{{ asset($property->image) }}" id="showImage"
                                        style="width: 80px;height: 80px;" alt="">
                                </div>

                                {{-- <div class="col-6 mb-3">
                                    <label class="form-label">Multi Image</label>
                                    <input type="file" autocomplete="off" class="form-control" id="multiImg"
                                        name="multi_img[]" multiple="">

                                    <div class="row mt-3" id="preview_img"></div>
                                </div> --}}

                            </div>

                            <div class="col-12 form-check mb-2">
                                <input type="checkbox" name="featured" value="1"
                                    {{ $property->featured == 1 ? 'checked' : '' }} class="form-check-input"
                                    id="checkDefault">
                                <label class="form-check-label" for="checkDefault">
                                    Featured
                                </label>
                            </div>

                            <div class="col-12 form-check mb-2">
                                <input type="checkbox" value="1" {{ $property->hot == 1 ? 'checked' : '' }}
                                    name="hot" class="form-check-input" id="checkDefault">
                                <label class="form-check-label" for="checkDefault">
                                    Hot
                                </label>
                            </div>
                            <hr>

                            <div class="co-12 mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary me-2 px-3">Update Property</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12">

                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <a onclick="addRoomNo()" id="addRoomNo" class="btn btn-inverse-info mb-3">Add Multi Image</a>

                            <div id="roomnoHide" class="roomnoHide">
                                <form action="{{route('store.agent.multiimage')}}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="imageId" value="{{$property->id}}">
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="mb-4">Add Image</h5>
                                        </div>
                                        <div class="col-8">
                                            <input type="file" name="multi_img" class="form-control">
                                        </div>
                                        <div class="col-4">
                                            <input type="submit" autocomplete="off" value="Add Image"
                                                class="btn btn-inverse-light">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="roomview">
                                <h6 class="card-title mt-5">Multi Image</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Change</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <form action="{{route('update.agent.multiimage')}}" method="post" enctype="multipart/form-data">

                                            @csrf

                                            @foreach ($multiImg as $key => $img)
                                                <tbody>
                                                    <tr>
                                                        <th>{{ $key + 1 }}</th>
                                                        <td>
                                                            <img src="{{ asset($img->photo) }}"
                                                                style="width: 60px; height: 60px;" class="rounded-0"
                                                                alt="">
                                                        </td>
                                                        <td>
                                                            <input type="file" class="form-control" name="multi_img[{{$img->id}}]">
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-inverse-primary">Upload
                                                                Image</button>
                                                            <a href="{{route('delete.agent.multiimg',$img->id)}}"
                                                                class="btn btn-inverse-warning px-3" id="delete">Delete</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        </form>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- <div class="row">

            <div class="col-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        <a onclick="addRoomNo()" id="addRoomNo" class="btn btn-inverse-info px-4">Add MultiImage</a>

                        <div class="roomnoHide" id="roomnoHide">
                            <form action="{{ route('store.new.multiimage') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="imageid" value="{{ $property->id }}">
                                <div class="row">
                                    <div class="col-8">
                                        <input type="file" name="multi_img" class="form-control">
                                    </div>
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-inverse-primary">Add Image</button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12" id="roomview">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Multi Image</h6>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl NO</th>
                                        <th>Image</th>
                                        <th>Change</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="{{ route('update.multiimg') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        @foreach ($multiImg as $key => $img)
                                            <tr>
                                                <th>{{ $key + 1 }}</th>
                                                <td>
                                                    <img src="{{ asset($img->photo) }}"
                                                        style="width: 60px; height: 60px;" class="rounded-0"
                                                        alt="">
                                                </td>
                                                <td>
                                                    <input type="file" name="multi_img[{{ $img->id }}]"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-inverse-info">Upload
                                                        Image</button>
                                                    <a href="{{route('delete.multiimg',$img->id)}}" class="btn btn-inverse-warning"
                                                        id="delete">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                </tbody>
                            </table>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

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
    {{-- start room Number --}}

    <script>
        $('#roomnoHide').hide();
        $('#roomview').show();

        function addRoomNo() {
            $('#roomnoHide').show();
            $('#roomview').hide();
            $('#addRoomNo').hide();
        }
    </script>
@endsection
