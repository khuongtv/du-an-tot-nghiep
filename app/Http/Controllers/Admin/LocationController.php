<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['keyword'] ?? "";
        if ($search != "") {
            $locations = Location::where('name', 'like', "%" . $request->keyword . "%")->paginate(30);
        } else {
            $locations = Location::all();
        }
        return view('admin.location.index', compact('locations', 'search'));
    }
}
