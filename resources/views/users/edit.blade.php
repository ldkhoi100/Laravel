@extends('layouts.app')

@section('title', 'Update User')

@section('content')

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <h2>Update User</h2>

        </div>

        @include('partials.message')

        <div class="col-md-12">

            <form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <div class="form-group">

                    <label>Name</label>

                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>

                </div>

                <div class="form-group">

                    <label>Email</label>

                    <input type="text" class="form-control" name="email" value="{{ $user->email }}" required>

                </div>

                <div class="form-group">

                    <label>Phone</label>

                    <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>

                </div>

                <div class="form-group">

                    <label>Role</label>

                    <select name="role" id="" class="form-control">
                        @foreach ($roles as $role)

                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">

                    <label>New Password</label>

                    <input type="text" class="form-control" name="password">

                </div>

                <button type="submit" class="btn btn-primary">Update</button>

                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancle</button>

            </form>

        </div>

    </div>

</div>

@endsection