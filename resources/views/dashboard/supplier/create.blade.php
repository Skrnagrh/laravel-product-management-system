@extends('dashboard.layouts.main')

@section('content')
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-12">
            <div class="card m-0 border shadow-sm px-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mt-3"><i class="bi bi-pencil-square"></i> Tambah Data Supplier</h5>
                </div>
                <hr>
                <div class="card-content">
                    <div class="card-body">

                        <form action="{{ route('suppliers.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Supplier</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Masukkan nama supplier" value="{{ old('name') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="contact_person" class="form-label">Contact Person</label>
                                        <input type="text" id="contact_person" name="contact_person"
                                            class="form-control" placeholder="Masukkan contact person"
                                            value="{{ old('contact_person') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            placeholder="Masukkan email" value="{{ old('email') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Telepon</label>
                                        <input type="text" id="phone" name="phone" class="form-control"
                                            placeholder="Masukkan nomor telepon" value="{{ old('phone') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Alamat</label>
                                        <input type="text" id="address" name="address" class="form-control"
                                            placeholder="Masukkan alamat" value="{{ old('address') }}">
                                    </div>

                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label for="city" class="form-label">Kota</label>
                                        <input type="text" id="city" name="city" class="form-control"
                                            placeholder="Masukkan kota" value="{{ old('city') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="province" class="form-label">Provinsi</label>
                                        <input type="text" id="province" name="province" class="form-control"
                                            placeholder="Masukkan provinsi" value="{{ old('province') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="country" class="form-label">Negara</label>
                                        <input type="text" id="country" name="country" class="form-control"
                                            placeholder="Masukkan negara" value="{{ old('country', 'Indonesia') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="whatsapp" class="form-label">WhatsApp</label>
                                        <input type="text" id="whatsapp" name="whatsapp" class="form-control"
                                            placeholder="Masukkan nomor WhatsApp" value="{{ old('whatsapp') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="website" class="form-label">Website</label>
                                        <input type="text" id="website" name="website" class="form-control"
                                            placeholder="Masukkan URL website" value="{{ old('website') }}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label d-block">Status Aktif</label>
                                        <div class="d-flex align-items-center gap-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_active" id="aktif"
                                                    value="1" {{ old('is_active', '1' )=='1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="aktif">
                                                    Aktif
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_active"
                                                    id="nonaktif" value="0" {{ old('is_active')=='0' ? 'checked' : ''
                                                    }}>
                                                <label class="form-check-label" for="nonaktif">
                                                    Nonaktif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-4 d-flex gap-2">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
