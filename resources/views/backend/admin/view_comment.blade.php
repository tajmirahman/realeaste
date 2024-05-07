@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <div class="row inbox-wrapper">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12">
                                <div>
                                    <div class="d-flex align-items-center p-3 border-bottom tx-16">
                                        <span data-feather="edit" class="icon-md me-2"></span>
                                        <h4>view Comment</h4>
                                    </div>
                                </div>
                                <div class="p-3 pb-0">

                                    <form action="{{route('reply.comment')}}" method="post">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $comments->id }}">

                                        <input type="hidden" name="user_id" value="{{ $comments->user_id }}">

                                        <input type="hidden" name="blog_id" value="{{ $comments->blog_id }}">

                                        <div class="subject">
                                            <div class="row mb-3">

                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">User Name</label>
                                                    <input disabled value="{{ $comments['user']['name'] }}"
                                                        class="form-control" type="text">
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Post Title</label>
                                                    <input disabled value="{{ $comments['post']['post_title'] }}"
                                                        class="form-control" type="text">
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Subject</label>
                                                    <input name="subject" value="{{ $comments->subject }}"
                                                        class="form-control" type="text">
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Message</label>
                                                    <textarea disabled class="form-control" name="" id="" cols="7" rows="7">{{ $comments->message }}</textarea>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Reply Message</label>
                                                    <textarea name="message" class="form-control" name="" id="" cols="5" rows="5"></textarea>
                                                </div>

                                                <div class="col-md-12">
                                                    <button class="btn btn-primary me-1 mb-1 px-3"
                                                        type="submit">Reply</button>
                                                </div>

                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
