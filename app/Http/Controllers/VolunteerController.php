<?php

namespace App\Http\Controllers;

use App\Http\Requests\VolunteerRequest;
use App\Models\Organization;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
    public function store(VolunteerRequest $request)
    {
        $data                  = $request->safe()->except(['organizations', 'image']);
        $data['image']         = $request->file('image')?->store('volunteers', 'public');
        $data['status']        = true;
        $data['registered_by'] = $request->user()->id;

        // si falla algo, no queda un voluntario creado sin sus vínculos
        DB::transaction(function () use ($request, $data) {
            $volunteer = Volunteer::create($data);
            $volunteer->organizations()->attach($request->validated('organizations', []), $this->pivotData($request));
        });

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
        $vinculadas    = $volunteer->organizations()->pluck('organizations.id')->toArray();
        return view('volunteers.edit', compact('volunteer', 'organizations', 'vinculadas'));
    }

    public function update(VolunteerRequest $request, Volunteer $volunteer)
    {
        $data = $request->safe()->except(['organizations', 'image']);

        if ($request->hasFile('image')) {
            $this->deleteImage($volunteer->image);
            $data['image'] = $request->file('image')->store('volunteers', 'public');
        }

        DB::transaction(function () use ($request, $volunteer, $data) {
            $volunteer->update($data);

            $nuevas   = collect($request->validated('organizations', []))->map(fn ($id) => (int) $id);
            $actuales = $volunteer->organizations()->pluck('organizations.id');

            // quita las que se desmarcaron y agrega las nuevas; las que siguen marcadas
            // no se tocan, así conservan el rol y la fecha con que se vincularon
            $volunteer->organizations()->detach($actuales->diff($nuevas)->values()->all());
            $volunteer->organizations()->attach($nuevas->diff($actuales)->values()->all(), $this->pivotData($request));
        });

        return redirect()->route('volunteers.index')->with('success', 'Voluntario actualizado correctamente');
    }

    public function destroy(Volunteer $volunteer)
    {
        // los vínculos con organizaciones se borran solos (cascadeOnDelete en la migración)
        $volunteer->delete();
        $this->deleteImage($volunteer->image);

        return redirect()->route('volunteers.index')->with('success', 'Voluntario eliminado correctamente');
    }

    /**
     * Datos de la tabla intermedia al vincular desde el formulario del voluntario.
     */
    private function pivotData(Request $request): array
    {
        return [
            'join_date'     => now()->toDateString(),
            'role'          => self::DEFAULT_ROLE,
            'registered_by' => $request->user()->id,
        ];
    }

    /**
     * Borra la foto guardada en storage/app/public (se ve en /storage gracias a storage:link).
     */
    private function deleteImage(?string $image): void
    {
        if ($image) {
            Storage::disk('public')->delete($image);
        }
    }
}
