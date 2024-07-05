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
            <h5 class="card-header">Tambah Data</h5>
            <div class="card-body">
                <form action="{{ route('pendaftaran.periode.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="John Doe" value="{{ old('name') }}" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="periode" class="form-label">Periode</label>
                        <input type="text" name="periode" class="form-control @error('periode') is-invalid @enderror"
                            id="periode" placeholder="Select Year" value="{{ old('periode') }}" />
                        @error('periode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!--/ Layout Demo -->
@endsection

@section('page-script')
    <!-- Include jQuery and jQuery UI CSS and JS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#periode').datepicker({
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'yy',
                onClose: function(dateText, inst) {
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).val(year);
                }
            });

            // Open the datepicker to year view only
            $("#periode").focus(function() {
                $(".ui-datepicker-month").hide();
                $(".ui-datepicker-calendar").hide();
            });
        });
    </script>
@endsection
