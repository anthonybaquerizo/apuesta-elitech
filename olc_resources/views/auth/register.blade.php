@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="h4" >Registro gratis</h1>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <form class="form-horizontal needs-validation {{ $errors->any() ? 'was-validated' : '' }} col-lg-6 col-md-6 col-sm-12 col-12" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
    
                            <div class="row form-group">
                                <label for="name" class="col-lg-4 col-md-4 col-sm-4 col-12 control-label">Nombre</label>
    
                                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
    
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="row form-group">
                                <label for="last_name" class="col-lg-4 col-md-4 col-sm-4 col-12 control-label">Apellido</label>
    
                                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>
    
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="row form-group">
                                <label for="phone" class="col-lg-4 col-md-4 col-sm-4 col-12 control-label">Celular</label>
    
                                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
    
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="row form-group">
                                <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-12 control-label">Email (usuario)</label>
    
                                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
    
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="row form-group">
                                <label for="password" class="col-lg-4 col-md-4 col-sm-4 col-12 control-label">Contraseña</label>
    
                                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                                    <input id="password" type="password" class="form-control" name="password" required>
    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="row form-group">
                                <label for="password-confirm" class="col-lg-4 col-md-4 col-sm-4 col-12 control-label">Confirmar Contraseña</label>
    
                                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
    
                            <div class="row form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
