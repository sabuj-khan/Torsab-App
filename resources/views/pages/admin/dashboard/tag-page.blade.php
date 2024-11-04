@extends('layouts.admin.dashboard')
@section('content')
    @include('components.admin.dashboard.tag.tag-list')
    @include('components.admin.dashboard.tag.tag-create')
    @include('components.admin.dashboard.tag.tag-update')
    @include('components.admin.dashboard.tag.tag-delete')
@endsection