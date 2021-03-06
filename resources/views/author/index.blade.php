@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <h2 class="text-center">Authors List</h2>
  @if ($message = Session::get('success'))
  <div class="alert-success p-2 my-3">{{ $message }}</div>
  @endif
  <div class="text-end">
    <a href="{{ route('author.create') }}" class="btn btn-success">Create</a>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @php $number = 1; @endphp
      @foreach ($authors as $author)
      <tr>
        <td class="align-middle">{{ $number++ }}</td>
        <td class="align-middle"><img src='{{ asset("photos/author_photos/$author->photo")}}' alt="Author Photo" style="width: 50px;"></td>
        <td class="align-middle">{{ $author->name }}</td>
        <td class="align-middle">{{ $author->email }}</td>
        <td class="align-middle">{{ $author->phone }}</td>
        <td class="align-middle">{{ $author->address }}</td>
        <td class="align-middle">
          <!--Display flex for edit and delete buttons-->
          <div class="d-flex flex-row">
            <a href="{{ route('author.edit', $author->id) }}" class="btn btn-primary btn-sm">Edit</a>
            <form action="{{ route('author.delete', $author->id) }}" method="POST" class="align-middle mx-2">
              @csrf
              @method('delete')
              <button class="btn btn-danger btn-sm">Delete</button>
            </form>
          </div>
          <!--/.Display flex for edit and delete buttons-->
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection