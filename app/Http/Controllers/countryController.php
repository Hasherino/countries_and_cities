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
            return response()->json($countries);
        } else {
            return 404;
        }
    }

    public function show($id)
    {
        return response()->json(country::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'area' => 'required',
            'population' => 'required',
            'phone_code' => 'required'
        ]);

        if ($validator->fails()) {
            return 400;
        }

        $newCountry = country::create([
            'name' => $request->name,
            'area' => $request->area,
            'population' => $request->population,
            'phone_code' => $request->phone_code,
        ]);

        $newCountry->save();

        return 201;
    }

    public function storeFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:json'
        ]);

        $file = json_decode(file_get_contents($request->file), true);
        $newCountries = array();

        foreach ($file['countries'] as $country) {
            $validator = Validator::make($country, $this->rules());

            if ($validator->fails()) {
                return 400;
            }

            $newCountry = country::create([
                'name' => $country['name'],
                'area' => $country['area'],
                'population' => $country['population'],
                'phone_code' => $country['phone_code'],
            ]);

        $newCountry->save();
        $newCountries[] = $newCountry;
        }

        return 201;
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return 400;
        }

        $country = country::findOrFail($id);
        $country->name = $request->name;
        $country->area = $request->area;
        $country->population = $request->population;
        $country->phone_code = $request->phone_code;
        $country->save();

        return 200;
    }

    public function delete($id)
    {
        $country = country::findOrFail($id);
        foreach ($country->cities as $city) {
            $city->delete();
        }
        $country->delete();

        return 200;
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
