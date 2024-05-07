@extends('agent.agent_dashboard')
@section('agent')
    <div class="page-content">

        <div class="row inbox-wrapper">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-lg-3 border-end-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <button class="navbar-toggle btn btn-icon border d-block d-lg-none"
                                        data-bs-target=".email-aside-nav" data-bs-toggle="collapse" type="button">
                                        <span class="icon"><i data-feather="chevron-down"></i></span>
                                    </button>
                                    @php
                                        $id = Auth::user()->id;
                                        $useData = App\Models\User::find($id);
                                    @endphp
                                    <div class="order-first">
                                        <h4>{{ $useData->name }}</h4>
                                        <p class="text-muted">{{ $useData->email }}</p>
                                    </div>
                                </div>
                                <div class="d-grid my-3">
                                    <a class="btn btn-primary" href="./compose.html">Compose Email</a>
                                </div>
                                <div class="email-aside-nav collapse">
                                    <ul class="nav flex-column">
                                        <li class="nav-item active">
                                            <a class="nav-link d-flex align-items-center" href="../email/inbox.html">
                                                <i data-feather="inbox" class="icon-lg me-2"></i>
                                                Inbox
                                                <span class="badge bg-danger fw-bolder ms-auto">{{ count($agentMessage) }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center" href="#">
                                                <i data-feather="mail" class="icon-lg me-2"></i>
                                                Sent Mail
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center" href="#">
                                                <i data-feather="file" class="icon-lg me-2"></i>
                                                Drafts
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center" href="#">
                                                <i data-feather="trash" class="icon-lg me-2"></i>
                                                Trash
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>

                            <div class="col-lg-9">
                                <div class="p-3 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="d-flex align-items-end mb-2 mb-md-0">
                                                <i data-feather="inbox" class="text-muted me-2"></i>
                                                <h4 class="me-1">Inbox</h4>
                                                <span class="text-muted">({{ count($agentMessage) }} new messages)</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="email-list">

                                    <!-- email list item -->
                                    @foreach ($agentMessage as $message)
                                        <div class="email-list-item">
                                            <div class="email-list-actions">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input">
                                                </div>
                                                <a class="favorite" href="#"><span><i data-feather="star"
                                                            class="text-warning"></i></span></a>
                                            </div>
                                            <a href="{{route('agent.message.full',$message->id)}}" class="email-list-detail">
                                                <div class="content">
                                                    <span class="from">{{ $message->msg_name }}</span>
                                                    <p class="msg">{{ $message->message }}</p>
                                                </div>
                                                <span class="date">
                                                    {{ $message->created_at->format('d-M-y') }}
                                                </span>
                                            </a>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
