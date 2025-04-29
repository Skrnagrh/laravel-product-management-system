@extends('dashboard.layouts.main')

@section('content')
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-12">
            <div class="card m-0 border shadow-sm px-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mt-3"><i class="bi bi-pencil-square"></i> Tambah Data User</h5>
                </div>
                <hr>
                <div class="card-content">
                    <div class="card-body">

                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" class="form-control text-capitalize" required value="{{ old('name') }}"
                                    placeholder="Nama Lengkap">
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required
                                    value="{{ old('email') }}" placeholder="Email">
                            </div>

                            <div class="mb-3 position-relative">
                                <label>Password</label>
                                <div class="position-relative">
                                    <input type="password" name="password" id="password" class="form-control pe-5"
                                        required placeholder="Password">
                                    <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3"
                                        id="togglePassword" style="cursor: pointer;"></i>
                                </div>
                            </div>

                            <div class="mb-3 position-relative">
                                <label>Konfirmasi Password</label>
                                <div class="position-relative">
                                    <input type="password" name="password_confirmation" id="passwordConfirmation"
                                        class="form-control pe-5" required placeholder="Konfirmasi Password">
                                    <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3"
                                        id="togglePasswordConfirmation" style="cursor: pointer;"></i>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Role</label>
                                <select name="role" class="form-select" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="karyawan" {{ old('role')=='karyawan' ? 'selected' : '' }}>Karyawan
                                    </option>
                                    <option value="staff" {{ old('role')=='staff' ? 'selected' : '' }}>Staff</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function setupPasswordToggle(inputId, toggleId) {
        const input = document.getElementById(inputId);
        const toggle = document.getElementById(toggleId);

        toggle.addEventListener('click', function () {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            toggle.classList.toggle('bi-eye');
            toggle.classList.toggle('bi-eye-slash');
        });
    }

    setupPasswordToggle('password', 'togglePassword');
    setupPasswordToggle('passwordConfirmation', 'togglePasswordConfirmation');
</script>
@endsection
