<?php

namespace App\Http\Controllers;

use App\Models\country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class countryController extends Controller
{
    public function index(Request $request)
    {
        $countries = country::createdBetween($request->created_after, $request->created_before)->
                              search($request->search)->order($request->sort)->paginate(10);

        if (count($countries) != 0) {
            return response($countries, 200);
        } else {
            return response("Not found", 404);
        }
    }

    public function show($id)
    {
        $country = country::find($id);
        if ($country == null) {
            return response("Not Found", 404);
        } else {
            return response($country, 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response("Missing parameters", 400);
        }

        $newCountry = country::create($request->all());

        $newCountry->save();

        return response("Country created", 201);
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

        foreach ($file['countries'] as $country) {
            $validator = Validator::make($country, $this->rules());

            if ($validator->fails()) {
                return response("Missing parameters", 400);
            }

            country::create($country)->save();
        }

        return response("Country/Countries created", 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response("Missing parameters", 400);
        }

        $country = country::findOrFail($id);
        $country->fill($request->all());
        $country->save();

        return response("Country updated", 200);
    }

    public function delete($id)
    {
        $country = country::findOrFail($id);
        foreach ($country->cities as $city) {
            $city->delete();
        }
        $country->delete();

        return response("Country deleted", 200);
    }

    public function rules() {
        return [
            'name' => 'required',
            'area' => 'required',
            'population' => 'required',
            'phone_code' => 'required'
        ];
    }
}
