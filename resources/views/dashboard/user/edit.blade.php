@extends('dashboard.master')

@section('content')

@include('dashboard.partials.validation-error')

<form action="{{ route("user.update", $user->id) }}" method="post">
    @method('PUT')
@include('dashboard.user._form', ['pasw' => false])
</form>
@endsection
