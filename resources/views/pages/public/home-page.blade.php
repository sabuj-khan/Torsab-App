@extends('layouts.public.app')
@include('components.public.home.hero-slider')
@section('content')
   
    @include('components.public.home.about-section')
    @include('components.public.home.expertise-section')
    @include('components.public.home.vision-section')
    @include('components.public.home.clients-section')
    @include('components.public.home.testimonials-section')
    @include('components.public.home.blog-section')
@endsection