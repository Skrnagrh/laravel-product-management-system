@extends('dashboard.layouts.main')


@section('content')

<section class="header-menu my-3">
    <div class="card m-0 border shadow-sm p-3">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm mt-2">Tambah Kategori <i
                    class="bi bi-plus-circle"></i></a>
        </div>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered border-dark mb-0 table-hover table-striped" id="category-table"
                style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                    <tr>
                        <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            @if ($category->is_active)
                            <span class="badge bg-success">Aktif</span>
                            @else
                            <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Hapus kategori?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-end mt-3">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</section>


@endsection
