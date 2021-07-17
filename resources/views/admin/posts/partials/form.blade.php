 <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nombre del POST']) !!}
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug del POST', 'readonly']) !!}
                @error('slug')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('category_id', 'Categoria') !!}
                {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <hr>
            <div class="form-group">
                <p class="font-weight-bold">Etiquetas</p>
                @foreach ($tags as $tag)
                    <label class="mr-2">
                        {!! Form::checkbox('tags[]', $tag->id, null) !!}
                        {{ $tag->name }}
                    </label>
                @endforeach

                @error('tags')
                    <br>
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <hr>
            </div>
            <div class="form-group">
                <p class="font-weight-bold">Estado</p>
                <label>
                    {!! Form::radio('status', 1, true) !!}
                    Borrador
                </label>
                <label>
                    {!! Form::radio('status', 2) !!}
                    Publicado
                </label>
                <hr>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <hr>
            <h4 class="text-center">Imagen</h4>
            <div class="row">
                <div class="col">
                    <div class="image-wrapper">
                        @isset ($post->image)
                            <img id="picture"
                            src="{{Storage::url($post->image->url)}}">
                            @else
                            <img id="picture"
                            src="https://i2.wp.com/www.icrisat.org/wp-content/uploads/2017/11/image-pending-_resized700x500-2.jpg">
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        {!! Form::label('file', 'Imagen del Post') !!}
                        {!! Form::file('file', ['class' => 'form-control-file', 'accept' => '.png, .jpg, .jpeg']) !!}
                    </div>
                    @error('file')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, debitis nulla facere, repellat
                        repellendus reprehenderit animi ea eum voluptatem tempore quisquam cupiditate porro at et sit iusto
                        fugiat libero ad.</p>
                </div>
            </div>
            <hr>

            <div class="form-group">
                {!! Form::label('body', 'Cuerpo del POST') !!}
                {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
            </div>
            @error('body')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                {!! Form::label('extract', 'Resumen') !!}
                {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}
            </div>
            @error('extract')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <br>