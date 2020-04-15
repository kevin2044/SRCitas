@extends('layouts.panel')

@section('content')
<div class="row mt-5">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">Mis Citas</h3>
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
            <div class="card-body">
                <div class="nav-wrapper">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" data-toggle="tab" href="#confirmed-appointments" role="tab" aria-selected="true"><i class="ni ni-curved-next mr-2"></i>Mis proximas citas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" href="#pending-appointments" role="tab" aria-selected="false"><i class="ni ni-check-bold mr-2"></i>Citas por confirmar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" href="#old-appointments" role="tab" aria-selected="false"><i class="ni ni-bullet-list-67 mr-2"></i>Historial de citas</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card shadow">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="confirmed-appointments" role="tabpanel">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Especialidad</th>
                                        @if ($role == 'patient')
                                            <th scope="col">Medico</th>
                                        @elseif($role == 'doctor')
                                            <th scope="col">Paciente</th>
                                        @endif
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($confirmedAppointments as $appointment)
                                    <tr>
                                        <th scope="row">{{ $appointment->id }}</th>
                                        <td>{{ $appointment->description }}</td>
                                        <td>{{ $appointment->specialty->name }}</td>
                                        @if ($role == 'patient')
                                            <td>{{ $appointment->doctor->name }}</td>
                                        @elseif($role == 'doctor')
                                           <td>{{ $appointment->patient->name }}</td>
                                        @endif
                                        <td>{{ $appointment->scheduled_date->format('d-m-Y') }}</td>
                                        <td>{{ $appointment->scheduled_time_12 }}</td>
                                        <td>{{ $appointment->type }}</td>
                                        <td>
                                            @if($role == 'admin')
                                            <a href="{{ url('/appointments/'.$appointment->id) }}" class="btn btn-outline-default btn-sm" title="Cancelar Cita">Ver</a>
                                            @endif
                                            <a href="{{ url('/appointments/'.$appointment->id.'/cancel') }}" class="btn btn-outline-danger btn-sm" title="Cancelar Cita">Cancelar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            {{ $confirmedAppointments->links() }}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pending-appointments" role="tabpanel">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Especialidad</th>
                                        @if ($role == 'patient')
                                            <th scope="col">Medico</th>
                                        @elseif($role == 'doctor')
                                            <th scope="col">Paciente</th>
                                        @endif
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingAppointments as $appointment)
                                    <tr>
                                        <th scope="row">{{ $appointment->id }}</th>
                                        <td>{{ $appointment->description }}</td>
                                        <td>{{ $appointment->specialty->name }}</td>
                                        @if ($role == 'patient')
                                            <td>{{ $appointment->doctor->name }}</td>
                                        @elseif($role == 'doctor')
                                           <td>{{ $appointment->patient->name }}</td>
                                        @endif
                                        <td>{{ $appointment->scheduled_date->format('d-m-Y') }}</td>
                                        <td>{{ $appointment->scheduled_time_12 }}</td>
                                        <td>{{ $appointment->type }}</td>
                                        <td>{{ $appointment->status }}</td>
                                        <td>
                                            @if($role == 'admin')
                                                <a href="{{ url('/appointments/'.$appointment->id) }}" class="btn btn-outline-default btn-sm" title="Cancelar Cita">Ver</a>
                                            @endif
                                            @if($role == 'doctor' || $role == 'admin')
                                            <form action="{{ url('/appointments/'.$appointment->id.'/confirm') }}" method="POST" class="d-inline-block">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-success btn-sm" title="Cancelar Cita">Confirmar</button>
                                            </form>
                                            <a href="{{ url('/appointments/'.$appointment->id.'/cancel') }}" class="btn btn-outline-danger btn-sm">Cancelar</a>
                                            @else
                                            <form action="{{ url('/appointments/'.$appointment->id.'/cancel') }}" method="POST" class="d-inline-block">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Cancelar Cita">Cancelar</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            {{ $pendingAppointments->links() }}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="old-appointments" role="tabpanel">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Especialidad</th>

                                        <th scope="col">Fecha</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($oldAppointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->description }}</td>
                                        <td>{{ $appointment->specialty->name }}</td>
                                        <td>{{ $appointment->scheduled_date->format('d-m-Y') }}</td>
                                        <td>{{ $appointment->scheduled_time_12 }}</td>
                                        <td>{{ $appointment->type }}</td>
                                        <td>{{ $appointment->status }}</td>
                                        <td>
                                            <a href="{{ url('/appointments/'.$appointment->id) }}" class="btn btn-outline-default btn-sm" title="Cancelar Cita">Ver</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            {{ $oldAppointments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
