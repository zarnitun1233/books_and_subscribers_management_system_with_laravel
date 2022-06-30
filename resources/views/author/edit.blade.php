@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="text-center">Edit Author</h2>
  <div class="card">
    <div class="card-header">Edit Author</div>
    <div class="card-body">
      <form action="{{ route('author.update', $author->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row mb-3">
          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
          <div class="col-md-6">
            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $author->name }}" required autofocus>
            @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
          </div>
        </div>

        <div class="form-group row mb-3">
          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
          <div class="col-md-6">
            <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $author->email }}" required autofocus>
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
          </div>
        </div>

        <div class="form-group row mb-3">
          <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
          <div class="col-md-6">
            <input type="tel" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $author->phone }}" required autofocus>
            @if ($errors->has('phone'))
            <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
          </div>
        </div>

        <div class="form-group row mb-3">
          <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
          <div class="col-md-6">
            <textarea name="address" id="address" rows="2" class="form-control @error('address') is-invalid @enderror" required autofocus>{{ $author->address }}</textarea>
            @if ($errors->has('address'))
            <span class="text-danger">{{ $errors->first('address') }}</span>
            @endif
          </div>
        </div>

        <div class="form-group row mb-3">
          <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>
          <div class="col-md-6">
          <img src='{{ asset("photos/author_photos/$author->photo") }}' alt="Author Photo" class="img-thumbnail">
            <input type="file" id="photo" class="form-control @error('photo') is-invalid @enderror mt-3" name="photo" value="{{ $author->photo }}" autofocus>
            @if ($errors->has('photo'))
            <span class="text-danger">{{ $errors->first('photo') }}</span>
            @endif
          </div>
        </div>

        <div class="form-group row mb-3">
          <div class="col text-end" style="padding-right: 195px;">
          <a href="{{ route('author.index') }}" class="btn btn-secondary">Back</a>
            <input type="submit" value="Edit" class="btn btn-primary">
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection