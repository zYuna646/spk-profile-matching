@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Fluid - Layouts')

@section('content')
    <!-- Layout Demo -->
    <div class="">
        <div class="card mb-4">
            <h5 class="card-header">Lihat Data</h5>
            <div class="card mt-4">
                <div class="card-body">
                    <form action="{{ route('peserta.berkas.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="basicInfo-tab" data-bs-toggle="tab"
                                    data-bs-target="#basicInfo" type="button" role="tab" aria-controls="basicInfo"
                                    aria-selected="true">Informasi Dasar</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="additionalInfo-tab" data-bs-toggle="tab"
                                    data-bs-target="#additionalInfo" type="button" role="tab"
                                    aria-controls="additionalInfo" aria-selected="false">Informasi Tambahan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents"
                                    type="button" role="tab" aria-controls="documents"
                                    aria-selected="false">Dokumen</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="profileTabsContent">
                            <!-- Tab Informasi Dasar -->
                            <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                                aria-labelledby="basicInfo-tab">
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Upload Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto"
                                        accept="image/*">
                                    @if ($peserta && $peserta->foto)
                                        <img id="fotoPreview" src="{{ asset('storage/fotos/' . $peserta->foto) }}"
                                            alt="Foto Preview"
                                            style="display: block; max-width: 200px; margin-top: 10px;" />
                                    @else
                                        <img id="fotoPreview" src="#" alt="Foto Preview"
                                            style="display: none; max-width: 200px; margin-top: 10px;" />
                                    @endif
                                    @error('foto')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="agama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="agama" name="agama"
                                        value="{{ old('agama', $peserta->agama ?? '') }}">
                                    @error('agama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="agama" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="agama" name="agama"
                                        value="{{ old('agama', $peserta->agama ?? '') }}">
                                    @error('agama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="agama" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="agama" name="agama"
                                        value="{{ old('agama', $peserta->agama ?? '') }}">
                                    @error('agama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jk" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jk" name="jk">
                                        <option value="L" {{ old('jk', $peserta->jk ?? '') == 'L' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="P"
                                            {{ old('jk', $peserta->jk ?? '') == 'P' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('jk')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                        value="{{ old('tgl_lahir', $peserta->tgl_lahir ?? '') }}">
                                    @error('tgl_lahir')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="agama" class="form-label">Agama</label>
                                    <input type="text" class="form-control" id="agama" name="agama"
                                        value="{{ old('agama', $peserta->agama ?? '') }}">
                                    @error('agama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="asal" class="form-label">Asal</label>
                                    <input type="text" class="form-control" id="asal" name="asal"
                                        value="{{ old('asal', $peserta->asal ?? '') }}">
                                    @error('asal')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <select class="form-select" id="provinsi" name="provinsi">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinsi as $prov)
                                            <option value="{{ $prov->id }}"
                                                {{ old('provinsi', $peserta->provinsi_id ?? '') == $prov->id ? 'selected' : '' }}>
                                                {{ $prov->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('provinsi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kabupaten" class="form-label">Kabupaten</label>
                                    <select class="form-select" id="kabupaten" name="kabupaten" disabled>
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                    @error('kabupaten')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="no_tlp" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="no_tlp" name="no_tlp"
                                        value="{{ old('no_tlp', $peserta->no_tlp ?? '') }}">
                                    @error('no_tlp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="sosial_media" class="form-label">Akun Media Sosial</label>
                                    <input type="text" class="form-control" id="sosial_media" name="sosial_media"
                                        value="{{ old('sosial_media', $peserta->sosial_media ?? '') }}">
                                    @error('sosial_media')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                        value="{{ old('pekerjaan', $peserta->pekerjaan ?? '') }}">
                                    @error('pekerjaan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="latar_belakang" class="form-label">Latar Belakang</label>
                                    <textarea class="form-control" id="latar_belakang" name="latar_belakang" rows="3">{{ old('latar_belakang', $peserta->latar_belakang ?? '') }}</textarea>
                                    @error('latar_belakang')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="isAnggota" name="isAnggota"
                                        {{ old('isAnggota', $peserta->isAnggota ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="isAnggota">Anggota Organisasi?</label>
                                </div>
                            </div>

                            <!-- Tab Informasi Tambahan -->
                            <div class="tab-pane fade" id="additionalInfo" role="tabpanel"
                                aria-labelledby="additionalInfo-tab">
                                <div id="organisasiSection"
                                    style="display: {{ old('isAnggota', $peserta->isAnggota ?? false) ? 'block' : 'none' }};">
                                    <div class="mb-3">
                                        <label for="name_organisasi" class="form-label">Nama Organisasi</label>
                                        <input type="text" class="form-control" id="name_organisasi"
                                            name="name_organisasi"
                                            value="{{ old('name_organisasi', $peserta->name_organisasi ?? '') }}">
                                        @error('name_organisasi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="desc_organisasi" class="form-label">Deskripsi Organisasi</label>
                                        <textarea class="form-control" id="desc_organisasi" name="desc_organisasi" rows="3">{{ old('desc_organisasi', $peserta->desc_organisasi ?? '') }}</textarea>
                                        @error('desc_organisasi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="desc_organisasi" class="form-label">Peran Organisasai</label>
                                        <textarea class="form-control" id="peran_organisasi" name="peran_organisasi" rows="3">{{ old('desc_organisasi', $peserta->desc_organisasi ?? '') }}</textarea>
                                        @error('peran_organisasi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="essay" class="form-label">Essay</label>
                                    <textarea class="form-control" id="essay" name="desc_essai" rows="3">{{ old('desc_essai', $peserta->desc_essai ?? '') }}</textarea>
                                    @error('desc_essai')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exchange_program"
                                        name="isPertukaran"
                                        {{ old('isPertukaran', $peserta->isPertukaran ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exchange_program">Program Pertukaran </label>
                                    @error('isPertukaran')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="motivasi" class="form-label">Motivasi</label>
                                    <textarea class="form-control" id="motivasi" name="motivasi_essai" rows="3">{{ old('motivasi_essai', $peserta->motivasi_essai ?? '') }}</textarea>
                                    @error('motivasi_essai')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tab Dokumen -->
                            <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                                <div class="mb-3">
                                    <label for="file_ktp" class="form-label">KTP</label>
                                    @if ($peserta && $peserta->file_ktp)
                                        <div>
                                            <a href="{{ asset('storage/documents/' . $peserta->file_ktp) }}"
                                                class="btn btn-sm btn-primary" target="_blank">Download KTP</a>
                                        </div>
                                    @else
                                        <input type="file" class="form-control" id="file_ktp" name="file_ktp">
                                        @error('file_ktp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="file_cv" class="form-label">CV</label>
                                    @if ($peserta && $peserta->file_cv)
                                        <div>
                                            <a href="{{ asset('storage/documents/' . $peserta->file_cv) }}"
                                                class="btn btn-sm btn-primary" target="_blank">Download CV</a>
                                        </div>
                                    @else
                                        <input type="file" class="form-control" id="file_cv" name="file_cv">
                                        @error('file_cv')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="file_ijazah" class="form-label">Ijazah</label>
                                    @if ($peserta && $peserta->file_ijazah)
                                        <div>
                                            <a href="{{ asset('storage/documents/' . $peserta->file_ijazah) }}"
                                                class="btn btn-sm btn-primary" target="_blank">Download Ijazah</a>
                                        </div>
                                    @else
                                        <input type="file" class="form-control" id="file_ijazah" name="file_ijazah">
                                        @error('file_ijazah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                                <!-- Handle multiple file uploads if needed -->
                                <div class="mb-3">
                                    <label for="file_kegiatan_sosial" class="form-label">File Kegiatan Sosial</label>
                                    @if ($peserta && $peserta->file_kegiatan_sosial)
                                        @foreach (json_decode($peserta->file_kegiatan_sosial) as $file)
                                            <div>
                                                <a href="{{ asset('storage/documents/' . $file) }}"
                                                    class="btn btn-sm btn-primary" target="_blank">Download File</a>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                                <div class="mb-3">
                                    <label for="file_score_report" class="form-label">Laporan Nilai</label>
                                    @if ($peserta && $peserta->file_score_report)
                                        <div>
                                            <a href="{{ asset('storage/documents/' . $peserta->file_score_report) }}"
                                                class="btn btn-sm btn-primary" target="_blank">Download Laporan Nilai</a>
                                        </div>
                                    @endif
                                </div>
                                <!-- Handle JSON file uploads if needed -->
                                <div class="mb-3">
                                    <label for="file_penghargaan" class="form-label">File Penghargaan</label>
                                    @if ($peserta && $peserta->file_penghargaan)
                                        @foreach (json_decode($peserta->file_penghargaan) as $file)
                                            <div>
                                                <a href="{{ asset('storage/documents/' . $file) }}"
                                                    class="btn btn-sm btn-primary" target="_blank">Download File</a>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                        </div>
                    </form>
                </div>
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
