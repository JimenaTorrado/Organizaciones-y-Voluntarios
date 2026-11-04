{{-- Campos compartidos por create y edit. En create no existen $volunteer ni $vinculadas. --}}
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="first_name">Nombre <strong style="color:red;">(*)</strong></label>
            <input type="text" id="first_name" name="first_name"
                   class="form-control @error('first_name') is-invalid @enderror"
                   autocomplete="off" value="{{ old('first_name', $volunteer->first_name ?? '') }}">
            @error('first_name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="last_name">Apellido <strong style="color:red;">(*)</strong></label>
            <input type="text" id="last_name" name="last_name"
                   class="form-control @error('last_name') is-invalid @enderror"
                   autocomplete="off" value="{{ old('last_name', $volunteer->last_name ?? '') }}">
            @error('last_name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="email">Correo <strong style="color:red;">(*)</strong></label>
            <input type="email" id="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   autocomplete="off" value="{{ old('email', $volunteer->email ?? '') }}">
            @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="phone">Teléfono <strong style="color:red;">(*)</strong></label>
            <input type="text" id="phone" name="phone"
                   class="form-control @error('phone') is-invalid @enderror"
                   autocomplete="off" value="{{ old('phone', $volunteer->phone ?? '') }}">
            @error('phone')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="city">Ciudad <strong style="color:red;">(*)</strong></label>
            <input type="text" id="city" name="city"
                   class="form-control @error('city') is-invalid @enderror"
                   autocomplete="off" value="{{ old('city', $volunteer->city ?? '') }}">
            @error('city')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="birth_date">Fecha de nacimiento <strong style="color:red;">(*)</strong></label>
            <input type="date" id="birth_date" name="birth_date"
                   class="form-control @error('birth_date') is-invalid @enderror"
                   value="{{ old('birth_date', isset($volunteer) ? \Carbon\Carbon::parse($volunteer->birth_date)->format('Y-m-d') : '') }}">
            @error('birth_date')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

{{-- Foto --}}
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="image">Foto</label>
            @if(!empty($volunteer->image))
            <div class="mb-2">
                <img src="{{ asset('uploads/volunteers/' . $volunteer->image) }}" alt="Foto actual" style="max-width:100px;">
            </div>
            @endif
            <input type="file" id="image" name="image" accept="image/*"
                   class="form-control-file @error('image') is-invalid @enderror">
            @error('image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

{{-- Organizaciones --}}
<div class="form-group">
    <label>Vincular a organizaciones</label>
    @forelse($organizations as $organization)
    <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox"
               id="organization_{{ $organization->id }}" name="organizations[]" value="{{ $organization->id }}"
               {{ in_array($organization->id, old('organizations', $vinculadas ?? [])) ? 'checked' : '' }}>
        <label for="organization_{{ $organization->id }}" class="custom-control-label">
            {{ $organization->name }} - {{ $organization->city }}
        </label>
    </div>
    @empty
    <p class="text-muted">No hay organizaciones creadas</p>
    @endforelse
</div>
