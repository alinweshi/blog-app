@extends('admin.layouts.app')



@section('title', 'Users')
@section('content')
    <div>
        @livewire('user-table')
    </div>
@endsection
