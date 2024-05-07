<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Real<span>Estate</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Message</li>

            {{-- Comment --}}
            @if (Auth::user()->can('comment.menu'))
                <li class="nav-item">
                    <a href="{{ route('all.comment') }}" class="nav-link">
                        <i class="link-icon" data-feather="message-square"></i>
                        <span class="link-title">Comment</span>
                    </a>
                </li>
            @endif
            {{-- Comment --}}

            <li class="nav-item nav-category">RealState</li>

            {{-- Type  --}}
            @if (Auth::user()->can('type.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#type" role="button" aria-expanded="false"
                        aria-controls="uiComponents">
                        <i class="link-icon" data-feather="message-square"></i>
                        <span class="link-title">Property Type</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="type">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.type'))
                                <li class="nav-item">
                                    <a href="{{ route('all.type') }}" class="nav-link">All Type</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.type'))
                                <li class="nav-item">
                                    <a href="{{ route('add.type') }}" class="nav-link">Add Type</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            {{-- Type  --}}

            {{-- Amenitie  --}}
            @if (Auth::user()->can('amenitie.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#amenitie" role="button" aria-expanded="false"
                        aria-controls="uiComponents">
                        <i class="link-icon" data-feather="message-square"></i>
                        <span class="link-title">Amenitie</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="amenitie">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.amenitie'))
                                <li class="nav-item">
                                    <a href="{{ route('all.amenitie') }}" class="nav-link">All Amenitie</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.amenitie'))
                                <li class="nav-item">
                                    <a href="{{ route('add.amenitie') }}" class="nav-link">Add Amenitie</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            {{-- Amenitie  --}}

            {{-- State  --}}
            @if (Auth::user()->can('state.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#state" role="button" aria-expanded="false"
                        aria-controls="uiComponents">
                        <i class="link-icon" data-feather="message-square"></i>
                        <span class="link-title">State</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="state">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.state'))
                                <li class="nav-item">
                                    <a href="{{ route('all.state') }}" class="nav-link">All State</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.state'))
                                <li class="nav-item">
                                    <a href="{{ route('add.state') }}" class="nav-link">Add State</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            {{-- State  --}}

            {{-- Property --}}
            @if (Auth::user()->can('property.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#property" role="button" aria-expanded="false"
                        aria-controls="uiComponents">
                        <i class="link-icon" data-feather="message-square"></i>
                        <span class="link-title">Property</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="property">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.propert'))
                                <li class="nav-item">
                                    <a href="{{ route('all.property') }}" class="nav-link">All Property</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.propert'))
                                <li class="nav-item">
                                    <a href="{{ route('add.property') }}" class="nav-link">Add Property</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            {{-- Property --}}

            {{-- Testimonial --}}
            @if (Auth::user()->can('testimonial.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#testimonial" role="button"
                        aria-expanded="false" aria-controls="uiComponents">
                        <i class="link-icon" data-feather="message-square"></i>
                        <span class="link-title">Testimonial</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="testimonial">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.testimonial'))
                                <li class="nav-item">
                                    <a href="{{ route('all.testimonial') }}" class="nav-link">All Testimonial</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.testimonial'))
                                <li class="nav-item">
                                    <a href="{{ route('add.testimonial') }}" class="nav-link">Add Testimonial</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            {{-- Testimonial --}}

            {{-- Blog Category --}}
            @if (Auth::user()->can('category.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#blog" role="button"
                        aria-expanded="false" aria-controls="uiComponents">
                        <i class="link-icon" data-feather="message-square"></i>
                        <span class="link-title">Blog Category</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="blog">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.category'))
                                <li class="nav-item">
                                    <a href="{{ route('all.category') }}" class="nav-link">All Category</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.category'))
                                <li class="nav-item">
                                    <a href="{{ route('add.category') }}" class="nav-link">Add Category</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            {{-- Blog Category --}}

            {{-- Blog Post --}}
            @if (Auth::user()->can('post.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#post" role="button"
                        aria-expanded="false" aria-controls="uiComponents">
                        <i class="link-icon" data-feather="message-square"></i>
                        <span class="link-title">Blog Post</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="post">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.post'))
                                <li class="nav-item">
                                    <a href="{{ route('all.post') }}" class="nav-link">All Post</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.post'))
                                <li class="nav-item">
                                    <a href="{{ route('add.post') }}" class="nav-link">Add Post</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            {{-- Blog Post --}}

            {{-- Site Setting  --}}
            @if (Auth::user()->can('site.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#site" role="button"
                        aria-expanded="false" aria-controls="uiComponents">
                        <i class="link-icon" data-feather="message-square"></i>
                        <span class="link-title">Site Setting</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="site">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.site'))
                                <li class="nav-item">
                                    <a href="{{ route('all.site') }}" class="nav-link">All Site</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.site'))
                                <li class="nav-item">
                                    <a href="{{ route('add.site') }}" class="nav-link">Add Site</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            {{-- Site Setting --}}


            <li class="nav-item nav-category">Manage Section</li>

            {{-- Agent Manage  --}}
            @if (Auth::user()->can('agent.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#agent" role="button"
                        aria-expanded="false" aria-controls="general-pages">
                        <i class="link-icon" data-feather="book"></i>
                        <span class="link-title">Agent Manage</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="agent">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('all.agent') }}" class="nav-link">All Agent</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            {{-- Agent Manage  --}}

            {{-- Role & Permission --}}
            @if (Auth::user()->can('role.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#role" role="button"
                        aria-expanded="false" aria-controls="general-pages">
                        <i class="link-icon" data-feather="book"></i>
                        <span class="link-title">Role & Permission</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="role">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('all.permission') }}" class="nav-link">All Permission</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('all.role') }}" class="nav-link">All Role</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('all.roles.permission') }}" class="nav-link">Role In Permission</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('add.roles.permission') }}" class="nav-link">Add Role In
                                    Permission</a>
                            </li>
                            {{-- <li class="nav-item">
                            <a href="pages/general/faq.html" class="nav-link">Faq</a>
                        </li> --}}
                        </ul>
                    </div>
                </li>
            @endif
            {{-- Role & Permission --}}

            {{-- Admin Manage --}}
            @if (Auth::user()->can('admin.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#admin" role="button"
                        aria-expanded="false" aria-controls="general-pages">
                        <i class="link-icon" data-feather="book"></i>
                        <span class="link-title">Admin Manage</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="admin">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('all.admin') }}" class="nav-link">All Admin</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('all.admin') }}" class="nav-link">Add Admin</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            {{-- Admin Manage --}}



            <li class="nav-item nav-category">Docs</li>

            <li class="nav-item">
                <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
