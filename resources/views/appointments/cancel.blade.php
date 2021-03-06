@extends('layouts.panel')

@section('content')
<div class="row mt-5">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">Cancelar Cita</h3>
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
                @if ($role == 'patient')
                    <p>Estás a punto de cancelar tu cita reservada con el médico: {{ $appointment->doctor->name }} (especialidad {{ $appointment->specialty->name }}) para el día {{ $appointment->scheduled_date->format('d-m-Y') }}</p>
                @elseif($role == 'doctor')
                    <p>Estás a punto de cancelar tu cita reservada con el paciente: {{ $appointment->patient->name }} (especialidad {{ $appointment->specialty->name }}) para el día {{ $appointment->scheduled_date->format('d-m-Y') }} (hora {{ $appointment->scheduled_time_12 }})</p>
                @else
                    <p>Estás a punto de cancelar la cita reservada por el paciente {{ $appointment->patient->name }} para el médico {{ $appointment->doctor->name }} (especialidad {{ $appointment->specialty->name }}) para el día {{ $appointment->scheduled_date->format('d-m-Y') }} (hora {{ $appointment->scheduled_time_12 }})</p>
                @endif


                <form action="{{ url('/appointments/'.$appointment->id.'/cancel') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="justification">Por favor cuéntanos el motivo de la cancelación:</label>
                        <textarea required class="form-control" name="justification" id="justification" rows="3"></textarea>
                    </div>
                    <button class="btn btn-danger" type="submit">Cancelar cita</button>
                    <a href="{{ url('/appointments') }}" class="btn btn-dark">Volver al listado de citas sin cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
