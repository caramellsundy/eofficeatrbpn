<div class="alert alert-danger">

    <h5 class="fw-bold">

        <i class="fas fa-exclamation-triangle"></i>

        Hapus Akun

    </h5>

    <p class="mb-3">

        Akun yang telah dihapus tidak dapat dikembalikan lagi.

    </p>

    <form
        action="{{ route('profile.destroy') }}"
        method="POST"
        onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">

        @csrf
        @method('DELETE')

        <button class="btn btn-danger">

            <i class="fas fa-trash"></i>

            Hapus Akun

        </button>

    </form>

</div>