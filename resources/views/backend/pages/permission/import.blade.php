@extends('admin.admin_dashboard')
@section('admin')
    

    <div class="page-content">
        <div class="row">

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Add Import File</h6>

                        <form action="{{ route('store.import') }}" id="myForm" class="forms-sample" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mt-4">

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Xlsx File</label>
                                    <input type="file" class="form-control" autocomplete="off" name="import_file">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-inverse-primary me-2 px-3">Upload</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
