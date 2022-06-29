@extends('layouts.app')

@section('content')
<main class="login-form">
  <div class="cotainer">
    <div class="row justify-content-center">
      <div class="col-md-8">
        @if ($message = Session::get('success'))
        <div class="alert-success p-2 my-3">{{ $message }}</div>
        @endif
        @if ($message = Session::get('fail'))
        <div class="alert-danger p-2 my-3">{{ $message }}</div>
        @endif
        @if ($message = Session::get('logout'))
        <div class="alert-success p-2 my-3">{{ $message }}</div>
        @endif
        <div class="card">
          <div class="card-header">Login</div>
          <div class="card-body">

            <form action="{{ route('login.post') }}" method="POST">
              @csrf
              <div class="form-group row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                <div class="col-md-6">
                  <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                  @if ($errors->has('email'))
                  <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                <div class="col-md-6">
                  <input type="password" id="password" class="form-control" name="password" value="{{ old('password') }}" required>
                  @if ($errors->has('password'))
                  <span class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
                </div>
              </div>

              <div class="form-group row mb-3">
                <div class="col-md-6 offset-md-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="remember"> Remember Me
                    </label>
                  </div>
                </div>
              </div>

              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  Login
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection