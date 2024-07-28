@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Fluid - Layouts')

@section('content')
    <!-- Layout Demo -->
        <div class="card mb-4">
            <h5 class="card-header">Detail Data</h5>
            <div class="card-body">
                <table id="table_config" class="table table-bordered">
                    <thead>
                        <tr>
                            @foreach ($kriteria as $item)
                                <th colspan="{{ $item->subKriteria->count() }}" class="text-center">{{ $item->name }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($kriteria as $item)
                                @foreach ($item->subKriteria as $sub)
                                    <th>{{ $sub->name }}</th>
                                @endforeach
                            @endforeach

                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($kriteria as $item)
                                @foreach ($item->subKriteria as $sub)
                                    <td>{{$t_1[$item->id][$sub->id]}}</td>
                                @endforeach
                            @endforeach
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <table id="table_config" class="table table-bordered">
                    <thead>
                        <tr>
                            @foreach ($kriteria as $item)
                                <th colspan="{{ $item->subKriteria->count() }}" class="text-center">{{ $item->name }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($kriteria as $item)
                                @foreach ($item->subKriteria as $sub)
                                    <th>{{ $sub->name }}</th>
                                @endforeach
                            @endforeach

                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($kriteria as $item)
                                @foreach ($item->subKriteria as $sub)
                                    <td>{{$t_2[$item->id][$sub->id]}}</td>
                                @endforeach
                            @endforeach
                        </tr>

                    </tbody>
                    
                </table>
            </div>
            <div class="card-body">
                <table id="table_config" class="table table-bordered">
                    <thead>
                        <tr>
                            @foreach ($kriteria as $item)
                                <th colspan="{{ $item->subKriteria->count() }}" class="text-center">{{ $item->name }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($kriteria as $item)
                                @foreach ($item->subKriteria as $sub)
                                    <th>{{ $sub->name }}</th>
                                @endforeach
                            @endforeach

                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($kriteria as $item)
                                @foreach ($item->subKriteria as $sub)
                                    <td>{{$t_3[$item->id][$sub->id]}}</td>
                                @endforeach
                            @endforeach
                        </tr>

                    </tbody>
                    
                </table>
            </div>
            <div class="card-body">
                <table id="table_config" class="table table-bordered">
                    <thead>
                        <tr>
                            @foreach ($kriteria as $item)
                                <th colspan="{{ $item->subKriteria->count() }}" class="text-center">{{ $item->name }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($kriteria as $item)
                               <th>CF</th>
                               <th>SF</th>
                               <th>NT</th>

                            @endforeach

                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($kriteria as $item)
                                <td>{{$t_4[$item->id][0]}}</td>
                                <td>{{$t_4[$item->id][1]}}</td>
                                <td>{{$t_4[$item->id][2]}}</td>

                            @endforeach
                        </tr>

                    </tbody>
                    
                </table>
            </div>
            <div class="card-body">
                <table id="table_config" class="table table-bordered">
                    <thead>
                       
                        <tr>
                           <th>Nilai Total</th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                          <td>{{$hasil}}</td>
                        </tr>

                    </tbody>
                    
                </table>
            </div>
        </div>
    <!--/ Layout Demo -->
@endsection

@section('page-script')
    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table_config').DataTable();
        });
    </script>
@endsection
