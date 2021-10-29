@extends('layouts.app')

@section('title')
Create Todo
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('todo.store') }}" method="post" class="mt-4 p-4">
    <div class="form-group m-3">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group m-3">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" rows="3" required>{{ old('description') }}</textarea>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group m-3">
        <label for="assign">Assign To</label>
        <select class="form-control" name="assign" required>
            <option>Select who to assign task to</option>
            @foreach ($users as $user)
            <option @if(old('assign')==$user->id ) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        @error('assign')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group m-3">
        <label for="project">Project</label>
        <select class="form-control" name="project" required>
            <option>Select project</option>
            @foreach ($projects as $project)
            <option @if(old('project')==$project->id ) selected @endif value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
        @error('project')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group m-3">
        <label for="priority">Priority</label>
        <select class="form-control" name="priority" required>
            <option>Select priority</option>
            <option @if(old('priority')=='low' ) selected @endif value="low">Low</option>
            <option @if(old('priority')=='medium' ) selected @endif value="medium">Medium</option>
            <option @if(old('priority')=='high' ) selected @endif value="medium">High</option>
        </select>
        @error('priority')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group m-3">
        <label for="dueDate">Due Date</label>
        {!! Form::date('dueDate',old('dueDate', now()), ['required'=>'required']) !!}
        @error('dueDate')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group m-3">
        <input type="submit" class="btn btn-primary float-end" value="Create">
    </div>
</form>

@endsection
