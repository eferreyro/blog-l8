  <div class="form-group">
      {!! Form::label('name', 'Nombre') !!}
      {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del Rol']) !!}
      @error('name')
          <small class="text-danger">
              {{ $message }}
          </small>
      @enderror
  </div>
  <hr>
  <h2>Lista de permisos de Rol</h2>
  @foreach ($permissions as $permission)
      <div>
          <label>
              {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
              {{ $permission->description }}
          </label>
      </div>
  @endforeach
