@extends('app')
@section('content')
    <div class="card">
        <h5 class="card-header">List Data Pegawai</h5>
        <div class="card-body">

            <p class="card-text h4 mt-3 mb-5">Cari Data Berdasarkan Waktu Bergabung dengan Rentang Tanggal <input
                    type="text" id="dateRangePicker" /></p>
            <a href="{{ url('/add') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Pegawai</a>
            <div class="table-responsive">

                <table id="example" class="table table-striped table-bordered p-3" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>Nomor Telepon</th>
                            <th>Agama</th>
                            <th>Status Menikah</th>
                            <th>Tanggal Bergabung</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="data_api">
                        <tr>
                            <td colspan="11" class="text-center">Data Masih Kosong</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
