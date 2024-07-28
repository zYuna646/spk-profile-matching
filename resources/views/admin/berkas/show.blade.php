@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Fluid - Layouts')

@section('page-style')
<style>
    .spaced-container {
        padding-top: 5%;
        padding-bottom: 5%;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-group label {
        font-weight: bold;
    }

    .btn-custom {
        background-color: #ff5a5f;
        border-color: #ff5a5f;
        color: white;
    }

    .btn-custom:hover {
        background-color: #ff4040;
        border-color: #ff4040;
    }
</style>
@endsection

@section('content')
 
    <!-- Layout Demo -->
    <div class="">
        @php
            use Illuminate\Support\Facades\Storage;
            $status = $peserta->status_berkas;
        @endphp
        <div class="card mb-4">
                <div class="container spaced-container">
                    <form action="{{ route('peserta.berkas.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Informasi Dasar</h4>
                                        <div class="form-group mb-4">
                                            <label for="file_ijazah">Foto</label>
                                            @if ($peserta->foto)
                                            <a href="{{ Storage::url($peserta->foto) }}" target="_blank">Lihat Foto</a>
                                            @endif
                                            <input type="file" class="form-control" id="file_ijazah" name="foto"
                                                accept=".png" @if ($status != 'belum') disabled @endif>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="jk">Jenis Kelamin</label>
                                            <select class="form-control" id="jk" name="jk"
                                                @if ($status != 'belum') disabled @endif>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L" @if ($peserta->jk == 'L') selected @endif>
                                                    Laki-laki</option>
                                                <option value="P" @if ($peserta->jk == 'P') selected @endif>
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                                value="{{ $peserta->tgl_lahir }}"
                                                @if ($status != 'belum') disabled @endif>
                                        </div>
                                        <div class="form-group mb-4" >
                                            <label for="agama">Agama</label>
                                            <select class="form-control" id="agama" name="agama"
                                                @if ($status != 'belum') disabled @endif>
                                                <option value="">Pilih Agama</option>
                                                <option value="islam" @if ($peserta->agama == 'islam') selected @endif>
                                                    Islam</option>
                                                <option value="kristen" @if ($peserta->agama == 'kristen') selected @endif>
                                                    Kristen</option>
                                                <option value="hindu" @if ($peserta->agama == 'hindu') selected @endif>
                                                    Hindu</option>
                                                <option value="buddha" @if ($peserta->agama == 'buddha') selected @endif>
                                                    Buddha</option>
                                                <option value="konghucu"
                                                    @if ($peserta->agama == 'konghucu') selected @endif>Konghucu</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="provinsi">Provinsi</label>
                                            <select class="form-control" id="provinsi" name="provinsi_id"
                                                onchange="filterKabupaten()"
                                                @if ($status != 'belum') disabled @endif>
                                                <option value="">Pilih Provinsi</option>
                                                @foreach ($provinsi as $prov)
                                                    <option value="{{ $prov->id }}"
                                                        @if ($peserta->provinsi_id == $prov->id) selected @endif>
                                                        {{ $prov->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="kabupaten">Kabupaten</label>
                                            <select class="form-control" id="kabupaten" name="kabupaten_id"
                                                @if ($status != 'belum') disabled @endif>
                                                <option value="">Pilih Kabupaten</option>
                                                @foreach ($kabupaten as $kab)
                                                    <option value="{{ $kab->id }}"
                                                        @if ($peserta->kabupaten_id == $kab->id) selected @endif>
                                                        {{ $kab->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="no_tlp">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="no_tlp" name="no_tlp"
                                                value="{{ $peserta->no_tlp }}"
                                                @if ($status != 'belum') disabled @endif>
                                        </div>
                                        <div class="form-group mb-4 ">
                                            <label for="sosial_media">Akun Media Sosial</label>
                                            <textarea class="form-control" id="sosial_media" name="sosial_media" rows="3"
                                                @if ($status != 'belum') disabled @endif>{{ $peserta->sosial_media }}</textarea>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                                value="{{ $peserta->pekerjaan }}"
                                                @if ($status != 'belum') disabled @endif>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="latar_belakang">Latar Belakang</label>
                                            <textarea class="form-control" id="latar_belakang" name="latar_belakang" rows="3"
                                                @if ($status != 'belum') disabled @endif>{{ $peserta->latar_belakang }}</textarea>
                                        </div>
                                       
                                        <div class="form-group mb-4">
                                            <label for="isPertukaran">Program Pertukaran</label>
                                            <input type="checkbox" id="isPertukaran" name="isPertukaran" value="1"
                                                @if ($peserta->isPertukaran) checked @endif
                                                @if ($status != 'belum') disabled @endif>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="peran_organisasi">Program
                                                dan
                                                Periode</label>
                                            <textarea class="form-control" id="peran_organisasi" name="peran_organisasi" rows="3"
                                                @if ($status != 'belum') disabled @endif>{{ $peserta->peran_organisasi }}</textarea>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="motivasi">Organisasi
                                                Dan
                                                Periode </label>
                                            <textarea class="form-control" id="motivasi" name="motivasi" rows="3"
                                                @if ($status != 'belum') disabled @endif>{{ $peserta->motivasi }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Berkas</h4>
                                        <div class="form-group mb-4">
                                            <label for="file_ijazah">Upload Ijazah*</label>
                                            @if ($peserta->file_ijazah)
                                                <a href="{{ Storage::url($peserta->file_ijazah) }}" target="_blank">Lihat
                                                    Ijazah</a>
                                            @endif
                                            <input type="file" class="form-control" id="file_ijazah"
                                                name="file_ijazah" accept=".pdf, .jpg, .png"
                                                @if ($status != 'belum') disabled @endif>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="file_ktp">Upload KTP*</label>
                                            @if ($peserta->file_ktp)
                                                <a href="{{ Storage::url($peserta->file_ktp) }}" target="_blank">Lihat
                                                    KTP</a>
                                            @endif
                                            <input type="file" class="form-control" id="file_ktp" name="file_ktp"
                                                accept=".jpg, .png" @if ($status != 'belum') disabled @endif>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="file_cv">Upload CV*</label>
                                            @if ($peserta->file_cv)
                                                <a href="{{ Storage::url($peserta->file_cv) }}" target="_blank">Lihat
                                                    CV</a>
                                            @endif
                                            <input type="file" class="form-control" id="file_cv" name="file_cv"
                                                accept=".pdf" @if ($status != 'belum') disabled @endif>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="file_transkrip">Upload Transkrip*</label>
                                            @if ($peserta->file_score_report)
                                                <a href="{{ Storage::url($peserta->file_score_report) }}"
                                                    target="_blank">Lihat Transkrip</a>
                                            @endif
                                            <input type="file" class="form-control" id="file_transkrip"
                                                name="file_transkrip" accept=".pdf"
                                                @if ($status != 'belum') disabled @endif>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="file_kegiatan_sosial">Upload Kegiatan Sosial*</label>
                                            @if ($peserta->file_kegiatan_sosial)
                                                @foreach (json_decode($peserta->file_kegiatan_sosial) as $file)
                                                    <a href="{{ Storage::url($file) }}" target="_blank">Lihat Kegiatan
                                                        Sosial</a><br>
                                                @endforeach
                                            @endif
                                            <input type="file" class="form-control" id="file_kegiatan_sosial"
                                                name="file_kegiatan_sosial[]" multiple
                                                @if ($status != 'belum') disabled @endif>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="file_penghargaan">Upload Penghargaan*</label>
                                            @if ($peserta->file_penghargaan)
                                                @foreach (json_decode($peserta->file_penghargaan) as $file)
                                                    <a href="{{ Storage::url($file) }}" target="_blank">Lihat
                                                        Penghargaan</a><br>
                                                @endforeach
                                            @endif
                                            <input type="file" class="form-control" id="file_penghargaan"
                                                name="file_penghargaan[]" multiple
                                                @if ($status != 'belum') disabled @endif>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="file_surat_rekomendasi">Upload Surat Rekomendasi (Jika Ada)</label>
                                            @if ($peserta->file_surat_rekomendasi)
                                                <a href="{{ Storage::url($peserta->file_surat_rekomendasi) }}"
                                                    target="_blank">Lihat Surat Rekomendasi</a>
                                            @endif
                                            <input type="file" class="form-control" id="file_surat_rekomendasi"
                                                name="file_surat_rekomendasi" accept=".pdf"
                                                @if ($status != 'belum') disabled @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </form>
            </div>
        </div>
        <!--/ Layout Demo -->
    @endsection

    @section('page-script')
        <!-- Include DataTables CSS and JS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#table_config').DataTable();
            });
        </script>
    @endsection
