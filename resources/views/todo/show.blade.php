@extends('layouts.app')

@section('title')
Details
@endsection

@section('content')

<div class="card text-center mt-5">
    <div class="card-header">
        <b>TODO DETAILS</b>
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $todo->title}}</h5>
        <p class="card-text">{{ $todo->description }}</p>
        <a href="edit"><span class="btn btn-primary">Edit</span></a>
        <a href="delete"><span class="btn btn-danger">Delete</span></a>
    </div>
</div>

@endsection
