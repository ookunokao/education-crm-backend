<?php

namespace App\Http\Controllers;

use App\Http\Resources\PersonalsDataResource;
use App\Models\PersonalsData;
use App\Providers\DatabaseProvider;
use App\Providers\ValidatorProvider;
use Illuminate\Http\Request;

class PersonalDataController extends Controller
{
    public function getPersonalData()
    {
        $data = DatabaseProvider::checkExistData('GET', PersonalsData::class, 'No data was found for this user');
        if ($data['results']) {
            return $data['response'];
        }
        
        return DatabaseProvider::getData($data['response'], PersonalsDataResource::class);
    }

    public function postPersonalData(Request $request)
    {
        $validated = ValidatorProvider::globalValidation($request->all());

        if ($validated->fails()) {
            return ValidatorProvider::errorResponse($validated);
        }

        $check = DatabaseProvider::checkExistData('POST', PersonalsData::class, 'Personal data has already been added by the user');
        if ($check['results']) {
            return $check['response'];
        }

        DatabaseProvider::addOnTable($request->all(), PersonalsData::class);

        return response()->json([
            'data' => [
                'code' => 201,
                'message' => 'Personal data has been created.'
            ]
        ], 201);
    }

    public function patchPersonalData(Request $request)
    {
        $validated = ValidatorProvider::globalValidation($request->all());

        if ($validated->fails()) {
            return ValidatorProvider::errorResponse($validated);
        }

        $check = DatabaseProvider::checkExistData('PATCH', PersonalsData::class, 'No data was found for this user');
        if ($check['results']) {
            return $check['response'];
        }

        DatabaseProvider::patchOnTable($request->all(), $check['response']);

        return response()->json([
            'code' => 200,
            'message' => 'Personal data has been updated'
        ], 201);
    }
}
