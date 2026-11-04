<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Volunteer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VolunteerController extends Controller
{
    /** Rol con el que se vincula un voluntario desde su propio formulario. */
    private const DEFAULT_ROLE = 'Voluntario';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $volunteers = Volunteer::withCount('membership')->get();
        return view('volunteers.index', compact('volunteers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organizations = Organization::orderBy('name')->get();
        return view('volunteers.create', compact('organizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'phone'           => 'required|string|max:30',
            'email'           => 'required|email|max:255|unique:volunteers,email',
            'city'            => 'required|string|max:100',
            'birth_date'      => 'required|date|before:today',
            'image'           => 'nullable|image|max:2048',
            'organizations'   => 'nullable|array',
            'organizations.*' => 'exists:organizations,id',
        ]);

        $volunteerData                  = collect($data)->except(['organizations', 'image'])->all();
        $volunteerData['image']         = $this->storeImage($request);
        $volunteerData['status']        = 1;
        $volunteerData['registered_by'] = $request->user()->id;

        $volunteer = Volunteer::create($volunteerData);

        foreach ($request->input('organizations', []) as $organizationId) {
            $volunteer->membership()->create([
                'organization_id' => $organizationId,
                'join_date'       => now()->toDateString(),
                'role'            => self::DEFAULT_ROLE,
                'registered_by'   => $request->user()->id,
            ]);
        }

        return redirect()->route('volunteers.index')->with('success', 'Voluntario creado correctamente');
    }

    public function show(Volunteer $volunteer)
    {
        $volunteer->load('membership.organization');
        return view('volunteers.show', compact('volunteer'));
    }

    public function edit(Volunteer $volunteer)
    {
        $organizations = Organization::orderBy('name')->get();
        $vinculadas    = $volunteer->membership()->pluck('organization_id')->toArray();
        return view('volunteers.edit', compact('volunteer', 'organizations', 'vinculadas'));
    }

    public function update(Request $request, Volunteer $volunteer)
    {
        $data = $request->validate([
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'phone'           => 'required|string|max:30',
            'email'           => 'required|email|max:255|unique:volunteers,email,' . $volunteer->id,
            'city'            => 'required|string|max:100',
            'birth_date'      => 'required|date|before:today',
            'image'           => 'nullable|image|max:2048',
            'organizations'   => 'nullable|array',
            'organizations.*' => 'exists:organizations,id',
        ]);

        $volunteerData = collect($data)->except(['organizations', 'image'])->all();

        if ($request->hasFile('image')) {
            $this->deleteImage($volunteer->image);
            $volunteerData['image'] = $this->storeImage($request);
        }

        $volunteer->update($volunteerData);

        $nuevas   = collect($request->input('organizations', []))->map(fn ($id) => (int) $id);
        $actuales = $volunteer->membership()->pluck('organization_id');

        // quita las que se desmarcaron
        $volunteer->membership()->whereNotIn('organization_id', $nuevas)->delete();

        // agrega las nuevas
        foreach ($nuevas->diff($actuales) as $organizationId) {
            $volunteer->membership()->create([
                'organization_id' => $organizationId,
                'join_date'       => now()->toDateString(),
                'role'            => self::DEFAULT_ROLE,
                'registered_by'   => $request->user()->id,
            ]);
        }

        return redirect()->route('volunteers.index')->with('success', 'Voluntario actualizado correctamente');
    }

    public function destroy(Volunteer $volunteer)
    {
        $volunteer->membership()->delete();
        $this->deleteImage($volunteer->image);
        $volunteer->delete();

        return redirect()->route('volunteers.index')->with('success', 'Voluntario eliminado correctamente');
    }

    /**
     * Guarda la foto subida en public/uploads/volunteers y devuelve el nombre del archivo.
     */
    private function storeImage(Request $request): ?string
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $image     = $request->file('image');
        $imagename = Str::slug($request->input('first_name')) . '-' . Carbon::now()->toDateString()
            . '-' . uniqid() . '.' . $image->extension();
        $image->move(public_path('uploads/volunteers'), $imagename);

        return $imagename;
    }

    private function deleteImage(?string $image): void
    {
        if ($image && file_exists(public_path('uploads/volunteers/' . $image))) {
            unlink(public_path('uploads/volunteers/' . $image));
        }
    }
}
