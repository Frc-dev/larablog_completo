@extends('dashboard.master')

@section('content')

@include('dashboard.partials.validation-error')

<form method="post" action="{{ route('post.store') }}">
@include('dashboard.post._form')
</form>

@endsection
