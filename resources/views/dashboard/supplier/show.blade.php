@extends('dashboard.layouts.main')

@section('content')
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-12">
            <div class="card m-0 border shadow-sm px-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mt-3"><i class="bi bi-eye"></i> Detail Supplier</h5>
                </div>
                <hr>
                <div class="card-content">
                    <div class="card-body">

                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <strong>Nama Supplier:</strong><br>
                                    {{ $supplier->name }}
                                </div>

                                <div class="mb-2">
                                    <strong>Contact Person:</strong><br>
                                    {{ $supplier->contact_person }}
                                </div>

                                <div class="mb-2">
                                    <strong>Email:</strong><br>
                                    @if ($supplier->email)
                                        <a href="mailto:{{ $supplier->email }}" target="_blank" class="text-decoration-none">
                                            <i class="bi bi-envelope-fill"></i> {{ $supplier->email }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </div>

                                <div class="mb-2">
                                    <strong>Telepon:</strong><br>
                                    @if ($supplier->phone)
                                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $supplier->phone) }}"
                                           class="text-decoration-none">
                                            <i class="bi bi-telephone-fill"></i> {{ $supplier->phone }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </div>


                                <div class="mb-2">
                                    <strong>Alamat:</strong><br>
                                    {{ $supplier->address ?? '-' }}
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <strong>Kota:</strong><br>
                                    {{ $supplier->city ?? '-' }}
                                </div>

                                <div class="mb-2">
                                    <strong>Provinsi:</strong><br>
                                    {{ $supplier->province ?? '-' }}
                                </div>

                                <div class="mb-2">
                                    <strong>Negara:</strong><br>
                                    {{ $supplier->country ?? '-' }}
                                </div>

                                <div class="mb-2">
                                    <strong>WhatsApp:</strong><br>
                                    @if (data_get($supplier->contact_info, 'whatsapp'))
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', data_get($supplier->contact_info, 'whatsapp')) }}"
                                           target="_blank" class="text-decoration-none">
                                            <i class="bi bi-whatsapp"></i> {{ data_get($supplier->contact_info, 'whatsapp') }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </div>

                                <div class="mb-2">
                                    <strong>Website:</strong><br>
                                    @if (data_get($supplier->contact_info, 'website'))
                                        <a href="{{ data_get($supplier->contact_info, 'website') }}"
                                           target="_blank" class="text-decoration-none">
                                            <i class="bi bi-globe2"></i> {{ data_get($supplier->contact_info, 'website') }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </div>

                                <div class="mb-2">
                                    <strong>Status:</strong><br>
                                    {{ $supplier->is_active ? 'Aktif' : 'Nonaktif' }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Kembali</a>
                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-primary">Edit</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
