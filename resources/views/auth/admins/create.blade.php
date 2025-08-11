@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>{{ __('Create Admin') }}</h4>
        </div>

        <form action="{{ route('admins.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">{{ __('First Name') }}</label>
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}"
                                placeholder="Enter first_name">
                            @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">{{ __('Last Name') }}</label>
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}"
                                placeholder="Enter last_name">
                            @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('Email') }}</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                placeholder="Enter email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('Password') }}</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('Confirm Password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirm password">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">{{ __('Create') }}</button>
            </div>
        </form>
    </div>
@endsection
