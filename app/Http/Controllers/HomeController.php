<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\OrganizationVolunteer;
use App\Models\Volunteer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'organizationsCount' => Organization::count(),
            'volunteersCount'    => Volunteer::count(),
            'membershipsCount'   => OrganizationVolunteer::count(),
        ]);
    }
}
