<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';

    public static function getAllDoctors(): Collection
    {
        $data = DB::table('users')
            ->join('doctors', 'users.id', '=', 'doctors.user_id')
            ->join('profession', 'doctors.profession_id', '=', 'profession.id')
            ->select('users.name', 'users.surname', 'users.patronymic', 'doctors.*', 'profession.name as profession')
            ->get();


        foreach ($data as $item) {
            //Cut second at working time
            $item->working_time_start = substr($item->working_time_start,0,-3);
            $item->working_time_end = substr($item->working_time_end,0,-3);

            $item->day_working = json_decode($item->day_working);
            $item->free_datetime = Doctor::getWorkTimeDoctor((array)$item->day_working, $item->working_time_start, $item->working_time_end);
        }

        return $data;
    }

    private static function getWorkTimeDoctor($dayWorking, $startTime, $endTime): array
    {
        $allTime = [];

        $startTimeNumber = substr($startTime, 0, -3);
        $endTimeNumber = substr($endTime, 0, -3);

        foreach ($dayWorking as $oneDay) {
            for ($i = (int)$startTimeNumber; $i < (int)$endTimeNumber + 1; $i++) {
                $allTime[$oneDay][] = $i;
            }
        }

        return $allTime;
    }
}
