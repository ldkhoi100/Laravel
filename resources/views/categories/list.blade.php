@extends('layouts.app')

@section('title', 'List Categories')

@section('search')
@include('categories.search')
@endsection

@section('content')

<link rel="stylesheet" href="{{ asset('css/view.css') }}">

<div class="container">

    <div class=" col-12">
        @include('partials.message')
    </div>

    <div class="col-md-12">
        <h2>List Categories</h2>
        <a href="{{ route('categories.trash') }}" class="btn btn-warning float-right">Trash</a>
    </div>

    <div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>
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
                        <th scope="col">Total Posts</th>
                        <th scope="col">User</th>
                        <th scope="col">Create at</th>
                        <th scope="col">Update at</th>
                        <th colspan="2"></th>
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
                            <a class="limited-text" href="{{ route('categories.show', $category->id) }}"> Show </a>
                        </td>

                        <td>{{ count($category->posts) }}</td>

                        <td>{{ $category->users->username }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>

                        <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info">Edit</a></td>

                        <td>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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

            <div style="float:right"> {{ $categories->appends(request()->query()) }} </div>

        </div>

    </div>

</div>

@endsection