<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use App\Models\OrganizationVolunteer;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::withCount('membership')->get();
        return view('organizations.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizationRequest $request)
    {
        Organization::create($request->validated() + [
            'status'        => true,
            'registered_by' => $request->user()->id,
        ]);

        return redirect()->route('organizations.index')->with('success', 'Organización creada correctamente');
    }

    public function show(Organization $organization)
    {
        $organization->load('membership.volunteer');
        $volunteers = Volunteer::orderBy('first_name')->get();
        return view('organizations.show', compact('organization', 'volunteers'));
    }

    public function edit(Organization $organization)
    {
        return view('organizations.edit', compact('organization'));
    }

    public function update(OrganizationRequest $request, Organization $organization)
    {
        $organization->update($request->validated());

        return redirect()->route('organizations.index')->with('success', 'Organización actualizada correctamente');
    }

    public function destroy(Organization $organization)
    {
        // los vínculos con voluntarios se borran solos (cascadeOnDelete en la migración)
        $organization->delete();

        return redirect()->route('organizations.index')->with('success', 'Organización eliminada correctamente');
    }

    /**
     * Vincula un voluntario a la organización (equivale a "inscribir" en eventos).
     */
    public function vincular(Request $request, Organization $organization)
    {
        $data = $request->validate([
            'volunteer_id' => 'required|exists:volunteers,id',
            'role'         => ['required', Rule::in(OrganizationVolunteer::ROLES)],
        ]);

        // evita duplicados
        if ($organization->volunteers()->whereKey($data['volunteer_id'])->exists()) {
            return back()->with('error', 'Ese voluntario ya pertenece a la organización');
        }

        $organization->volunteers()->attach($data['volunteer_id'], [
            'join_date'     => now()->toDateString(),
            'role'          => $data['role'],
            'registered_by' => $request->user()->id,
        ]);

        return redirect()->route('organizations.show', $organization)->with('success', 'Voluntario vinculado');
    }
}
