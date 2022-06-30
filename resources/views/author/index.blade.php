@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <h2 class="text-center">Authors List</h2>
  @if ($message = Session::get('success'))
    <div class="alert-success py-2 my-3">{{ $message }}</div>
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
      <tr>
        <td>1</td>
        <td>Photo</td>
        <td>Mg Mg</td>
        <td>mgmg@gmail.com</td>
        <td>09876554354</td>
        <td>1/2, 66th street, Yangon</td>
        <td>
          <a href="" class="btn btn-primary btn-sm">Edit</a>
          <a href="" class="btn btn-danger btn-sm">Delete</a>
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection