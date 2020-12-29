@extends('admin.admin')

@section('content')

<div class="container my-4">
    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Welcome to our Dokan!</h5>
            </div>
            <div class="card-body">

                <!-- if not authenticated -->
                @if (!Auth::check())
                <p class="card-text">
                    If you are a guest, please register and be a member of our Dokan.

                    <!-- Register -->
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-link text-sm text-gray-700 underline">
                        <i class="fas fa-user-edit mr-2"></i>
                        Register
                    </a>
                    @endif
                </p>

                <p class="card-text">
                    If you already a member, please login and enjoy our products.

                    <!-- Login -->
                    <a href="{{ route('login') }}" class="nav-link text-sm text-gray-700 underline">
                        <i class="fas fa-sign-in-alt mr-3"></i>
                        Login
                    </a>
                </p>
                @endif
                <!-- /if not authenticated -->

                <!-- if authenticated -->
                @if (Auth::check())
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint molestias illum fuga, quo obcaecati inventore ut, pariatur facere tempora laborum magni recusandae accusamus vitae, animi fugiat et a deleniti mollitia?
                </p>
                @endif
                <!-- /if authenticated -->

            </div>
        </div>
    </div>
</div>

@endsection