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
            <tr>
                <td class="align-middle">1</td>
                <td class="align-middle">King Author</td>
                <td class="align-middle">Photo</td>
                <td class="align-middle">thirller, history, comic type, best sellor</td>
                <td class="align-middle">King Author</td>
                <td class="align-middle">history</td>
                <td class="align-middle">1.2.1999</td>
                <td class="align-middle">
                    <a href="" class="btn btn-info btn-sm">Publish</a>
                </td>
                <td class="align-middle">Book</td>
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
            </tr>
        </tbody>
    </table>
</div>
@endsection