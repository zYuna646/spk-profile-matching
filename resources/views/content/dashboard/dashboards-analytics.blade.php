@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Dashboard</h5>
                            <p class="mb-4">Sistem Penilaian</p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="fw-semibold d-block mb-1">Peserta</span>
                            <h3 class="card-title mb-2">{{ $data['peserta'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <span>Penilai</span>
                            <h3 class="card-title text-nowrap mb-1">{{ $data['penilai'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Criteria -->
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                {{-- <div class="card-header">
                    <h5 class="card-title m-0">Kriteria Penilaian</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('update.kriteria') }}" method="POST">
                        @csrf
                        @foreach ($data[''] as $item)
                            <div class="form-group row align-items-center mb-4">
                                <label for="bobot_{{ $item->id }}"
                                    class="col-sm-6 col-form-label">{{ $item->name }}</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" id="bobot_{{ $item->id }}"
                                        name="bobot[{{ $item->id }}]" value="{{ $item->bobot }}" min="1"
                                        max="5" required>
                                </div>
                            </div>
                        @endforeach
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div> --}}
            </div>
        </div>

        <!--/ Total Criteria -->
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
            <div class="row">
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="d-block mb-1">Verifiactor</span>
                            <h3 class="card-title text-nowrap mb-2">{{ $data['verificator'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="fw-semibold d-block mb-1">Pimpinan</span>
                            <h3 class="card-title mb-2">{{ $data['pimpinan'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
