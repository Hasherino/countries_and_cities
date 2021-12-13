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
            return response()->json($cities);
        } else {
            return 404;
        }
    }

    public function show($id)
    {
        return response()->json(city::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'area' => 'required',
            'population' => 'required',
            'postal_code' => 'required',
            'country_id' => 'required'
        ]);

        if ($validator->fails()) {
            return 400;
        }

        $newCity = city::create([
            'name' => $request->name,
            'area' => $request->area,
            'population' => $request->population,
            'postal_code' => $request->postal_code,
            'country_id' => $request->country_id,
        ]);

        $newCity->save();

        return 201;
    }

    public function storeFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:json'
        ]);

        $file = json_decode(file_get_contents($request->file), true);
        $newCities = array();

        foreach ($file['cities'] as $city) {
            $validator = Validator::make($city, $this->rules());

            if ($validator->fails()) {
                return 400;
            }

            $newCity = city::create([
                'name' => $city['name'],
                'area' => $city['area'],
                'population' => $city['population'],
                'postal_code' => $city['postal_code'],
                'country_id' => $city['country_id']
            ]);

            $newCity->save();
            $newCities[] = $newCity;
        }

        return 201;
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return 400;
        }

        $city = city::findOrFail($id);
        $city->name = $request->name;
        $city->area = $request->area;
        $city->population = $request->population;
        $city->postal_code = $request->postal_code;
        $city->country_id = $request->country_id;
        $city->save();

        return 200;
    }

    public function delete($id)
    {
        city::findOrFail($id)->delete();

        return 200;
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
