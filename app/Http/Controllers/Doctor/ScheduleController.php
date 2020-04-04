<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    private $days = ['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workdays = WorkDay::where('user_id', auth()->user()->id)->get();
        if(count($workdays) > 0){
            $workdays->map(function ($workday){
                $workday->morning_start = (new Carbon($workday->morning_start))->format('g:i A');
                $workday->morning_end = (new Carbon($workday->morning_end))->format('g:i A');
                $workday->afternoon_start = (new Carbon($workday->afternoon_start))->format('g:i A');
                $workday->afternoon_end = (new Carbon($workday->afternoon_end))->format('g:i A');
                return $workday;
            });
        }else{
            $workdays = collect();
            for ($i=0; $i < 7; $i++) {
                $workdays->push(new WorkDay);
            }
        }
        $days = $this->days;
        return view('schedule', compact('days', 'workdays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ddd($request->all());
        $active = $request->input('active') ? : [];
        $morning_start = $request->input('morning_start');
        $morning_end = $request->input('morning_end');
        $afternoon_start = $request->input('afternoon_start');
        $afternoon_end = $request->input('afternoon_end');

        $errors = [];
        for ($i=0; $i < 7; $i++) {
            if($morning_start[$i] > $morning_end[$i]){
                $errors [] = "Las horas del turno de la mañana son inconsistentes para el día ".$this->days[$i].".";
            }
            if($afternoon_start[$i] > $afternoon_end[$i]){
                $errors [] = "Las horas del turno de la tarde son inconsistentes para el día ".$this->days[$i].".";
            }
            $schedule = WorkDay::updateOrCreate(
                [
                    'day' => $i,
                    'user_id' => auth()->user()->id,
                ],
                [
                    'active' => in_array($i, $active),
                    'morning_start' => $morning_start[$i],
                    'morning_end' => $morning_end[$i],
                    'afternoon_start' => $afternoon_start[$i],
                    'afternoon_end' => $afternoon_end[$i],
                ]
            );
        }
        if(count($errors) > 0){
            return back()->with(compact('errors'));
        }

        $notifications = 'Los cambios se han guardado correctamente.';
        return back()->with(compact('notifications'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('schedule');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
