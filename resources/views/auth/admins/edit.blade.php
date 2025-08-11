@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>{{ __('Edit Admin') }}</h4>
        </div>

        <form action="{{ route('admins.update', $admin->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="card-body">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('Email') }}</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $admin->email) }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>
        </form>
    </div>
@endsection
