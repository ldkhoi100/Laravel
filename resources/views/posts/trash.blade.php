@extends('layouts.app')

@section('title', 'Trash Posts')

@section('search')
@include('posts.searchTrash')
@endsection

@section('content')

<link rel="stylesheet" href="{{ asset('css/view.css') }}">

<div class="container">

    <div class="col-12">
        @include('partials.message')
    </div>

    <div class="col-md-12">
        <h2>Trash Posts</h2>
    </div>

    <div class="col-12">
        <a href="{{ route('posts.index') }}" class="btn btn-primary">Home</a>

        <a href="{{ route('posts.delete-all') }}" class="btn btn-danger float-right"
            onclick="return confirm('Do you want delete all? You will not be able to recover!')">Delete all</a>
        <a href="{{ route('posts.restore-all') }}" class="btn btn-warning float-right mr-2"
            onclick="return confirm('Do you want restore all?')">Restore all</a>
    </div>

    <br />

    <div class="row">

        <div class="col-md-12">

            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" width=20%>Title</th>
                        <th scope="col" width=13%>Content</th>
                        <th scope="col">Category</th>
                        <th scope="col">Image</th>
                        <th scope="col">User Created</th>
                        <th scope="col">User Updated</th>
                        <th scope="col">Deleted at</th>
                        <th></th>
                        <th></th>
                        <th scope="col"></th>
                    </tr>

                </thead>

                <tbody>

                    @if(count($posts) == 0)

                    <td colspan="11" class="text-center font-weight-bold">No data</td>

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
                        <td>{{ $post->categories->name }}</td>
                        <td>
                            @if($post->image)
                            <img src="data:image;base64, {{ $post->image }}" width="60px" height="60px">
                            @else
                            {{'No image'}}
                            @endif
                        </td>

                        @if(empty($post->users->username))
                        <td></td>
                        @else
                        <td>{{ $post->users->username }}</td>
                        @endif

                        @if(empty($post->users_update->username))
                        <td></td>
                        @else
                        <td>{{ $post->users_update->username }}</td>
                        @endif

                        <td>{{ $post->deleted_at->format("d-m-Y H:i:s") }}</td>

                        <td><a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info">Edit</a></td>

                        <td><a href="{{ route('posts.restore', $post->id) }}" class="btn btn-warning"
                                onclick="return confirm('Do you want restore {{ $post->title }}?')">Restore</a></td>

                        <td>
                            <a href="{{ route('posts.delete', $post->id) }}" class="btn btn-danger"
                                onclick="return confirm('Do you want delete {{ $post->title }} forever?')">Delete
                                Forever</a>
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