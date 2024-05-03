<?php

namespace App\Http\Controllers;

use App\Models\Professions;

class ProfessionController extends Controller
{
    public static function getProfession()
    {
        return response()->json(Professions::all());
    }
}
