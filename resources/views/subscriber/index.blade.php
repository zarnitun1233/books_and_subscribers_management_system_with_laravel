@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <h2 class="text-center">Subscriber List</h2>
  @if ($message = Session::get('success'))
  <div class="alert-success p-2 my-3">{{ $message }}</div>
  @endif
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @php $number = 1; @endphp

    </tbody>
  </table>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $.ajax({
    type: 'GET',
    url: "http://localhost:8000/api/subscribe",
    success: function(result) {
      result.forEach(post => {
        $("tbody").append(`<tr>
        <td>${post.id}</td>
        <td>${post.name}</td>
        <td>${post.email}</td>
        <td class="align-middle">
          <!--Display flex for edit and delete buttons-->
          <div class="d-flex flex-row">
            <a href="" class="btn btn-primary btn-sm">Edit</a>
            <form action="" method="POST" class="align-middle mx-2">
              @csrf
              @method('delete')
              <button class="btn btn-danger btn-sm">Delete</button>
            </form>
          </div>
          <!--/.Display flex for edit and delete buttons-->
        </td>
        </tr>`);
      });
    }
  });
</script>
@endsection