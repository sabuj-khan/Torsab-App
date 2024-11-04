@extends('layouts.public.app')
@section('content')
    @include('components.public.about.about-header')
    @include('components.public.about.story-section')
    @include('components.public.about.item-section')
    @include('components.public.about.team-section')
    @include('components.public.about.clients-section')
@endsection