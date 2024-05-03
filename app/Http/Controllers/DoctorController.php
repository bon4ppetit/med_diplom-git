<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

class DoctorController extends Controller
{
    public function getAllDoctors()
    {
        return response()->json(Doctor::getAllDoctors(), JSON_UNESCAPED_UNICODE);
    }
}
