@extends('agent.agent_dashboard')
@section('agent')
    <div class="page-content">

        <div class="row inbox-wrapper">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row">



                            <div class="col-lg-12">
                                <div class="d-flex align-items-center justify-content-between p-3 border-bottom tx-16">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="star" class="text-primary icon-lg me-2"></i>
                                        <span>Full Message</span>
                                    </div>
                                    <div>

                                        <a href="{{route('message.delete',$message->id)}}" id="delete"><i data-feather="trash" class="text-muted icon-lg"></i></a>

                                    </div>
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-between flex-wrap px-3 py-2 border-bottom">
                                    @php
                                        $id = Auth::user()->id;
                                        $userData = App\Models\User::find($id);
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <img src="{{!empty($userData->photo) ? url('upload/agent_images/'.$userData->photo) : url('upload/no_image.jpg')}}" alt="Avatar"
                                                class="rounded-circle img-xs">
                                        </div>


                                        <div class="d-flex align-items-center">
                                            <a href="#" class="text-body">Mr {{ $userData->name }}</a>

                                        </div>
                                    </div>
                                    <div class="tx-13 text-muted mt-2 mt-sm-0"> {{ $message->created_at->format('d-M-y') }}
                                    </div>
                                </div>
                                <div class="p-4 border-bottom">
                                    <p>{{ $message->message }}</p>
                                    <br>
                                    <p><strong>Regards</strong>,<br> {{ $message->msg_name }}</p>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
