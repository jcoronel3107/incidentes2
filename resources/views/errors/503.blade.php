@extends('errors::illustrated-layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('image')
<div style="background-image: url('/svg/503.svg');" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
<img src="/images/errors/503.gif"/>
</div>
@endsection
@section('message', __($exception->getMessage() ?: 'Service Unavailable'))
