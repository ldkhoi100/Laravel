@extends('layouts.app')

@section('title', 'Trash Categories')

@section('search')
@include('categories.searchTrash')
@endsection

@section('content')

<link rel="stylesheet" href="{{ asset('css/view.css') }}">

<div class="container">

    <div class="col-12">
        @include('partials.message')
    </div>

    <div class="col-md-12">
        <h2>Trash Categories</h2>
    </div>

    <div class="col-12">
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Home</a>

        <a href="{{ route('categories.delete-all') }}" class="btn btn-danger float-right"
            onclick="return confirm('Do you want delete all? You will not be able to recover!')">Delete all</a>
        <a href="{{ route('categories.restore-all') }}" class="btn btn-warning float-right mr-2"
            onclick="return confirm('Do you want restore all?')">Restore all</a>
    </div>

    <br />

    <div class="row">

        <div class="col-md-12">

            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Show</th>
                        <th scope="col">Total Post</th>
                        <th scope="col">User</th>
                        <th scope="col">Deleted at</th>
                        <th colspan="3"></th>
                    </tr>

                </thead>

                <tbody>

                    @if(count($categories) == 0)

                    <td colspan="9" class="text-center font-weight-bold">No data</td>

                    @else

                    @foreach($categories as $key => $category)

                    <tr>

                        <th scope="row">{{ ++$key }}</th>
                        <td>
                            <a class="limited-text"
                                href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
                        </td>
                        <td>
                            <a class="limited-text" href="{{ route('categories.show', $category->id) }}">Show</a>
                        </td>
                        <td>{{ count($category->posts) }}</td>
                        <td>{{ $category->users->username }}</td>
                        <td>{{ $category->deleted_at->format("d-m-Y H:i:s") }}</td>

                        <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info">Edit</a></td>

                        <td><a href="{{ route('categories.restore', $category->id) }}" class="btn btn-warning"
                                onclick="return confirm('Do you want restore {{ $category->title }}?')">Restore</a></td>

                        <td>
                            <a href="{{ route('categories.delete', $category->id) }}" class="btn btn-danger"
                                onclick="return confirm('Do you want delete {{ $category->title }} forever?')">Delete
                                Forever</a>
                        </td>

                    </tr>

                    @endforeach

                    @endif

                </tbody>

            </table>

            <div style="float:right"> {{ $categories->appends(request()->query()) }} </div>

        </div>

    </div>

</div>
@endsection