@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="text-center">Create Category</h2>
  <div class="card">
    <div class="card-header">Create Category</div>
    <div class="card-body">
      <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <div class="form-group row mb-3">
          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
          <div class="col-md-6">
            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
          </div>
        </div>

        <div class="form-group row mb-3">
          <div class="col text-end" style="padding-right: 195px;">
            <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
            <input type="submit" value="Create" class="btn btn-primary">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection