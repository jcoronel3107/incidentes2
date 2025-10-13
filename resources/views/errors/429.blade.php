@extends('errors::illustrated-layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('image')
<div style="background-image: url('/svg/429.svg');" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
<img src="/images/errors/429.gif"/>
</div>
@endsection
@section('message', __('Too Many Requests'))
