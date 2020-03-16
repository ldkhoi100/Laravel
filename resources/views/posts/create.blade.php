@extends('layouts.app')

@section('title', 'Create New Post')

@section('content')

<div class="container">
    <div class="row">

        <div class="col-md-12">

            <h2>Create New Post</h2>

        </div>

        @include('partials.message')

        <div class="col-md-12">

            <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">

                @csrf

                <div class="form-group">

                    <label>Title</label>

                    <input type="text" class="form-control" name="title" required>

                </div>

                <div class="form-group">

                    <label>Content</label>

                    <textarea class="form-control" name="content" cols="100" rows="200" required></textarea>

                </div>

                <div class="form-group">

                    <label>Categories</label>

                    <select name="category_id" id="" class="form-control">
                        @foreach ($categories as $category)

                        <option value="{{ $category->id }}">{{ $category->name }}</option>

                        @endforeach
                    </select>

                </div>

                <div class="form-group">

                    <label>Image</label>

                    <input id="imgPost" type="file" name="image" class="form-control" onchange="readURL(event)">

                    <img id="zoom" src="#" alt="" srcset="" width="200" height="200">

                </div>

                <button type="submit" class="btn btn-primary">Create</button>

                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancle</button>

            </form>

        </div>

    </div>
</div>

@endsection