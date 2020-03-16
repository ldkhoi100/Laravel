@extends('layouts.app')

@section('title', 'Information')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center font-weight-bold">Change Password</div>

                <div class="card-body">
                    @include('partials.message')

                    <form method="post" action="{{ route('details.update', $user->id) }}" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" value="{{ $user->username }}"
                                    disabled>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input class="form-control" name="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password <span
                                    style="color:red;">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password"
                                    autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a class="btn btn-secondary" href="{{ route('home') }}">Cancle</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection