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
<br><br>
