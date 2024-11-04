@extends('layouts.admin.dashboard')
@section('content')
    @include('components.admin.dashboard.category.category-list')
    @include('components.admin.dashboard.category.category-create')
    @include('components.admin.dashboard.category.category-update')
    @include('components.admin.dashboard.category.category-delete')
@endsection