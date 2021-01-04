@extends('admin.admin')

@section('content')

<div class="container my-4">
    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">User Profile of <strong>{{$user_profile->name}}</strong></h5>
            </div>
            <div class="card-body">
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">

                                <!-- Profile Image -->
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            @if($user_profile->id == 1)
                                            <img class="profile-user-img img-fluid img-circle" src="{{asset('adminlte')}}/dist/img/avator_superadmin.png" alt="User profile picture">
                                            @elseif($employee_profile == 'null')
                                            <img class="profile-user-img img-fluid img-circle" src="{{asset('adminlte')}}/dist/img/member_avator.png" alt="User profile picture">
                                            @elseif($employee_profile->gender == "Male")
                                            <img class="profile-user-img img-fluid img-circle" src="{{asset('adminlte')}}/dist/img/avatar_male.png" alt="User profile picture">
                                            @elseif($employee_profile->gender == "Female")
                                            <img class="profile-user-img img-fluid img-circle" src="{{asset('adminlte')}}/dist/img/avatar_female.png" alt="User profile picture">
                                            @endif
                                        </div>
                                        <p class="text-muted text-center">
                                            @if (Auth::check())
                                        <h3 class="profile-username text-center">{{$user_profile->name}}</h3>
                                        <p class="text-muted text-center">
                                            @foreach($user_profile->getRoleNames() as $userrole)
                                            @if($userrole == 'superadmin')
                                            <span class="right badge badge-pill badge-danger items-center">
                                                {{ $userrole }}
                                            </span>
                                            @endif
                                            @if($userrole == 'admin')
                                            <span class="right badge badge-pill badge-warning">
                                                {{ $userrole }}
                                            </span>
                                            @endif
                                            @if($userrole == 'editor')
                                            <span class="right badge badge-pill badge-primary">
                                                {{ $userrole }}
                                            </span>
                                            @endif
                                            @if($userrole == 'salesman')
                                            <span class="right badge badge-pill badge-info">
                                                {{ $userrole }}
                                            </span>
                                            @endif
                                            @if($userrole == 'member')
                                            <span class="right badge badge-pill badge-success">
                                                {{ $userrole }}
                                            </span>
                                            @endif
                                            @endforeach
                                            @else
                                            <!-- without login user can't see the profile menu, so guest whill not show but I write this line to avoid a problem -->
                                            <a class="d-block">Guest</a>
                                            @endif
                                        </p>
                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item text-sm">
                                                <b>User ID: </b> <a class="float-right">{{$user_profile->id}}</a>
                                            </li>
                                            <li class="list-group-item text-sm">
                                                <b>Email: </b>
                                                <div class="float-right">{{$user_profile->email}}</div>
                                            </li>
                                            <li class="list-group-item text-sm">
                                                <b>Created: </b> <a class="float-right">{{date('d-M-Y', strtotime($user_profile->created_at))}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                                <!-- About Me Box -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">About Me</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Contact</strong>
                                        <p class="text-muted">{{$user_profile->contact}}</p>
                                        <hr>
                                        <strong><i class="fas fa-users-cog mr-1"></i> Role</strong>
                                        <p class="text-muted">
                                            @foreach($user_profile->getRoleNames() as $userrole)
                                            <span class="tag badge badge-pill badge-secondary">
                                                {{ $userrole }}
                                            </span>
                                            @endforeach
                                        </p>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>

                            <!-- /.col -->
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="activity">
                                                <!-- Post -->
                                                <div class="post">
                                                    <div class="user-block">
                                                        @if($user_profile->id == 1)
                                                        <img class="profile-user-img img-fluid img-circle" src="{{asset('adminlte')}}/dist/img/avator_superadmin.png" alt="User profile picture">
                                                        @elseif($employee_profile == 'null')
                                                        <img class="profile-user-img img-fluid img-circle" src="{{asset('adminlte')}}/dist/img/member_avator.png" alt="User profile picture">
                                                        @elseif($employee_profile->gender == "Male")
                                                        <img class="profile-user-img img-fluid img-circle" src="{{asset('adminlte')}}/dist/img/avatar_male.png" alt="User profile picture">
                                                        @elseif($employee_profile->gender == "Female")
                                                        <img class="profile-user-img img-fluid img-circle" src="{{asset('adminlte')}}/dist/img/avatar_female.png" alt="User profile picture">
                                                        @endif
                                                        <span class="username">
                                                            <a href="#">{{$user_profile->name}}</a>
                                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                                        </span>
                                                        <span class="description">Shared publicly - 7:30 PM today</span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p>
                                                        Lorem ipsum represents a long-held tradition for designers,
                                                        typographers and the like. Some people hate it and argue for
                                                        its demise, but others ignore the hate as they create awesome
                                                        tools to help create filler text for everyone from bacon lovers
                                                        to Charlie Sheen fans.
                                                    </p>
                                                </div>
                                                <!-- /.post -->
                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="timeline">
                                                <!-- The timeline -->
                                                <div class="timeline timeline-inverse">
                                                    <!-- timeline time label -->
                                                    <div class="time-label">
                                                        <span class="bg-danger">
                                                            10 Feb. 2014
                                                        </span>
                                                    </div>
                                                    <!-- /.timeline-label -->
                                                    <!-- timeline item -->
                                                    <div>
                                                        <i class="fas fa-envelope bg-primary"></i>

                                                        <div class="timeline-item">
                                                            <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                                            <div class="timeline-body">
                                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                                quora plaxo ideeli hulu weebly balihoo...
                                                            </div>
                                                            <div class="timeline-footer">
                                                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END timeline item -->
                                                </div>
                                            </div>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
            </div>
        </div>
    </div>
</div>

@endsection