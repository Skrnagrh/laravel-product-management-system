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

                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Produk</label>
                                        <input type="text" name="name" class="form-control" placeholder="Nama Produk"
                                            value="{{ old('name', $product->name ?? '') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Kategori</label>
                                        <select name="category_id" class="form-select" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach ($categories as $id => $name)
                                            <option value="{{ $id }}" {{ old('category_id', $product->category_id ?? '')
                                                == $id ? 'selected' : '' }}>
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
                                            <option value="{{ $id }}" {{ old('supplier_id', $product->supplier_id ?? '')
                                                == $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Harga</label>
                                        <input type="number" name="price" class="form-control" placeholder="Harga"
                                            value="{{ old('price', $product->price ?? '') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="available_since" class="form-label">Tersedia Sejak</label>
                                        <input type="date" name="available_since" class="form-control"
                                            value="{{ old('available_since', isset($product->available_since) ? \Carbon\Carbon::parse($product->available_since)->format('Y-m-d') : '') }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label d-block">Status Ketersediaan</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_active" id="tersedia"
                                                value="1" {{ old('is_active', '1' )=='1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="tersedia">Tersedia</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_active" id="habis"
                                                value="0" {{ old('is_active')=='0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="habis">Habis</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="attachment" class="form-label">Lampiran (PDF, 100–500KB)</label>
                                        <input type="file" name="attachment" class="form-control">
                                        @if (isset($product) && $product->attachment)
                                        <small class="d-block mt-1">File saat ini: <a
                                                href="{{ Storage::url($product->attachment) }}" target="_blank">Lihat
                                                Lampiran</a></small>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="attachment" class="form-label">Lampiran (PDF, 100–500KB)</label>
                                        <input type="file" name="attachment" id="attachment" class="form-control">
                                        @if (isset($product) && $product->attachment)
                                        <small class="d-block mt-1">File saat ini: <a
                                                href="{{ Storage::url($product->attachment) }}" target="_blank">Lihat
                                                Lampiran</a></small>
                                        @endif
                                        <div id="file-error" class="text-danger mt-1" style="display: none;">Ukuran file
                                            melebihi 500KB!</div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Batal</a>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('attachment').addEventListener('change', function() {
        const file = this.files[0];
        const maxSize = 500 * 1024; 
        const errorDiv = document.getElementById('file-error');

        if (file && file.size > maxSize) {
            this.classList.add('is-invalid');
            errorDiv.style.display = 'block';
        } else {
            this.classList.remove('is-invalid');
            errorDiv.style.display = 'none';
        }
    });
</script>
@endsection
