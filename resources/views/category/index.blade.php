@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <h2 class="text-center">Category List</h2>
  @if ($message = Session::get('success'))
  <div class="alert-success p-2 my-3">{{ $message }}</div>
  @endif
  <div class="text-end">
    <a href="{{ route('category.create') }}" class="btn btn-success">Create</a>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @php $number = 1; @endphp
      @foreach ($categories as $category)
      <tr>
        <td class="align-middle">{{ $number++ }}</td>
        <td class="align-middle">{{ $category->name }}</td>
        <td class="align-middle">
          <!--Display flex for edit and delete buttons-->
          <div class="d-flex flex-row">
            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
            <form action="" method="POST" class="align-middle mx-2">
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