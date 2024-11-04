@extends('layouts.admin.dashboard')
@section('content')

    @if(request()->header('user_type') == 'admin')

        @include('components.admin.dashboard.users.user-show')
        @include('components.admin.dashboard.users.user-delete')

    @else

        @include('components.admin.dashboard.users.users-for-users')
    
    @endif

@endsection
