@extends('layouts.panel')

@section('content')
<div class="row mt-5">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">Nueva Especialidad</h3>
                  </div>
                  <div class="col text-right">
                     <a href="{{ url('/specialty') }}" class="btn btn-sm btn-outline-default">Cancelar y Volver</a>
                  </div>
               </div>
            </div>
            <div class="card-body">
                <form action="{{ url('/specialty/'.$specialty->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="especialidad" class="form-control-label">Especialidad</label>
                        <input class="form-control" type="text" value="{{ old('name', $specialty->name) }}" id="especialidad" name="name" required>
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peligro!</strong> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" rows="3" name="description">{{ old('description',$specialty->description) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
