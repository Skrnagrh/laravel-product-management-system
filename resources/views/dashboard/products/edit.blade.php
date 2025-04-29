@extends('dashboard.layouts.main')

@section('content')
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-12">
            <div class="card m-0 border shadow-sm px-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mt-3"><i class="bi bi-pencil-square"></i> Tambah Data Produk</h5>
                </div>
                <hr>
                <div class="card-content">
                    <div class="card-body">
                        <h3>Edit Produk: {{ $product->name }}</h3>

                        <form action="{{ route('products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Produk</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $product->name) }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Kategori</label>
                                        <select name="category_id" class="form-select" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach ($categories as $id => $name)
                                            <option value="{{ $id }}" {{ old('category_id', $product->category_id) ==
                                                $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="supplier_id" class="form-label">Supplier</label>
                                        <select name="supplier_id" class="form-select" required>
                                            <option value="">-- Pilih Supplier --</option>
                                            @foreach ($suppliers as $id => $name)
                                            <option value="{{ $id }}" {{ old('supplier_id', $product->supplier_id) ==
                                                $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Harga</label>
                                        <input type="number" name="price" class="form-control"
                                            value="{{ old('price', $product->price) }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="available_since" class="form-label">Tersedia Sejak</label>
                                        <input type="date" name="available_since" class="form-control"
                                            value="{{ old('available_since', \Carbon\Carbon::parse($product->available_since)->format('Y-m-d')) }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label d-block">Status Ketersediaan</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_active" id="tersedia"
                                                value="1" {{ old('is_active', $product->is_active) == 1 ? 'checked' : ''
                                            }}>
                                            <label class="form-check-label" for="tersedia">Tersedia</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_active" id="habis"
                                                value="0" {{ old('is_active', $product->is_active) == 0 ? 'checked' : ''
                                            }}>
                                            <label class="form-check-label" for="habis">Habis</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="attachment" class="form-label">Lampiran (PDF, 100–500KB)</label>
                                        <input type="file" name="attachment" class="form-control">
                                        @if ($product->attachment)
                                        <small class="d-block mt-1">
                                            File saat ini: <a href="{{ Storage::url($product->attachment) }}"
                                                target="_blank">Lihat Lampiran</a>
                                        </small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Batal</a>
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
                                @foreach ($product->audits->sortByDesc('created_at') as $audit)
                                @php
                                $userName = $audit->user->name ?? 'System';
                                $actionLabel = ucfirst($audit->event);

                                // Mapping field ke label
                                $fieldLabels = [
                                'name' => 'Nama Produk',
                                'category_id' => 'Kategori',
                                'supplier_id' => 'Supplier',
                                'price' => 'Harga',
                                'available_since' => 'Tersedia Sejak',
                                'is_active' => 'Status Ketersediaan',
                                'attachment' => 'Lampiran',
                                ];

                                $orderedFields = array_keys($fieldLabels);
                                $changedFields = array_keys((array) $audit->old_values);

                                // Susun urutan field: yang dikenal dulu, baru sisanya
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
                                        {{ implode(', ', array_map(fn($field) => $fieldLabels[$field] ?? $field,
                                        $displayFields)) }}
                                        @else
                                        {{ $actionLabel }} Produk
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#showAudit-{{ $audit->id }}">
                                            Show
                                        </button>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>

                        </table>

                        @foreach ($product->audits->sortByDesc('created_at') as $audit)
                        <div class="modal fade" id="showAudit-{{ $audit->id }}" tabindex="-1"
                            aria-labelledby="modalLabel-{{ $audit->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel-{{ $audit->id }}">Detail Perubahan
                                        </h5>
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

                                                @if ($attribute === 'metadata')
                                                @php
                                                $oldMetadata = json_decode($old, true) ?? [];
                                                $newMetadata = json_decode($new, true) ?? [];
                                                $allKeys = array_unique(array_merge(array_keys($oldMetadata),
                                                array_keys($newMetadata)));
                                                @endphp

                                                @foreach ($allKeys as $key)
                                                <tr>
                                                    <td><strong>{{ ucwords(str_replace('_', ' ', $key)) }}</strong>
                                                    </td>
                                                    <td>
                                                        @if ($key === 'attachment')
                                                        @if (!empty($oldMetadata[$key]))
                                                        <a href="{{ asset('storage/' . $oldMetadata[$key]) }}"
                                                            target="_blank">Lihat
                                                            File Lama</a>
                                                        @else
                                                        -
                                                        @endif
                                                        @elseif ($key === 'is_active')
                                                        {{ isset($oldMetadata[$key]) ? ($oldMetadata[$key] ?
                                                        'Tersedia' : 'Habis') :
                                                        '-' }}
                                                        @else
                                                        {{ $oldMetadata[$key] ?? '-' }}

                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($key === 'attachment')
                                                        @if (!empty($newMetadata[$key]))
                                                        <a href="{{ asset('storage/' . $newMetadata[$key]) }}"
                                                            target="_blank">Lihat
                                                            File Baru</a>
                                                        @else
                                                        -
                                                        @endif
                                                        @elseif ($key === 'is_active')
                                                        {{ isset($newMetadata[$key]) ? ($newMetadata[$key] ?
                                                        'Tersedia' : 'Habis') : '-'
                                                        }}
                                                        @else
                                                        {{ $newMetadata[$key] ?? '-' }}

                                                        @endif
                                                    </td>
                                                </tr>

                                                @endforeach
                                                @endif
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection