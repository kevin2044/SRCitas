<?php

namespace App\Services;
use App\Interfaces\ScheduleServiceInterface;

use App\Workday;
use App\Appointment;
use Carbon\Carbon;

class ScheduleService implements ScheduleServiceInterface{

    public function isAvailableInterval($date, $doctorId, Carbon $start){
        $exists = Appointment::where('doctor_id', $doctorId)
                            ->where('scheduled_date', $date)
                            ->where('scheduled_time', $start->format('H:i:s'))->exists();

        return !$exists;
    }

    private function getDayFromDate($date){
        $dateCarbon = new Carbon($date);
        //dayOfWeek
        //CArbon 0 (sunday) - 6(saturday)
        //WorkDay 0 (monday) - 6(sunday)
        $i = $dateCarbon->dayOfWeek;
        $day = ($i == 0 ? 6 : $i-1);
        return $day;
    }

   public function getAvailableIntervals($date, $doctorId){
        $hours = WorkDay::where('active', true)
        ->where('day', $this->getDayFromDate($date))
        ->where('user_id', $doctorId)
        ->first([
            'morning_start', 'morning_end',
            'afternoon_start', 'afternoon_end',
        ]);
        //dd($hours);
        if(!$hours){
            return [];
        }
        $morningIntervals = $this->getIntervals(
            $hours->morning_start,$hours->morning_end,$date,$doctorId
        );
        $afternoonIntervals = $this->getIntervals(
            $hours->afternoon_start,$hours->afternoon_end,$date,$doctorId
        );
        $data = [];
        $data['morning'] = $morningIntervals;
        $data['afternoon'] = $afternoonIntervals;
        //ddd($request->all(),$day,$hours, $data);

        return $data;
   }

   private function getIntervals($start, $end, $date, $doctorId){
        $start = new Carbon($start);
        $end = new Carbon($end);
        $intervals = [];
        while($start < $end){
            $interval = [];
            $interval['start'] = $start->format('g:i A');

            $available = $this->isAvailableInterval($date, $doctorId, $start);

            $start->addMinutes(30);
            $interval['end'] = $start->format('g:i A');
            //dd($exists);
            if($available){
                $intervals []= $interval;
            }
        }
        return $intervals;
    }
}
