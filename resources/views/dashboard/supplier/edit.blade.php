@extends('dashboard.layouts.main')

@section('content')
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-12">
            <div class="card m-0 border shadow-sm px-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mt-3"><i class="bi bi-pencil-square"></i> Edit Data Supplier</h5>
                </div>
                <hr>
                <div class="card-content">
                    <div class="card-body">

                        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Supplier</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Masukkan nama supplier"
                                            value="{{ old('name', $supplier->name ?? '') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="contact_person" class="form-label">Contact Person</label>
                                        <input type="text" id="contact_person" name="contact_person"
                                            class="form-control" placeholder="Masukkan contact person"
                                            value="{{ old('contact_person', $supplier->contact_person ?? '') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            placeholder="Masukkan email"
                                            value="{{ old('email', $supplier->email ?? '') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Telepon</label>
                                        <input type="text" id="phone" name="phone" class="form-control"
                                            placeholder="Masukkan nomor telepon"
                                            value="{{ old('phone', $supplier->phone ?? '') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Alamat</label>
                                        <input type="text" id="address" name="address" class="form-control"
                                            placeholder="Masukkan alamat"
                                            value="{{ old('address', $supplier->address ?? '') }}">
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">Kota</label>
                                        <input type="text" id="city" name="city" class="form-control"
                                            placeholder="Masukkan kota"
                                            value="{{ old('city', $supplier->city ?? '') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="province" class="form-label">Provinsi</label>
                                        <input type="text" id="province" name="province" class="form-control"
                                            placeholder="Masukkan provinsi"
                                            value="{{ old('province', $supplier->province ?? '') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="country" class="form-label">Negara</label>
                                        <input type="text" id="country" name="country" class="form-control"
                                            placeholder="Masukkan negara"
                                            value="{{ old('country', $supplier->country ?? 'Indonesia') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="whatsapp" class="form-label">WhatsApp</label>
                                        <input type="text" id="whatsapp" name="whatsapp" class="form-control"
                                            placeholder="Masukkan nomor WhatsApp"
                                            value="{{ old('whatsapp', data_get($supplier->contact_info, 'whatsapp', '')) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="website" class="form-label">Website</label>
                                        <input type="text" id="website" name="website" class="form-control"
                                            placeholder="Masukkan URL website"
                                            value="{{ old('website', data_get($supplier->contact_info, 'website', '')) }}">
                                    </div>


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status Aktif</label>
                                        <div class="d-flex align-items-center gap-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_active" id="aktif"
                                                    value="1" {{ old('is_active', $supplier->is_active ?? '') == 1 ?
                                                'checked' : '' }}>
                                                <label class="form-check-label" for="aktif">
                                                    Aktif
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_active"
                                                    id="nonaktif" value="0" {{ old('is_active', $supplier->is_active ??
                                                '') == 0 ?
                                                'checked' : '' }}>
                                                <label class="form-check-label" for="nonaktif">
                                                    Nonaktif
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="mt-4 d-flex gap-2">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </div>
                            </div>

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
                                @foreach ($supplier->audits->sortByDesc('created_at') as $audit)
                                    @php
                                        $userName = $audit->user->name ?? 'System';
                                        $actionLabel = ucfirst($audit->event);

                                        $fieldLabels = [
                                            'name' => 'Nama Supplier',
                                            'contact_person' => 'Contact Person',
                                            'email' => 'Email',
                                            'phone' => 'Telepon',
                                            'address' => 'Alamat',
                                            'city' => 'Kota',
                                            'province' => 'Provinsi',
                                            'country' => 'Negara',
                                            'is_active' => 'Status Aktif',
                                            'contact_info' => 'Informasi Kontak',
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
                                                Update
                                                {{ implode(', ', array_map(fn($field) => $fieldLabels[$field] ?? $field, $displayFields)) }}
                                            @else
                                                {{ $actionLabel }} Supplier
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#showAudit-{{ $audit->id }}">
                                                Show
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @foreach ($supplier->audits->sortByDesc('created_at') as $audit)
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

                                                    @if ($attribute === 'contact_info')
                                                        @php
                                                            $oldInfo = json_decode($old, true) ?? [];
                                                            $newInfo = json_decode($new, true) ?? [];
                                                            $allKeys = array_unique(array_merge(array_keys($oldInfo), array_keys($newInfo)));
                                                        @endphp

                                                        @foreach ($allKeys as $key)
                                                            <tr>
                                                                <td><strong>{{ ucwords(str_replace('_', ' ', $key)) }}</strong></td>
                                                                <td>{{ $oldInfo[$key] ?? '-' }}</td>
                                                                <td>{{ $newInfo[$key] ?? '-' }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td><strong>{{ $fieldLabels[$attribute] ?? ucwords(str_replace('_', ' ', $attribute)) }}</strong></td>
                                                            <td>{{ $old }}</td>
                                                            <td>{{ $new }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
