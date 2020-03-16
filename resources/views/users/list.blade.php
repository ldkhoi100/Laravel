@extends('layouts.app')

@section('title', 'List Categories')

{{--  @section('search')
@include('categories.search')
@endsection  --}}

@section('content')

{{--  <div class="container">  --}}

<div class=" col-12">
    @include('partials.message')
</div>

<br />

<div class="row">

    <div class="col-md-12">

        <table class="table table-striped">

            <thead>

                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email verified at</th>
                    <th scope="col">Is admin</th>
                    <th scope="col">Role</th>
                    <th scope="col">Total posts</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th colspan="2"></th>
                </tr>

            </thead>

            <tbody>

                @if(count($users) == 0)

                <td colspan="12" class="text-center font-weight-bold">No data</td>

                @else

                @foreach($users as $key => $user)

                <tr>

                    <th scope="row">{{ ++$key }}</th>

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->username }}</td>

                    <td>{{ $user->email }}</td>

                    <td>{{ $user->phone }}</td>

                    <td>{{ $user->email_verified_at }}</td>

                    <td>{{ $user->is_admin }}</td>

                    @foreach ($user->roles as $roles)
                    @if(empty($roles->name))
                    <td></td>
                    @else
                    <td>{{ $roles->name }}</td>
                    @endif
                    @endforeach

                    <td>{{ count($user->posts) }}</td>

                    <td>{{ $user->created_at->format("d-m-Y H:i:s") }}</td>
                    <td>{{ $user->updated_at->format("d-m-Y H:i:s") }}</td>
                    <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a></td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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

        <div style="float:right"> {{ $users->appends(request()->query()) }} </div>

    </div>

</div>

{{--  </div>  --}}

@endsection