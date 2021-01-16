<h3>Actualiza tu información</h3>
<br>
<h5>Cambio de contraseña</h5>
<p>Si quieres cambiar tu contraseña en el siguiente apartado puedes hacerlo.</p>
<form method="POST" action="#">
    <div class="form-group row">
        <label for="password-old" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña antigua') }}</label>

        <div class="col-md-6">
            <input id="password-old" type="password" class="form-control @error('password') is-invalid @enderror" name="password-old" required autocomplete="old-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password-new" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña nueva') }}</label>

        <div class="col-md-6">
            <input id="password-new" type="password" class="form-control @error('password') is-invalid @enderror" name="password-new" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="confirm-password">
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Actualizar contraseña') }}
            </button>
        </div>
    </div>
</form>
<br>
<h5>Subida del expediente</h5>
<p>Recuerda que debes subir el expediente a medida que las actas se cierren.</p>
<form method="POST" action="/perfil/subirExpediente/{{Auth::user()->id}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Expediente con notas') }}</label>

        <div class="col-md-6">
            <input id="file" type="file" class="form-control" name="file"  required autocomplete="file">
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Enviar expediente') }}
            </button>
        </div>
    </div>
</form>

@if($matriculaEnviada == false)
<h5>Subida de la matricula</h5>
<p>Recuerda que debes subir la matrícula de NUEVAS ASIGNATURAS entre 1 y el 30 de octubre</p>
<strong>CUIDADO CON LAS ASIGNATURAS QUE ELIGES. NO PODRÁS HACER CAMBIOS LUEGO.</strong>

<form method="POST" action="/perfil/subirMatricula/{{Auth::user()->id}}">
    @csrf

    @for($i = 0; $i < 11; $i++)
    <div class="form-group row">
        <label for='asig{{$i+1}}' class='col-md-4 col-form-label text-md-right'>Asignatura {{$i+1}}</label>

        <div class="col-md-6">
            <select class="form-control" name="asig{{$i+1}}">
            <option value="-1"></option>
            @foreach($asignaturasMat as $a)
                <option value="{{$a->cod_asig}}"> {{$a->cod_asig}} {{$a->nombre_asig}} </option>
            @endforeach
            </select>

        </div>
    </div>
    @endfor
    <strong>¿ESTÁS SEGURO DE QUE QUIERES ENVIAR ESTA MATRÍCULA?</strong><br>
    <h5><strong>¿SEGURO?</strong></h5>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Subir Matrícula') }}
            </button>
        </div>
    </div>
</form>
<br><br>
@else
<br><br>
<h5><strong>A ESTA FECHA, YA NO ESTA DISPONIBLE LA SUBIDA DE LA MATRÍCULA O YA HAS SUBIDO TU MATRÍCULA</strong></h5>
<h5>Subida de la matricula</h5>
<p>Recuerda que debes subir la matrícula entre 1 y el 30 de octubre</p>
<strong>CUIDADO CON LAS ASIGNATURAS QUE ELIGES. NO PODRÁS HACER CAMBIOS LUEGO.</strong>

<form method="POST" action="/perfil/subirMatricula/{{Auth::user()->id}}" enctype="multipart/form-data">
    @csrf

    @for($i = 0; $i < 11; $i++)
    <div class="form-group row">
        <label for='asig{{$i+1}}' class='col-md-4 col-form-label text-md-right'>Asignatura {{$i+1}}</label>

        <div class="col-md-6">
            <select type="file" class="form-control" name="asig{{$i+1}}" disabled></select>

        </div>
    </div>
    @endfor
    <strong>¿ESTÁS SEGURO DE QUE QUIERES ENVIAR ESTA MATRÍCULA?</strong>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary" disabled>
                {{ __('Subir Matrícula') }}
            </button>
        </div>
    </div>
</form>
<br><br>
@endif
