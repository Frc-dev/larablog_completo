@extends('dashboard.master')

@section('content')

@include('dashboard.partials.validation-error')

<form method="post" action="{{ route('user.store') }}">
@include('dashboard.user._form', ['pasw' => true])
</form>

@endsection
