@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('image')
<div style="background-image: url('/svg/403.svg');" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
@section('message', __($exception->getMessage() ?: 'Forbidden'))
