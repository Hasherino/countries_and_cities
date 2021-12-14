<?php

namespace App\Http\Controllers;

use App\Models\city;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class cityController extends Controller
{
    public function index(Request $request)
    {
        $cities = city::createdBetween($request->created_after, $request->created_before)->
                        search($request->search)->order($request->sort)->paginate(10);

        if (count($cities) != 0) {
            return response($cities, 200);
        } else {
            return response("Not Found", 404);
        }
    }

    public function show($id)
    {
        $city = city::find($id);
        if ($city == null) {
            return response("Not Found", 404);
        } else {
            return response($city, 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response("Missing parameters", 400);
        }

        $newCity = city::create($request->all());

        $newCity->save();

        return response("City created", 201);
    }

    public function storeFile(Request $request)
    {
        $validator = Validator::make($request->file(), [
            'file' => 'required|mimes:json'
        ]);

        if ($validator->fails()) {
            return response("Bad file", 400);
        }

        $file = json_decode(file_get_contents($request->file), true);

        foreach ($file['cities'] as $city) {
            $validator = Validator::make($city, $this->rules());

            if ($validator->fails()) {
                return response("Missing parameters", 400);
            }

            city::create($city)->save();
        }

        return response("City/Cities created", 201);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response("Missing parameters", 400);
        }

        $city = city::findOrFail($id);
        $city->fill($request->all());
        $city->save();

        return response("City updated", 200);
    }

    public function delete($id)
    {
        city::findOrFail($id)->delete();

        return response("City deleted", 200);
    }

    public function rules() {
        return [
            'name' => 'required',
            'area' => 'required',
            'population' => 'required',
            'postal_code' => 'required',
            'country_id' => 'required'
        ];
    }
}
