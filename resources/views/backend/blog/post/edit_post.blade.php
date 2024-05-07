@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Blog Post</h6>

                        <form action="{{ route('update.post') }}" id="myForm" class="forms-sample" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{$editPost->id}}">
                            <input type="hidden" name="old_image" value="{{$editPost->post_image}}">

                            <div class="row">
                                <div class="col-12 form-group mb-3 ">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ $editPost->post_title }}" name="post_title">
                                </div>

                                <div class="col-6 form-group mb-3 ">
                                    <label class="form-label">Blog Category</label>
                                    <select class="form-select" name="blogcat_id">
                                        <option selected disabled>Select Category</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $editPost->blogcat_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 form-group mb-3 ">
                                    <label class="form-label">Tags</label>
                                    <input type="text" id="tags" class="form-control" autocomplete="off"
                                        value="{{ $editPost->post_title }}" name="post_tags">
                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Short Descp</label>
                                    <textarea name="short_descp" class="form-control" cols="4" rows="4">{{ $editPost->short_descp }}</textarea>
                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Long Descp</label>
                                    <textarea id="myeditorinstance" name="long_descp" class="form-control">{!! $editPost->short_descp !!}</textarea>
                                </div>

                                <div class="col-12 form-group mb-4">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="post_image" class="form-control mb-2" id="image"
                                        autocomplete="off">

                                    <img class="img-xs rounded-0" src="{{ asset($editPost->post_image) }}" id="showImage"
                                        style="width: 100px;height: 100px;" alt="">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary me-2 px-3">Edit Blog Post</button>
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
                    category_name: {
                        required: true,
                    },
                },
                messages: {
                    category_name: {
                        required: 'Please Enter Category Name',
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
