@extends('layouts.panel')

@section('content')
<div class="row mt-5">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">Nuevo Médico</h3>
                  </div>
                  <div class="col text-right">
                     <a href="{{ url('/doctor') }}" class="btn btn-sm btn-outline-default">Cancelar y Volver</a>
                  </div>
               </div>
            </div>
            <div class="card-body">
                <form action="{{ url('/doctor') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre" class="form-control-label">Nombre del Médico</label>
                        <input class="form-control" type="text" value="{{ old('name') }}" id="nombre" name="name" required>
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peligro!</strong> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-control-label">Email</label>
                        <input class="form-control" type="email" value="{{ old('email') }}" id="email" name="email">
                        @error('email')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peligro!</strong> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cedula" class="form-control-label">Cedula</label>
                        <input class="form-control" type="text" value="{{ old('cedula') }}" id="cedula" name="cedula">
                        @error('cedula')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peligro!</strong> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-control-label">Dirección</label>
                        <input class="form-control" type="text" value="{{ old('address') }}" id="address" name="address">
                        @error('address')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peligro!</strong> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-control-label">Teléfono / movil</label>
                        <input class="form-control" type="text" value="{{ old('phone') }}" id="phone" name="phone">
                        @error('phone')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peligro!</strong> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-control-label">Contraseña</label>
                        <input class="form-control" type="text" value="{{ Str::random(8) }}" id="password" name="password">
                        @error('password')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peligro!</strong> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="specialties" class="form-control-label">Especialidad</label>
                        <select name="specialties[]" id="specialties" class="form-control selectpicker" data-style="btn-secondary" multiple title="Seleccione una o varias opciones">
                            @foreach ($specialties as $specialty)
                                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                            @endforeach
                        </select>
                        @error('specialties')
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
@push('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@endpush
@push('scripts')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
@endpush
