@extends('layouts.app')

@section('title', 'Create New Category')

@section('content')

<div class="container">
    <div class="row">

        <div class="col-md-12">

            <h2>Create New Category</h2>

        </div>

        @include('partials.message')

        <div class="col-md-12">

            <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">

                @csrf

                <div class="form-group">

                    <label>Name</label>

                    <input type="text" class="form-control" name="name" required>

                </div>

                <button type="submit" class="btn btn-primary">Create</button>

                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancle</button>

            </form>

        </div>

    </div>
</div>
@endsection