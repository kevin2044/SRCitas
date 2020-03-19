@extends('layouts.panel')

@section('content')
<div class="row mt-5">
    <div class="col-xl-12">
        <form action="{{ url('/schedule') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-header border-0">
                   <div class="row align-items-center">
                      <div class="col">
                         <h3 class="mb-0">Gestionar Horarios</h3>
                      </div>
                      <div class="col text-right">
                        <button type="submit" class="btn btn-sm btn-outline-success">Guardar Cambios</>
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
                                <th scope="col">Día</th>
                                <th scope="col">Activo</th>
                                <th scope="col">Turno Mañana</th>
                                <th scope="col">Turno Tarde</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($days as $key => $day)
                                <tr>
                                    <td>{{ $day }}</td>
                                    <td>
                                        <label class="custom-toggle">
                                            <input type="checkbox" name="active[]" value="{{ $key }}">
                                            <span class="custom-toggle-slider rounded-circle"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <select name="morning_start[]" class="form-control">
                                                    @for ($i = 5; $i <= 11; $i++)
                                                        <option value="{{ $i }}:00">{{ $i }}:00 am</option>
                                                        <option value="{{ $i }}:30">{{ $i }}:30 am</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select name="morning_end[]" class="form-control">
                                                    @for ($i = 5; $i <= 11; $i++)
                                                        <option value="{{ $i }}:00">{{ $i }}:00 am</option>
                                                        <option value="{{ $i }}:30">{{ $i }}:30 am</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <select name="afternoon_start[]" class="form-control">
                                                    @for ($i = 1; $i <= 11; $i++)
                                                        <option value="{{ $i+12 }}:00">{{ $i }}:00 pm</option>
                                                        <option value="{{ $i+12 }}:30">{{ $i }}:30 pm</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select name="afternoon_end[]" class="form-control">
                                                    @for ($i = 1; $i <= 11; $i++)
                                                        <option value="{{ $i+12 }}:00">{{ $i }}:00 pm</option>
                                                        <option value="{{ $i+12 }}:30">{{ $i }}:30 pm</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                   </table>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
