@extends('errors::illustrated-layout')

@section('title', __('Page Expired'))
@section('code', '419')
@section('image')
<div style="background-image: url('/svg/419.svg');" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
<img src="/images/errors/419.gif"/>
</div>
@endsection
@section('message', __('Page Expired'))
