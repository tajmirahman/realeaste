@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <style>
        .form-check-label
        {
            text-transform: capitalize;
        }
    </style>

    <div class="page-content">
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card p-3">
                    <div class="card-body">

                        <h6 class="card-title">Add Role Permission</h6>

                        <form action="{{ route('store.roles.permission') }}" id="myForm" class="forms-sample" method="POST">
                            @csrf

                            <div class="col-12 form-group mb-4">
                                <label class="form-label">Role Name</label>
                                <select class="form-select" name="role_id">
                                    <option selected disabled>Select Role Name</option>

                                    @foreach ($role as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-12 form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="checkDefaultmain">
                                <label class="form-check-label" for="checkDefaultmain">
                                    All Permission
                                </label>
                            </div>

                            <hr>


                            {{-- Start Group  --}}

                            @foreach ($permission_groups as $group)
                                <div class="row">

                                    <div class="col-3">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="checkDefault">
                                            <label class="form-check-label" for="checkDefault">
                                                {{ $group->group_name }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-9">

                                        @php
                                            $permissions = App\Models\User::getpermissionByGroupName($group->group_name);
                                        @endphp

                                        @foreach ($permissions as $permission)
                                            <div class="form-check mb-3">

                                                <input type="checkbox" class="form-check-input"
                                                    id="checkDefault{{ $permission->id }}" name="permission[]"
                                                    value="{{ $permission->id }}">

                                                <label class="form-check-label" for="checkDefault{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>

                                            </div>
                                        @endforeach
                                        <br>
                                    </div>

                                </div>
                            @endforeach

                            {{-- End Group  --}}



                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-primary me-2 px-3">Save Change</button>
                            </div>


                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $('#checkDefaultmain').click(function() {

            if ($(this).is(':checked')) {
                $('input[ type= checkbox]').prop('checked', true);
            } else {
                $('input[ type= checkbox]').prop('checked', false);
            }

        });
    </script>

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
