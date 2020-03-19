@extends('layouts.panel')

@section('content')
<div class="row mt-5">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">Especialidades</h3>
                  </div>
                  <div class="col text-right">
                     <a href="{{ url('specialty/create') }}" class="btn btn-sm btn-outline-success">Nueva Especialidad</a>
                  </div>
               </div>
            </div>
            @if (session('notification'))
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        <strong>{{ session('notification') }}</strong>
                    </div>
                </div>
            @endif
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($specialties as $specialty)
                        <tr>
                            <th scope="row">{{ $specialty->id }}</th>
                            <td>{{ $specialty->name }}</td>
                            <td>{{ $specialty->description }}</td>
                            <td>
                                <a href="{{ url('/specialty/'.$specialty->id.'/edit') }}" class="btn btn-outline-primary btn-sm">Editar</a>
                                <form action="{{ url('/specialty/'.$specialty->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
               </table>
            </div>
        </div>
    </div>
</div>
@endsection
