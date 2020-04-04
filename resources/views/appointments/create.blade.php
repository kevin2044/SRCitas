@extends('layouts.panel')

@section('content')
<style>
legend {
    margin-bottom: 20px;
    font-size: 14px;
    color: #3c8dbc;
    border: 0;
    border-bottom: 1px solid #3c8dbc;
}
.sinpadding{
    padding-left:0;
    padding-right:0;
}
.lds-ellipsis {
    display: inline-block;
    position: relative;
    width: 64px;
    height: 64px;
}
.lds-ellipsis div {
    position: absolute;
    top: 27px;
    width: 11px;
    height: 11px;
    border-radius: 50%;
    background: #253c4f;
    animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.lds-ellipsis div:nth-child(1) {
    left: 6px;
    animation: lds-ellipsis1 0.6s infinite;
}
.lds-ellipsis div:nth-child(2) {
    left: 6px;
    animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(3) {
    left: 26px;
    animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(4) {
    left: 45px;
    animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
    0% {
        transform: scale(0);
    }
    100% {
        transform: scale(1);
    }
}
@keyframes lds-ellipsis3 {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(0);
    }
}
@keyframes lds-ellipsis2 {
    0% {
        transform: translate(0, 0);
    }
    100% {
        transform: translate(19px, 0);
    }
}
</style>
<div class="row mt-5">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">Registrar Nueva Cita</h3>
                  </div>
                  <div class="col text-right">
                     <a href="{{ url('/patients') }}" class="btn btn-sm btn-outline-default">Cancelar y Volver</a>
                  </div>
               </div>
            </div>
            <div class="card-body">
                @if (session('notification'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ session('notification') }}</strong>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ url('/appointments') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="description" class="form-control-label">Descripción</label>
                        <input class="form-control" type="text" value="{{ old('description') }}" id="description" name="description" placeholder="Descripbe brevemente tu consulta" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="specialty_id" class="form-control-label">Especialidad</label>
                            <select name="specialty_id" id="specialty_id" class="form-control" required>
                                <option value="">Seleccionar especialidad</option>
                                @foreach ($specialties as $specialty)
                                    <option value="{{ $specialty->id }}" @if(old('specialty_id') == $specialty->id) selected @endif>{{ $specialty->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="doctor_id" class="form-control-label">Medico</label>
                            <select name="doctor_id" id="doctor_id" class="form-control" required>
                                <option value="">ELIJA UNA ESPECIALIDAD</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" @if(old('doctor_id') == $doctor->id) selected @endif>{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date" class="form-control-label">Fecha</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker" placeholder="Select date" type="text" value="{{ old('scheduled_date',date('Y-m-d')) }}" data-date-format="yyyy-mm-dd" data-date-start-date="{{ date('Y-m-d') }}" data-date-start-date="+30d" id="date" name="scheduled_date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-control-label">Hora de Atención</label>
                        <div id="hours">
                            @if ($intervals)
                                @foreach ($intervals['morning'] as $key => $interval)
                                    <div class="custom-control custom-radio mb-3">
                                    <input type="radio" id="intervalMorning{{ $key }}" name="scheduled_time" class="custom-control-input" value="{{ $interval['start'] }}" required>
                                        <label class="custom-control-label" for="intervalMorning{{ $key }}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
                                    </div>
                                @endforeach
                                @foreach ($intervals['afternoon'] as $key => $interval)
                                    <div class="custom-control custom-radio mb-3">
                                    <input type="radio" id="intervalAfternoon{{ $key }}" name="scheduled_time" class="custom-control-input" value="{{ $interval['start'] }}" required>
                                        <label class="custom-control-label" for="intervalAfternoon{{ $key }}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-default" role="alert">
                                    <strong>Seleccione un médico y una fecha, para ver sus horas disponibles!</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="consulta">Tipo de consulta</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="type1" value="consulta" name="type" @if(old('type') == 'consulta') checked @endif checked>
                            <label class="custom-control-label" for="type1">Consulta</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="type2" name="type" value="examen" @if(old('type') == 'examen') checked @endif>
                            <label class="custom-control-label" for="type2" >Examen</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="type3" name="type" value="observacion" @if(old('type') == 'observacion') checked @endif>
                            <label class="custom-control-label" for="type3" >Observación</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/appointments/create.js') }}"></script>
@endpush
