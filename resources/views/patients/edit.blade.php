@extends('layouts.panel')

@section('content')
<div class="row mt-5">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">Editar Paciete</h3>
                  </div>
                  <div class="col text-right">
                     <a href="{{ url('/patient') }}" class="btn btn-sm btn-outline-default">Cancelar y Volver</a>
                  </div>
               </div>
            </div>
            <div class="card-body">
                <form action="{{ url('/patient/'.$patient->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nombre" class="form-control-label">Nombre del Médico</label>
                        <input class="form-control" type="text" value="{{ old('name', $patient->name) }}" id="nombre" name="name" required>
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peligro!</strong> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-control-label">Email</label>
                        <input class="form-control" type="email" value="{{ old('email', $patient->email) }}" id="email" name="email">
                        @error('email')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peligro!</strong> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cedula" class="form-control-label">Cedula</label>
                        <input class="form-control" type="text" value="{{ old('cedula', $patient->cedula) }}" id="cedula" name="cedula">
                        @error('cedula')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peligro!</strong> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-control-label">Dirección</label>
                        <input class="form-control" type="text" value="{{ old('address', $patient->address) }}" id="address" name="address">
                        @error('address')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peligro!</strong> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-control-label">Teléfono / movil</label>
                        <input class="form-control" type="text" value="{{ old('phone', $patient->phone) }}" id="phone" name="phone">
                        @error('phone')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peligro!</strong> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-control-label">Contraseña</label>
                        <input class="form-control" type="text" id="password" name="password">
                        <p>Ingrese un valor sólo si desea modificar la contraseña.</p>
                        @error('password')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peligro!</strong> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
