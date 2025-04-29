@extends('dashboard.layouts.main')

@section('content')
<section class="header-menu my-3">
    <div class="card m-0 border shadow-sm p-3">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-sm mt-2">Tambah Supllier <i
                    class="bi bi-plus-circle"></i></a>
        </div>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered border-dark mb-0 table-hover table-striped" id="datatablesSimple"
                style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                    <tr>
                        <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->contact_person ?? '-' }}</td>
                        <td>
                            @if($supplier->is_active)
                            <span class="badge bg-success">Aktif</span>
                            @else
                            <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('suppliers.show', $supplier->id) }}"
                                class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-3">
                {{ $suppliers->links() }}
            </div>
        </div>

    </div>
</section>
@endsection
