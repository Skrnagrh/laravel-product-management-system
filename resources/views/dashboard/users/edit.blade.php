@extends('dashboard.layouts.main')

@section('content')
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-12">
            <div class="card m-0 border shadow-sm px-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mt-3 text-capitalize"><i class="bi bi-pencil-square"></i> Edit Data {{ $user->name }}
                    </h5>
                </div>
                <hr>
                <div class="card-content">
                    <div class="card-body">

                        <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($user))
                            @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control text-capitalize"
                                    value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                            </div>

                            @if (!isset($user))
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            @endif

                            <div class="mb-3">
                                <label>Role</label>
                                <select name="role" class="form-select" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : ''
                                        }}>Admin</option>
                                    <option value="karyawan" {{ old('role', $user->role ?? '') == 'karyawan' ?
                                        'selected' : '' }}>Karyawan</option>
                                    <option value="staff" {{ old('role', $user->role ?? '') == 'staff' ? 'selected' : ''
                                        }}>Staff</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Update' : 'Simpan'
                                }}</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                        </form>

                        <hr>
                        <h4>Audit Trail</h4>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal Perubahan</th>
                                    <th>Action</th>
                                    <th>User</th>
                                    <th>Note</th>
                                    <th>Show</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($user->audits->sortByDesc('created_at') as $audit)
                                @php
                                $userName = $audit->user->name ?? 'System';
                                $actionLabel = ucfirst($audit->event);
                                $fieldLabels = [
                                'name' => 'Nama',
                                'email' => 'Email',
                                'role' => 'Role',
                                'password' => 'Password'
                                ];
                                $orderedFields = array_keys($fieldLabels);
                                $changedFields = array_keys((array) $audit->old_values);

                                $displayFields = array_merge(
                                array_filter($orderedFields, fn($f) => in_array($f, $changedFields)),
                                array_filter($changedFields, fn($f) => !in_array($f, $orderedFields))
                                );
                                @endphp

                                <tr>
                                    <td>{{ $audit->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $actionLabel }}</td>
                                    <td>{{ $userName }}</td>
                                    <td>
                                        @if ($audit->event === 'updated')
                                        Update {{ implode(', ', array_map(fn($field) => $fieldLabels[$field] ?? $field,
                                        $displayFields)) }}
                                        @else
                                        {{ $actionLabel }} User
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#showAudit-{{ $audit->id }}">
                                            Show
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data audit.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @foreach ($user->audits->sortByDesc('created_at') as $audit)
                        <div class="modal fade" id="showAudit-{{ $audit->id }}" tabindex="-1"
                            aria-labelledby="modalLabel-{{ $audit->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel-{{ $audit->id }}">Detail Perubahan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-sm table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Field</th>
                                                    <th>Old</th>
                                                    <th>New</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($audit->getModified() as $attribute => $values)
                                                @php
                                                $old = $values['old'] ?? '-';
                                                $new = $values['new'] ?? '-';
                                                @endphp
                                                <tr>
                                                    <td><strong>{{ $fieldLabels[$attribute] ?? ucwords(str_replace('_',
                                                            ' ', $attribute)) }}</strong></td>
                                                    <td>{{ $old }}</td>
                                                    <td>{{ $new }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
