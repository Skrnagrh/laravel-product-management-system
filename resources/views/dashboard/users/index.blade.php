@extends('dashboard.layouts.main')

@section('content')

<section class="header-menu my-3">
    <div class="card m-0 border shadow-sm p-3">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mt-2">Tambah User <i
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
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                style="display:inline-block;" onsubmit="return confirm('Yakin hapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- <div class="d-flex justify-content-end mt-3">
                {{ $user->links() }}
            </div> --}}
        </div>

    </div>
</section>
@endsection
