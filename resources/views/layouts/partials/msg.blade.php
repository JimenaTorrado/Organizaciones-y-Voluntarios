@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>
            <span>
                <b> Advertencia - </b> {{ $error }}
            </span>
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert alert-success">
        <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>
        <span>
            <b> Éxito - </b> {{ session('success') }}
        </span>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>
        <span>
            <b> Error - </b> {{ session('error') }}
        </span>
    </div>
@endif
