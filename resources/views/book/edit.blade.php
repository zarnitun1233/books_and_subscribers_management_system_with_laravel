@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="text-center">Edit Book</h2>
  <div class="card">
    <div class="card-header">Edit Book</div>
    <div class="card-body">
      <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row mb-3">
          <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Cover Photo') }}</label>
          <div class="col-md-6">
            <img src='{{ asset("photos/books_cover_photo/$book->photo") }}' alt="Book Cover Photo" class="img-thumbnail">
            <input type="file" id="photo" class="form-control mt-3 @error('photo') is-invalid @enderror" name="photo" value="{{ $book->photo }}" autofocus>
            @if ($errors->has('photo'))
            <span class="text-danger">{{ $errors->first('photo') }}</span>
            @endif
          </div>
        </div>

        <div class="form-group row mb-3">
          <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
          <div class="col-md-6">
            <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $book->title }}" required autofocus>
            @if ($errors->has('title'))
            <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
          </div>
        </div>

        <div class="form-group row mb-3">
          <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
          <div class="col-md-6">
            <input type="text" id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $book->description }}" required autofocus>
            @if ($errors->has('description'))
            <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
          </div>
        </div>

        <div class="form-group row mb-3">
          <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Author') }}</label>
          <div class="col-md-6">
            <select name="author[]" id="author" class="mt-2 @error('author') is-invalid @enderror" multiple>
              @foreach ($authors as $author)
              <option value="{{ $author->name }}">{{ $author->name }}</option>
              @endforeach
            </select>
            @if ($errors->has('author'))
            <span class="text-danger">{{ $errors->first('author') }}</span>
            @endif
          </div>
        </div>

        <div class="form-group row mb-3">
          <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
          <div class="col-md-6">
            <select name="category[]" id="category" class="@error('category') is-invalid @enderror" multiple>
              @foreach ($categories as $category)
              <option value="{{ $category->name }}">{{ $category->name }}</option>
              @endforeach
            </select>
            @if ($errors->has('category'))
            <span class="text-danger">{{ $errors->first('category') }}</span>
            @endif
          </div>
        </div>


        <div class="form-group row mb-3">
          <label for="published_date" class="col-md-4 col-form-label text-md-right">{{ __('Published Date') }}</label>
          <div class="col-md-6">
            <input type="date" id="published_date" class="form-control @error('published_date') is-invalid @enderror" name="published_date" value="{{ $book->published_date }}" required autofocus>
            @if ($errors->has('published_date'))
            <span class="text-danger">{{ $errors->first('published_date') }}</span>
            @endif
          </div>
        </div>

        <div class="form-group row mb-3">
          <label for="book" class="col-md-4 col-form-label text-md-right">{{ __('Book') }}</label>
          <div class="col-md-6">
            <input type="file" id="book" class="form-control @error('book') is-invalid @enderror" name="book" value="{{ $book->book }}" autofocus>
            @if ($errors->has('book'))
            <span class="text-danger">{{ $errors->first('book') }}</span>
            @endif
          </div>
        </div>

        <div class="form-group row mb-3">
          <div class="col text-end" style="padding-right: 195px;">
            <a href="{{ route('book.index') }}" class="btn btn-secondary">Back</a>
            <input type="submit" value="Edit" class="btn btn-primary">
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/picker.min.js') }}"></script>
<script type="text/javascript">
  $('#author').picker();
  $('#category').picker();
</script>
@endsection