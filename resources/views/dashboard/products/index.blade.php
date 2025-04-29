@extends('dashboard.layouts.main')

@section('content')
<section class="header-menu my-3">
    <div class="card m-0 border shadow-sm p-3">
        <div class="d-flex align-items-center justify-content-start">
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm mt-2">Tambah Produk <i
                    class="bi bi-plus-circle"></i></a>
            <button class="btn btn-success btn-sm mt-2 mx-2" onclick="ExportExcel()">Export Produk <i
                    class="bi bi-download"></i></button>
            <button class="btn btn-danger btn-sm mt-2 mx-2" onclick="ImportExcel()">Import Produk <i
                    class="bi bi-upload"></i></button>
            <hr>

        </div>
        <hr>
        {{-- Export --}}
        <form action="{{ route('products.export') }}" method="POST">
            @csrf
            <table class="table table-bordered border-dark" id="Export_Product" style="display: none;">
                <tr>
                    <td>
                        <label for="fields">Pilih Fields yang mau di-export:</label><br>
                        <input type="checkbox" name="fields[]" value="id" checked> ID <br>
                        <input type="checkbox" name="fields[]" value="name" checked> Name <br>
                        <input type="checkbox" name="fields[]" value="category_name" checked> Kategori <br>
                        <input type="checkbox" name="fields[]" value="supplier_name" checked> Supplier <br>
                        <input type="checkbox" name="fields[]" value="price" checked> Harga <br>
                        <input type="checkbox" name="fields[]" value="availability" checked> Ketersediaan <br>
                        <input type="checkbox" name="fields[]" value="created_at" checked> Sejak <br>
                        <input type="checkbox" name="fields[]" value="updated_at" checked> Updated At <br>

                    </td>
                </tr>
                <tr>
                    <th>
                        <button type="submit" class="btn btn-success btn-sm mt-2">Export</button>
                    </th>
                </tr>
            </table>
        </form>
        {{-- Export --}}

        {{-- Import --}}
        <table class="table table-bordered border-dark" id="Import_Product" style="display: none;">
            <tr>
                <td>
                    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-4">
                        @csrf
                        <div>
                            <label class="block mb-1 font-semibold">Upload File Excel (.xlsx)</label>
                            <input type="file" name="file" accept=".xlsx" class="form-control" required>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success btn-sm mt-2">Import</button>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
        {{-- Import --}}

        <form method="GET" action="{{ route('products.index') }}" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari nama produk..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="sort_by" class="form-select">
                    <option value="">Urutkan berdasarkan</option>
                    <option value="name" {{ request('sort_by')=='name' ? 'selected' : '' }}>Nama</option>
                    <option value="price" {{ request('sort_by')=='price' ? 'selected' : '' }}>Harga</option>
                    <option value="available_since" {{ request('sort_by')=='available_since' ? 'selected' : '' }}>
                        Tanggal Tersedia</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="sort_direction" class="form-select">
                    <option value="asc" {{ request('sort_direction')=='asc' ? 'selected' : '' }}>Naik</option>
                    <option value="desc" {{ request('sort_direction')=='desc' ? 'selected' : '' }}>Turun</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered border-dark mb-0 table-hover table-striped" id="datatablesSimple"
                style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Supplier</th>
                        <th>Harga</th>
                        <th>Kesediaan</th>
                        <th>Sejak</th>
                        <th>Lampiran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category?->name ?? '-' }}</td>

                        <td>{{ $product->supplier?->name ?? '-' }}</td>

                        <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            @if ($product->is_active)
                            <span class="badge text-success">Tersedia</span>
                            @else
                            <span class="badge text-danger">Habis</span>
                            @endif
                        </td>
                        <td>
                            {{-- {{ $product->available_since->format('d M Y H:i') }} --}}
                            {{ $product->available_since->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                        </td>

                        <td>
                            @if ($product->attachment)
                            <a href="{{ Storage::url($product->attachment) }}" target="_blank"
                                class="btn btn-sm btn-outline-info">Lihat PDF</a>
                            @else
                            <em>-</em>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada produk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-end  mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</section>

<script>
    function ExportExcel() {
        var exportBox = document.getElementById("Export_Product");
        var importBox = document.getElementById("Import_Product");

        // Tutup Import kalau lagi kebuka
        if (importBox.style.display === "block") {
            importBox.style.display = "none";
        }

        // Toggle Export
        exportBox.style.display = (exportBox.style.display === "none" || exportBox.style.display === "")
            ? "block"
            : "none";
    }

    function ImportExcel() {
        var exportBox = document.getElementById("Export_Product");
        var importBox = document.getElementById("Import_Product");

        // Tutup Export kalau lagi kebuka
        if (exportBox.style.display === "block") {
            exportBox.style.display = "none";
        }

        // Toggle Import
        importBox.style.display = (importBox.style.display === "none" || importBox.style.display === "")
            ? "block"
            : "none";
    }
    </script>

@endsection
