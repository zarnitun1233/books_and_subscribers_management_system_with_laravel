@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <h2 class="text-center">Book List</h2>
  @if ($message = Session::get('success'))
  <div class="alert-success p-2 my-3">{{ $message }}</div>
  @endif
  <div class="text-end">
    <a href="{{ route('book.create') }}" class="btn btn-success">Create</a>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Title</th>
        <th>Photo</th>
        <th>Description</th>
        <th>Author</th>
        <th>Category</th>
        <th>Published Date</th>
        <th>Published Status</th>
        <th>Book</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @php $number = 1; @endphp

      @foreach ($books as $book)
      <tr>
        <td class="align-middle">{{ $number++ }}</td>
        <td class="align-middle">{{ $book->title }}</td>
        <td class="align-middle"><img src='{{ asset("photos/books_cover_photo/$book->photo") }}' alt="Book's Cover Photo" style="width: 30px;"></td>
        <td class="align-middle">{{ $book->description }}</td>
        <td class="align-middle">{{ str_replace(array( '[', ']', '"' ), '', json_decode($book->author)) }}</td>
        <td class="align-middle">{{ str_replace(array( '[', ']', '"' ), '', json_decode($book->category)) }}</td>
        <td class="align-middle">{{ $book->published_date }}</td>
        <td class="align-middle">
          @if ($book->status === 0)
          <a href="" class="btn btn-info btn-sm">Publish</a>
          @else
          Published
          @endif
        </td>
        <td class="align-middle">
          <a href="{{ route('book.download', $book->id) }}">Download</a>
          </a>
        </td>
        <td class="align-middle">
          <!--Display flex for edit and delete buttons-->
          <div class="d-flex flex-row">
            <a href="{{ route('book.edit', $book->id) }}" class="btn btn-primary btn-sm">Edit</a>
            <form action="{{ route('book.delete', $book->id) }}" method="POST" class="align-middle mx-2">
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