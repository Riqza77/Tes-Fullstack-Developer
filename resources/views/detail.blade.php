@extends('app')
@section('content')
    <div class="card">
        <h5 class="card-header">{{ str_replace('Halaman ', '', $judul) }}</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%">NIP Pegawai</th>
                        <td>:</td>
                        <td> {{ $pegawai->nip }}</td>
                    </tr>
                    <tr>
                        <th style="width:50%">Nama Pegawai</th>
                        <td>:</td>
                        <td> {{ $pegawai->nama }}</td>
                    </tr>
                    <tr>
                        <th style="width:50%">Jenis Kelamin Pegawai</th>
                        <td>:</td>
                        <td> {{ $pegawai->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th style="width:50%">Email Pegawai</th>
                        <td>:</td>
                        <td> {{ $pegawai->email }}</td>
                    </tr>
                    <tr>
                        <th style="width:50%">Nomor Pegawai</th>
                        <td>:</td>
                        <td> +62 {{ $pegawai->no_telp }}</td>
                    </tr>
                    <tr>
                        <th style="width:50%">Agama Pegawai</th>
                        <td>:</td>
                        <td> {{ $pegawai->agama }}</td>
                    </tr>
                    <tr>
                        <th style="width:50%">Status Pegawai</th>
                        <td>:</td>
                        <td> {{ $pegawai->status_nikah }}</td>
                    </tr>
                    <tr>
                        <th style="width:50%">Bergabung Pada</th>
                        <td>:</td>
                        <td> {{ \Carbon\Carbon::parse($pegawai->tgl_bergabung)->translatedFormat('l, d F Y') }}</td>
                    </tr>
                    <tr>
                        <th style="width:50%">Foto</th>
                        <td>:</td>
                        <td>
                            @if ($pegawai->foto)
                                <img width="20%" height="20%" src="{{ url('/storage/profil/' . $pegawai->foto) }}"
                                    alt="foto">
                            @else
                                <span>Belum Ada Foto</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('delete', $pegawai->id) }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit"
                                    onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Pegawai?')"
                                    class="btn btn-sm btn-danger ml-2">Hapus</button>
                            </form>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>

                </table>

            </div>
            @if (empty($pegawai->berkas[0]->berkas))
                <h3 class="mt-3 text-center">Berkas Masih Kosong</h3>
                <form action="{{ route('berkas', $pegawai->id) }}" enctype="multipart/form-data" method="post"
                    class="dropzone">
                    <!-- this is were the previews should be shown. -->
                    @csrf
                    <div>
                        <h3 class="text-center">Silahkan Upload Beberapa Berkas</h3>
                    </div>
                    <div class="previews"></div>
                </form>
                <div>*Setelah Upload, Silahkan Refresh Page ini atau klik <a href=""
                        onClick="window.location.reload()">Disini</a></div>
            @else
                @php
                    $no = 1;
                @endphp
                <div class="mt-3 row">
                    <h2 class="text-center">Data Berkas {{ $pegawai->nama }}</h2>
                    @foreach ($pegawai->berkas as $item)
                        <div class="col-sm-3 mb-3 mt-2 mb-sm-0">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body text-center">
                                    <img width="10%" height="10%" src="{{ url('/storage/berkas/' . $item->berkas) }}"
                                        class="card-img-top" alt="Berkas {{ $no }}">
                                    <h3 class="card-title mt-2">Berkas {{ $no++ }}</h3>
                                    <form action="{{ route('hapus_berkas', $item->id) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit"
                                            onclick="return confirm('Apakah Anda Yakin Ingin Menghapusnya?')"
                                            class="btn btn-primary">Hapus Berkas</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <form action="{{ route('hapus', $pegawai->id) }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" onclick="return confirm('Apakah Anda Yakin Semua Berkas?')"
                        class="btn btn-primary float-right mt-3">Hapus Semua Berkas</button>
                </form>
            @endif
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Pegawai</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>

                <form action="{{ route('update', $pegawai->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3 row">
                                    <label for="nip" class="form-label col-3">NIP Pegawai</label>
                                    <input type="number" class="form-control form-control-sm m-2 col-9" maxlength="9"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        required id="nip" name="nip" value="{{ $pegawai->nip }}">
                                </div>
                                <div class="input-group mb-3 row">
                                    <label for="nama" class="form-label col-3">Nama Pegawai</label>
                                    <input type="text" class="form-control form-control-sm m-2 col-9" required
                                        minlength="5" id="nama" name="nama" value="{{ $pegawai->nama }}">
                                    <div id="error-username" class="invalid-feedback"></div>
                                </div>
                                <div class="input-group mb-3 row">
                                    <label for="exampleFormControlInput1" class="form-label col-3">Email Pegawai</label>
                                    <input type="email" class="form-control form-control-sm m-2 col-9" required
                                        id="exampleFormControlInput1" placeholder="name@example.com" name="email"
                                        value="{{ $pegawai->email }}">
                                </div>
                                <div class="input-group mb-3 row">
                                    <label for="no_telp" class="form-label col-3">Nomor Pegawai</label>
                                    <input class="form-control form-control-sm m-2 col-1 btn btn-sm btn-dark bg-white"
                                        placeholder="+62" disabled>
                                    <input type="number" class="form-control form-control-sm m-2 col-8" maxlength="10"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        required id="no_telp" placeholder="Example : 82134561726" name="no_telp"
                                        value="{{ $pegawai->no_telp }}">
                                </div>
                                <div class="input-group mb-3 row">
                                    <label for="agama" class="form-label col-3">Agama Pegawai</label>
                                    <select name="agama" id="agama"
                                        class="form-select form-control form-control-lg bg-light fs-6 rounded-pill"
                                        required>
                                        @php
                                            $agama = ['Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu'];
                                        @endphp
                                        @foreach ($agama as $item)
                                            <option value="{{ $item }}"
                                                {{ $pegawai->agama == $item ? 'selected' : '' }}>{{ $item }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="input-group mb-3 row">
                                    <label for="jenis_kelamin" class="form-label col-3">Jenis Kelamin Pegawai</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin"
                                        class="form-select form-control form-control-lg bg-light fs-6 rounded-pill"
                                        required>
                                        @php
                                            $jenis_kelamin = ['Laki - Laki', 'Perempuan'];
                                        @endphp
                                        @foreach ($jenis_kelamin as $item)
                                            <option value="{{ $item }}"
                                                {{ $pegawai->jenis_kelamin == $item ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="input-group mb-3 row">
                                    <label for="status_nikah" class="form-label col-3">Status Pegawai</label>
                                    <select name="status_nikah" id="status_nikah"
                                        class="form-select form-control form-control-lg bg-light fs-6 rounded-pill"
                                        required>
                                        @php
                                            $status_nikah = ['Belum Menikah', 'Menikah', 'Cerai Mati', 'Cerai Hidup'];
                                        @endphp
                                        @foreach ($status_nikah as $item)
                                            <option value="{{ $item }}"
                                                {{ $pegawai->status_nikah == $item ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="input-group mb-3 row">
                                    <label for="tgl_bergabung" class="form-label col-3">Tanggal Masuk Pegawai</label>
                                    <input type="text" name="tgl_bergabung" required
                                        class="form-control form-control-sm m-2 col-9 tgl"
                                        value="{{ $pegawai->tgl_bergabung }}">
                                </div>
                                <div class="input-group mb-3 row">
                                    <label for="foto" class="form-label col-3">Foto Pegawai</label>
                                    <input id="foto" name="foto" type="file"
                                        class="form-control form-control-sm m-2 col-9" accept="image/*"
                                        data-browse-on-zone-click="true">

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
