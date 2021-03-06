@extends('layouts.app')

@section('title', 'Update Post')

@section('content')

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <h2>Update Post</h2>

        </div>

        @include('partials.message')

        <div class="col-md-12">

            <form method="post" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <div class="form-group">

                    <label>Title</label>

                    <input type="text" class="form-control" name="title" value="{{ $post->title }}" required>

                </div>

                <div class="form-group">

                    <label>Content</label>

                    <textarea class="form-control" rows="3" name="content" required>{!! $post->content !!}</textarea>

                </div>

                <div class="form-group">

                    <label>Categories</label>

                    <select name="category_id" id="" class="form-control">
                        @foreach ($categories as $category)

                        <option @if($category->id == $post->category_id)
                            {{ "selected" }}
                            @endif
                            value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">

                    <label>Image</label>

                    <input id="imgPost" type="file" name="image" class="form-control" onchange="readURL(event)">

                    <img id="zoom" src="data:image;base64, {{ $post->image }}" alt="" srcset="" width="200"
                        height="200">

                </div>

                <button type="submit" class="btn btn-primary">Update</button>

                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancle</button>

            </form>

        </div>

    </div>

</div>

@endsection