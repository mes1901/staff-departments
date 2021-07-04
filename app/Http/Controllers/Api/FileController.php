<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    public function saveFile(Request $request)
    {
        try {
            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload'), $fileName);

            $xmlDataString = file_get_contents(public_path('upload/1625387759.xml'));
            $xmlObject = simplexml_load_string($xmlDataString);
            $json = json_encode($xmlObject);
            $dataArray = json_decode($json, true);

            foreach ($dataArray['row'] as $key => $data) {
                $workingHours = $data['working_hours'];
                $dataArray['row'][$key]['working_hours'] = $workingHours == 'null' ? null : $workingHours;
                $dataArray['row'][$key]['created_at'] = now();
                $dataArray['row'][$key]['updated_at'] = now();
            }

            Employee::insert($dataArray['row']);

            return ResponseJson::responseSuccess();
        } catch (\Exception $exception) {
            Log::error($exception);
            return ResponseJson::responseError($exception->getMessage());
        }
    }
}
