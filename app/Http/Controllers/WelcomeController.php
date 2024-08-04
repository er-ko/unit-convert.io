<?php

namespace App\Http\Controllers;
use Illuminate\View\View;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('welcome.index', [
            'units' => [
                'length' => [
                    'in' => 'inch [in]',
                    'ft' => 'foot [ft]',
                    'yd' => 'yard [yd]',
                    'mi' => 'mile [mi]',
                    'mm' => 'millimeter [mm]',
                    'cm' => 'centimeter [cm]',
                    'dm' => 'decimetre [dm]',
                    'm' => 'meter [m]',
                    'km' => 'kilometer [km]',
                ],
                'weight' => [
                    'dr' => 'dram [dr]',
                    'oz' => 'ounce [oz]',
                    'lb' => 'pound [lb]',
                    'mg' => 'milligram [mg]',
                    'g' => 'gram [g]',
                    'dag' => 'decagram [dag]',
                    'kg' => 'kilogram [kg]',
                    't' => 'metric ton [t]',
                ],
                'temperature' => [
                    'f' => 'fahrenheit [°F]',
                    'c' => 'celsius [°C]',
                ],
                'speed' => [
                    'mph' => 'miles per hour [mph]',
                    'km/h' => 'kilometers per hour [km/h]',
                ],
                'combustion_car_consumption' => [
                    'mpg' => 'miles per galon [mpg]',
                    'l/100km' => 'litres per 100 km [l/100km]',
                ],
                'combustion_ev' => [
                    'wh/mi' => 'watt hours per mile [Wh/mi]',
                    'kwh/100km' => 'kilowatt hours per 100 km [kWh / 100km]',
                ],
            ],
        ]);
    }

    /**
     * Display a listing of the search query.
     */
    public function search(Request $request): Request
    {
        $query = $request->get('q');

        $results = [
            'id' => '1',
            'name' => 'tesla',
        ];

        return json_encode($results);
    }
}
