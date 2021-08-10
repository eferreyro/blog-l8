@extends('adminlte::page')

@section('title', 'Blog EMMA')

@section('content_header')
<h1>Editar Rol "{{ $role->name }}"</h1>
@stop

@section('content')
@if (session('info'))
    <div class="alert alert-success">
        {{ session('info') }}
    </div>

@endif
<div class="card">
    <div class="card-body">
        {!! Form::model($role, ['route' => ['admin.roles.update', $role], 'method' => 'PUT']) !!}
        @include('admin.roles.partials.form')
        <hr>
        {!! Form::submit('Actualizar Rol', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@stop
