@extends('app')
@section('content')
    <div class="card">
        <h5 class="card-header">{{ str_replace('Halaman ', '', $judul) }} Data Pegawai</h5>
        <div class="card-body">
            <p class="card-text mb-3">Silahkan isi form dibawah..</p>
            <form id="myForm" action="{{ route('tambah') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3 row">
                    <label for="nip" class="form-label col-3">NIP Pegawai</label>
                    <input type="number" class="form-control form-control-sm m-2 col-9" maxlength="9"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        required id="nip" name="nip">
                </div>
                <div class="input-group mb-3 row">
                    <label for="nama" class="form-label col-3">Nama Pegawai</label>
                    <input type="text" class="form-control form-control-sm m-2 col-9" required minlength="5"
                        id="nama" name="nama">
                    <div id="error-username" class="invalid-feedback"></div>
                </div>
                <div class="input-group mb-3 row">
                    <label for="exampleFormControlInput1" class="form-label col-3">Email Pegawai</label>
                    <input type="email" class="form-control form-control-sm m-2 col-9" required
                        id="exampleFormControlInput1" placeholder="name@example.com" name="email">
                </div>
                <div class="input-group mb-3 row">
                    <label for="no_telp" class="form-label col-3">Nomor Pegawai</label>
                    <input class="form-control form-control-sm m-2 col-1 btn btn-sm btn-dark bg-white" placeholder="+62"
                        disabled>
                    <input type="number" class="form-control form-control-sm m-2 col-8" maxlength="10"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        required id="no_telp" placeholder="Example : 82134561726" name="no_telp">
                </div>
                <div class="input-group mb-3 row">
                    <label for="agama" class="form-label col-3">Agama Pegawai</label>
                    <select name="agama" id="agama"
                        class="form-select form-control form-control-lg bg-light fs-6 rounded-pill" required>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                </div>
                <div class="input-group mb-3 row">
                    <label for="jenis_kelamin" class="form-label col-3">Jenis Kelamin Pegawai</label>
                    <select name="jenis_kelamin" id="jenis_kelamin"
                        class="form-select form-control form-control-lg bg-light fs-6 rounded-pill" required>
                        <option value="Laki - Laki">Laki - Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="input-group mb-3 row">
                    <label for="status_nikah" class="form-label col-3">Status Pegawai</label>
                    <select name="status_nikah" id="status_nikah"
                        class="form-select form-control form-control-lg bg-light fs-6 rounded-pill" required>
                        <option value="Belum Menikah">Belum Menikah</option>
                        <option value="Menikah">Menikah</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                    </select>
                </div>
                <div class="input-group mb-3 row">
                    <label for="tgl_bergabung" class="form-label col-3">Tanggal Masuk Pegawai</label>
                    <input type="text" name="tgl_bergabung" required class="form-control form-control-sm m-2 col-9 tgl">
                </div>
                <div class="input-group mb-3 row">
                    <label for="foto" class="form-label col-3">Foto Pegawai</label>
                    <input id="foto" name="foto" type="file" required
                        class="form-control form-control-sm m-2 col-9" accept="image/*" data-browse-on-zone-click="true">
                </div>

                <button type="submit" class="btn btn-primary float-right mr-3">Simpan</button>
            </form>
        </div>
    </div>
@endsection
