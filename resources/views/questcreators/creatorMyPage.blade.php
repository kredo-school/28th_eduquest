@extends('layouts.app')

@section('title', 'Creator My Page')

@section('content')
<div class="container">
    <h1>Welcome to Creator My Page</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>
@endsection
