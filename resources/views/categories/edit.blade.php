@extends('layouts.app')

@section('title', 'Update Category')

@section('content')

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <h2>Update Post</h2>

        </div>

        @include('partials.message')

        <div class="col-md-12">

            <form method="post" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <div class="form-group">

                    <label>Name</label>

                    <input type="text" class="form-control" name="name" value="{{ $category->name }}" required>

                </div>

                <button type="submit" class="btn btn-primary">Update</button>

                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancle</button>

            </form>

        </div>

    </div>

</div>

@endsection