@extends('layouts.admin.dashboard')
@section('content')
    

    @if(request()->header('user_type') == 'admin')

        @include('components.admin.dashboard.post.post-list')
        @include('components.admin.dashboard.post.post-delete')

    @else

        @include('components.admin.dashboard.post.user-post-list')
    
    @endif



@endsection