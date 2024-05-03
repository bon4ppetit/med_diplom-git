<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateRecordRequest;
use App\Http\Requests\DeleteRecordRequest;
use App\Models\RecordToDoctor;
use Illuminate\Http\JsonResponse;

class RecordToDoctorController extends Controller
{
    public function getUserRecords(): JsonResponse
    {
        return response()->json(RecordToDoctor::getAllUserRecords(), JSON_UNESCAPED_UNICODE);
    }

    public function createRecord(CreateRecordRequest $request)
    {
        $request['client_id'] = auth()->user()->id;
        return RecordToDoctor::create($request->toArray());
    }

    public function getUserOldRecords()
    {
        return response()->json(RecordToDoctor::getOldRecords());
    }

    public function deleteRecord(DeleteRecordRequest $request)
    {
        return RecordToDoctor::destroy($request->validated()['id']);
    }
}
