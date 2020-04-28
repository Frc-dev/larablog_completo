@extends('dashboard.master')

@section('content')

@include('dashboard.partials.validation-error')

<form method="post" action="{{ route('category.store') }}">
@include('dashboard.category._form')
</form>

@endsection
