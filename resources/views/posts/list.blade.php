@extends('layouts.app')

@section('title', 'List Posts')

@section('search')
@include('posts.search')
@endsection

@section('content')

<link rel="stylesheet" href="{{ asset('css/view.css') }}">

<div class="container">

    <div class=" col-12">
        @include('partials.message')
    </div>

    <div class="col-md-12">
        <h2>List Posts</h2>
        <a href="{{ route('posts.trash') }}" class="btn btn-warning float-right">Trash</a>
    </div>

    <div>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
    </div>

    <br />

    <div class="row">

        <div class="col-md-12">

            <table class="table table-striped">

                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" width=20%>Title</th>
                        <th scope="col" width=15%>Content</th>
                        <th scope="col">Image</th>
                        <th scope="col">User</th>
                        <th scope="col">Create at</th>
                        <th scope="col">Update at</th>
                        <th></th>
                        <th></th>
                    </tr>

                </thead>

                <tbody>

                    @if(count($posts) == 0)

                    <td colspan="10" class="text-center font-weight-bold">No data</td>

                    @else

                    @foreach($posts as $key => $post)

                    <tr>

                        <th scope="row">{{ ++$key }}</th>
                        <td>
                            <a class="limited-text" href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                        </td>

                        <td>
                            <a class="limited-text" href="{{ route('posts.show', $post->id) }}">Show content</a>
                        </td>

                        <td>
                            @if($post->image)
                            <img id="zoom" src="data:image;base64, {{ $post->image }}" width="60px" height="60px">
                            @else
                            {{'No image'}}
                            @endif
                        </td>

                        <td>{{ $post->users->username }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>

                        <td><a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info">Edit</a></td>

                        <td>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Do you want delete?')"
                                    class="btn btn-danger">Delete</button>
                            </form>
                        </td>

                    </tr>

                    @endforeach

                    @endif

                </tbody>

            </table>

            <div style="float:right"> {{ $posts->appends(request()->query()) }} </div>

        </div>

    </div>

</div>

@endsection