<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .avatar {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 2px solid #007bff;
        }
        .card-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 1rem;
        }
        .card-body p {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .btn-upload {
            background-color: #007bff;
            color: white;
            border: none;
            margin-top: 10px;
            border-radius: 20px;
            padding: 8px 20px;
        }
        .btn-upload:hover {
            background-color: #0056b3;
        }
        .badge-primary {
            background-color: #007bff;
        }
        .badge-warning {
            background-color: #ffc107;
        }
        .text-muted {
            color: #6c757d !important;
        }
        .btn-custom {
            width: 90%;
            display: block;
            margin: 10px auto;
            border-radius: 25px;
            padding: 10px 20px;
        }
        .btn-custom-outline {
            border-color: #007bff;
            color: #007bff;
        }
        .btn-custom-outline:hover {
            background-color: #007bff;
            color: white;
        }
        .list-unstyled li {
            font-size: 1rem;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        .list-unstyled a {
            color: #007bff;
        }
        .list-unstyled a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card">
        @php
            $user = Auth::user();
        @endphp
        <div class="card-body">
            <div class="row">
                <!-- Data Peserta -->
                <div class="col-md-4 text-center">
                    <!-- Avatar Placeholder -->
                    <div class="mb-3">
                        <img src="{{ $user->foto ?? 'https://avatar.iran.liara.run/public/80' }}" alt="Foto Peserta" class="img-fluid rounded-circle avatar">
                    </div>
                    <!-- Upload Photo Button -->
                    @if ($user->foto)
                    <p class="text-muted">Upload Foto Anda Terlebih dahulu</p>
                        
                    @endif
                </div>
                <!-- Informasi Peserta -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Informasi Peserta</h5>
                            <ul class="list-unstyled">
                                <li><strong>Nama Lengkap Peserta:</strong> <a href="#">{{ $user->nama_lengkap ?? 'John Doe' }}</a></li>
                                <li><strong>Email:</strong> <a href="mailto:{{ $user->email ?? 'Test@mail.com' }}">{{ $user->email ?? 'Test@mail.com' }}</a></li>
                                <li><strong>Status Lulus:</strong> <span class="badge badge-primary">{{$user->peserta->status}}</span></li>
                                <li><strong>Progress Berkas:</strong> <span class="badge badge-warning">{{$user->peserta->status_berkas}}</span></li>
                            </ul>
                            <!-- Lengkapi Berkas Button -->
                            <div class="mt-3">
                                <a href="{{ route('dashboard.upload') }}" class="btn btn-custom btn-custom-outline">{{$user->peserta->status_berkas != 'belum' ? 'Lihat Berkas' : 'Lengkapi Berkas'}}</a>
                            </div>
                            
                            <div class="mt-3">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-custom">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
