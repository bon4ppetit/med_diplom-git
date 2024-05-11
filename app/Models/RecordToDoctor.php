<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class RecordToDoctor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'client_id',
        'doctor_id',
        'record_datetime'
    ];

    protected $table = 'records_to_doctor';

    public static function getAllUserRecords()
    {
        $records = DB::table('records_to_doctor')
            ->where('records_to_doctor.client_id', auth()->user()->id)
            ->whereNull('records_to_doctor.deleted_at')
            ->join('doctors', 'doctor_id', '=', 'doctors.id')
            ->join('users', 'doctor_id', '=', 'users.id')
            ->select('records_to_doctor.id', 'users.name', 'users.surname', 'users.patronymic', 'doctors.number_room', 'records_to_doctor.record_datetime')
            ->get();


        foreach ($records as $item) {
            $item->record_date =  substr($item->record_datetime, 0, 10);
            $item->record_time =  substr($item->record_datetime, 11, 5);
        }

        return $records;
    }

    public static function getOldRecords()
    {
        $records = DB::table('records_to_doctor')
            ->where('records_to_doctor.client_id', auth()->user()->id)
            ->where('records_to_doctor.deleted_at', '!=', 'null')
            ->join('doctors', 'doctor_id', '=', 'doctors.id')
            ->join('users', 'doctor_id', '=', 'users.id')
            ->select('records_to_doctor.id', 'users.name', 'users.surname', 'users.patronymic', 'doctors.number_room', 'records_to_doctor.record_datetime')
            ->get();

        if (empty($records->count())) {
            return null;
        }

        foreach ($records as $item) {
            $item->record_date =  substr($item->record_datetime, 0, 10);
            $item->record_time =  substr($item->record_datetime, 11, 5);
        }

        return $records;
    }

    public static function createUserRecord($dataRecord)
    {
        return RecordToDoctor::create($dataRecord);
    }
}
