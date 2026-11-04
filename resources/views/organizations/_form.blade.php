{{-- Campos compartidos por create y edit. En create no existe $organization. --}}
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group">
            <label for="name">Nombre <strong style="color:red;">(*)</strong></label>
            <input type="text" id="name" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Por ejemplo, Fundación Manos Unidas"
                   autocomplete="off" value="{{ old('name', $organization->name ?? '') }}">
            @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group">
            <label for="type">Tipo <strong style="color:red;">(*)</strong></label>
            <input type="text" id="type" name="type" list="organization-types"
                   class="form-control @error('type') is-invalid @enderror"
                   placeholder="Por ejemplo, ONG"
                   autocomplete="off" value="{{ old('type', $organization->type ?? '') }}">
            <datalist id="organization-types">
                <option value="ONG">
                <option value="Fundación">
                <option value="Asociación">
                <option value="Corporación">
                <option value="Grupo comunitario">
            </datalist>
            @error('type')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group">
            <label for="creation_date">Fecha de creación <strong style="color:red;">(*)</strong></label>
            <input type="date" id="creation_date" name="creation_date"
                   class="form-control @error('creation_date') is-invalid @enderror"
                   value="{{ old('creation_date', isset($organization) ? \Carbon\Carbon::parse($organization->creation_date)->format('Y-m-d') : '') }}">
            @error('creation_date')
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
                   autocomplete="off" value="{{ old('email', $organization->email ?? '') }}">
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
                   autocomplete="off" value="{{ old('phone', $organization->phone ?? '') }}">
            @error('phone')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="address">Dirección <strong style="color:red;">(*)</strong></label>
            <input type="text" id="address" name="address"
                   class="form-control @error('address') is-invalid @enderror"
                   autocomplete="off" value="{{ old('address', $organization->address ?? '') }}">
            @error('address')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="city">Ciudad <strong style="color:red;">(*)</strong></label>
            <input type="text" id="city" name="city"
                   class="form-control @error('city') is-invalid @enderror"
                   autocomplete="off" value="{{ old('city', $organization->city ?? '') }}">
            @error('city')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea id="description" name="description" rows="4"
                      class="form-control @error('description') is-invalid @enderror"
                      placeholder="Describe brevemente la organización">{{ old('description', $organization->description ?? '') }}</textarea>
            @error('description')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
