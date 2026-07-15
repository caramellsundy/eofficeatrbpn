<form method="POST" action="{{ route('profile.update') }}">

    @csrf
    @method('PATCH')

    <div class="row">

        <div class="col-md-6 mb-3">

            <label class="form-label fw-bold">
                Nama Lengkap
            </label>

            <input
                type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}"
                required>

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="col-md-6 mb-3">

            <label class="form-label fw-bold">
                Email
            </label>

            <input
                type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}"
                required>

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>

    <button class="btn btn-primary">

        <i class="fas fa-save"></i>

        Simpan Perubahan

    </button>

</form>