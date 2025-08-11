@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">{{ __('Admins') }}</h4>
            <a href="{{ route('admins.create') }}" class="btn btn-primary">{{ __('Add Admin') }}</a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="text-success mb-3">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{ __('#') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->fullName }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ optional($admin->roles)->pluck('name')->implode(', ') }}</td>
                            <td>
                                <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admins.destroy', $admin->id) }}" method="POST"
                                    style="display:inline-block">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this admin?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
