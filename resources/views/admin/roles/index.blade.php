@extends('adminlte::page')

@section('title', 'Blog EMMA')

@section('content_header')
<a class="btn btn-primary btn-sm float-right" href="{{ route('admin.roles.create') }}">Nuevo Rol</a>
<h1>Lista de Roles WinSystems</h1>
@stop

@section('content')
@if (session('info'))
    <div class="alert alert-success">
        {{ session('info') }}
    </div>

@endif
<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th colspan="2"></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td width="2">
                            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-primary">Editar</a>
                        </td>
                        <td width="2">
                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>

                @endforeach
            </tbody>

        </table>
    </div>
</div>
@stop
