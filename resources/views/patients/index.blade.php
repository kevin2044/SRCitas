@extends('layouts.panel')

@section('content')
<div class="row mt-5">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">Pacientes</h3>
                  </div>
                  <div class="col text-right">
                     <a href="{{ url('patient/create') }}" class="btn btn-sm btn-outline-success">Nuevo Paciente</a>
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
                            <th scope="col">Email</th>
                            <th scope="col">Cedula</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <th scope="row">{{ $patient->id }}</th>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->cedula }}</td>
                            <td>
                                <a href="{{ url('/patient/'.$patient->id.'/edit') }}" class="btn btn-outline-primary btn-sm">Editar</a>
                                <form action="{{ url('/patient/'.$patient->id) }}" method="post" class="d-inline">
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
            <div class="card-body">
                {{ $patients->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
