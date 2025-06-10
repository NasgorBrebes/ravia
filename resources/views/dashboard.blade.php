<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Undangan Pernikahan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md mb-6 max-w-lg ml-8">
            <strong class="font-bold">Terjadi Kesalahan!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid" id="dashboardPage">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar" id="sidebar"
                style="background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%); min-height: 100vh;">
                <div class="d-flex flex-column p-3 text-white h-100">
                    <a href="#"
                        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-4">Wedding Dashboard</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link active" onclick="showSection('dashboard')">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link" onclick="showSection('editHome')">
                                <i class="fas fa-edit"></i> Edit Home
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link" onclick="showSection('guests')">
                                <i class="fas fa-users"></i> Daftar Tamu
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link" onclick="showSection('editStory')">
                                <i class="fas fa-edit"></i> Edit Story
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link" onclick="showSection('editGallery')">
                                <i class="fas fa-edit"></i> Edit Gallery
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link" onclick="logout()">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Toggle Sidebar Button (Mobile) -->
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1030;">
                <button class="btn btn-primary rounded-circle shadow" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content" id="mainContent">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="d-flex align-items-center">
                        <img src="https://via.placeholder.com/40" alt="User Avatar"
                            class="user-avatar me-2 rounded-circle">
                        <div>
                            <h6 class="mb-0" id="userDisplayName">Admin</h6>
                            <small class="text-muted">Administrator</small>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Section -->
                <div id="dashboardSection">
                    <div class="row mb-4">
                        <div class="col-sm-6 col-xl-3 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 bg-primary p-3 rounded text-white me-3">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div>
                                            <h6 class="card-title text-muted mb-0">Total Tamu</h6>
                                            <h2 class="mt-2 mb-0">{{ $guestStats['total'] }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 bg-success p-3 rounded text-white me-3">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div>
                                            <h6 class="card-title text-muted mb-0">Konfirmasi Hadir</h6>
                                            <h2 class="mt-2 mb-0">{{ $guestStats['hadir'] }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 bg-danger p-3 rounded text-white me-3">
                                            <i class="fas fa-times-circle"></i>
                                        </div>
                                        <div>
                                            <h6 class="card-title text-muted mb-0">Tidak Hadir</h6>
                                            <h2 class="mt-2 mb-0">{{ $guestStats['tidak_hadir'] }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 bg-warning p-3 rounded text-white me-3">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div>
                                            <h6 class="card-title text-muted mb-0">Belum Konfirmasi</h6>
                                            <h2 class="mt-2 mb-0">{{ $guestStats['belum_konfirmasi'] }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
                                <button class="btn btn-sm btn-outline-primary" onclick="exportGuestList()">
                                    <i class="fas fa-download me-1"></i> Export
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th>Tanggal Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentGuests as $guest)
                                            <tr>
                                                <td>{{ $guest->guestName }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $guest->guestStatus == 'hadir' ? 'bg-success' : ($guest->guestStatus == 'tidak_hadir' ? 'bg-danger' : 'bg-warning') }}">
                                                        {{ ucfirst(str_replace('_', ' ', $guest->guestStatus)) }}
                                                    </span>
                                                </td>
                                                <td>{{ $guest->updated_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Home Section -->
                <div id="editHomeSection" class="d-none">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Edit Halaman Awal (Home)</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('event.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="homeImage" class="form-label">Gambar Pengantin</label>
                                    <input type="file" class="form-control" id="homeImage" name="homeImage">
                                    <small class="text-muted">Gambar saat ini: <code>img/home.JPG</code></small>
                                </div>
                                <div class="mb-3">
                                    <label for="homeQuote" class="form-label">Kutipan Ayat</label>
                                    <textarea class="form-control" id="homeQuote" rows="5"name="homeQuote"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="homeQuoteSource" class="form-label">Sumber Kutipan</label>
                                    <input type="text" class="form-control" id="homeQuoteSource"
                                        name="homeQuoteSource">
                                </div>

                                <hr class="my-4">
                                <h6 class="fw-bold mb-3">Mempelai Pria</h6>

                                <div class="mb-3">
                                    <label for="groomName" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="groomName" name="groomName" value="{{ old('groomName', $event->groomName ?? '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="groomFather" class="form-label">Nama Ayah</label>
                                    <input type="text" class="form-control" id="groomFather" name="groomFather" value="{{ old('groomFather', $event->groomFather ?? '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="groomMother" class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-control" id="groomMother" name="groomMother" value="{{ old('groomMother', $event->groomMother ?? '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="groomAddress" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="groomAddress" name="groomAddress" value="{{ old('groomAddress', $event->groomAddress ?? '') }}">
                                </div>


                                <hr class="my-4">
                                <h6 class="fw-bold mb-3">Mempelai Wanita</h6>

                                <div class="mb-3">
                                    <label for="brideName" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="brideName" name="brideName" value="{{ old('brideName', $event->brideName ?? '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="brideFather" class="form-label">Nama Ayah</label>
                                    <input type="text" class="form-control" id="brideFather" name="brideFather" value="{{ old('brideFather', $event->brideFather ?? '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="brideMother" class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-control" id="brideMother" name="brideMother" value="{{ old('brideMother', $event->brideMother ?? '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="brideAddress" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="brideAddress" name="brideAddress" value="{{ old('brideAddress', $event->brideAddress ?? '') }}">
                                </div>

                                <hr class="my-4">
                                <h6 class="fw-bold mb-3">Pengaturan Website</h6>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="webTitle" class="form-label">Judul Website</label>
                                        <input type="text" class="form-control" id="webTitle" name="webTitle" value="{{ old('webTitle', $event->webTitle ?? '') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="groomName" class="form-label">Nama Pengantin Pria</label>
                                        <input type="text" class="form-control" id="groomName" name="groomName" value="{{ old('groomName', $event->groomName ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="brideName" class="form-label">Nama Pengantin Wanita</label>
                                        <input type="text" class="form-control" id="brideName" name="brideName" value="{{ old('brideName', $event->brideName ?? '') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="groomFather" class="form-label">Ayah Pengantin Pria</label>
                                        <input type="text" class="form-control" id="groomFather" name="groomFather" value="{{ old('groomFather', $event->groomFather ?? '') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="groomMother" class="form-label">Ibu Pengantin Pria</label>
                                        <input type="text" class="form-control" id="groomMother" name="groomMother" value="{{ old('groomMother', $event->groomMother ?? '') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="brideFather" class="form-label">Ayah Pengantin Wanita</label>
                                        <input type="text" class="form-control" id="brideFather" name="brideFather" value="{{ old('brideFather', $event->brideFather ?? '') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="brideMother" class="form-label">Ibu Pengantin Wanita</label>
                                        <input type="text" class="form-control" id="brideMother" name="brideMother" value="{{ old('brideMother', $event->brideMother ?? '') }}">
                                    </div>
                                </div>


                                <hr class="my-4">
                                <h6 class="fw-bold mb-3">Media</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="bannerImage" class="form-label">Gambar Banner</label>
                                        <input class="form-control" type="file" id="bannerImage"
                                            name="bannerImage">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="musicBackground" class="form-label">Latar Musik</label>
                                        <input class="form-control" type="file" accept="audio/*"
                                            id="musicBackground" name="musicBackground">
                                    </div>
                                </div>

                                <hr class="my-4">
                                <h6 class="fw-bold mb-3">Lokasi dan Peta</h6>
                                <div class="mb-3">
                                    <label for="mapEmbedUrl" class="form-label">Embed URL Google Maps</label>
                                    <input type="text" class="form-control" id="mapEmbedUrl" name="mapEmbedUrl">
                                </div>

                                <hr class="my-4">
                                <h6 class="fw-bold mb-3">Informasi Acara</h6>
                                <div class="mb-3">
                                    <label for="openingGreeting" class="form-label">Salam Pembuka</label>
                                    <input type="text" class="form-control" id="openingGreeting"
                                        name="openingGreeting">
                                </div>
                                <div class="mb-3">
                                    <label for="welcomeMessage" class="form-label">Pesan Sambutan</label>
                                    <textarea class="form-control" id="welcomeMessage" rows="5" name="welcomeMessage"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="eventDate" class="form-label">Tanggal Acara</label>
                                    <input type="date" class="form-control" id="eventDate" name="eventDate">
                                </div>
                                <div class="mb-3">
                                    <label for="eventTime" class="form-label">Waktu Acara</label>
                                    <input type="time" class="form-control" id="eventTime" name="eventTime">
                                </div>
                                <div class="mb-3">
                                    <label for="eventLocation" class="form-label">Lokasi Acara</label>
                                    <input type="text" class="form-control" id="eventLocation"
                                        name="eventLocation">
                                </div>
                                <div class="mb-3">
                                    <label for="eventAddress" class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" id="eventAddress" rows="3" name="eventAddress"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="closingGreeting" class="form-label">Salam Penutup</label>
                                    <input type="text" class="form-control" id="closingGreeting"
                                        name="closingGreeting">
                                </div>

                                <hr class="my-4">
                                <h6 class="fw-bold mb-3">Rekening Bank</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="bankName1" class="form-label">Nama Bank</label>
                                        <input type="text" class="form-control" id="bankName1" name="bankName1">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="accountNumber1" class="form-label">Nomor Rekening</label>
                                        <input type="text" class="form-control" id="accountNumber1"
                                            name="accountNumber1">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="accountName1" class="form-label">Nama Pemilik</label>
                                        <input type="text" class="form-control" id="accountName1"
                                            name="accountName1">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="bankLogo1" class="form-label">Logo Bank</label>
                                        <input type="file" class="form-control" id="bankLogo1" name="bankLogo1">
                                    </div>
                                </div>

                                <hr class="my-4">
                                <h6 class="fw-bold mb-3">Rekening Bank 2</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="bankName2" class="form-label">Nama Bank</label>
                                        <input type="text" class="form-control" id="bankName2" name="bankName2">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="accountNumber2" class="form-label">Nomor Rekening</label>
                                        <input type="text" class="form-control" id="accountNumber2"
                                            name="accountNumber2">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="accountName2" class="form-label">Nama Pemilik</label>
                                        <input type="text" class="form-control" id="accountName2"
                                            name="accountName2">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="bankLogo2" class="form-label">Logo Bank</label>
                                        <input type="file" class="form-control" id="bankLogo2" name="bankLogo2">
                                    </div>
                                </div>

                                <hr class="my-4">
                                <h6 class="fw-bold mb-3">Alamat Pengiriman Hadiah</h6>
                                <div class="mb-3">
                                    <label for="giftAddress" class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" id="giftAddress" rows="4" name="giftAddress"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="recipientName" class="form-label">Nama Penerima</label>
                                    <input type="text" class="form-control" id="recipientName"
                                        name="recipientName">
                                </div>
                                <div class="mb-3">
                                    <label for="recipientPhone" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="recipientPhone"
                                        name="recipientPhone">
                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Mempelai Section, TINGGALIN AJA MALAS NGURUSNYA -->
                <div id="editMempelaiSection" class="d-none">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Edit Informasi Mempelai</h5>
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                </div>

                <!-- Guests Section -->
                <div id="guestsSection" class="d-none">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">
                            <h5 class="card-title mb-0 mb-2 mb-md-0">Daftar Tamu</h5>
                            <div>
                                <button class="btn btn-sm btn-outline-secondary me-1" onclick="exportGuestList()">
                                    <i class="fas fa-download me-1"></i> Export
                                </button>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#guestModal">
                                    <i class="fas fa-plus me-1"></i> Tambah Tamu
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($guests as $guest)
                                            <tr id="guest-row-{{ $guest->id }}">
                                                <td>{{ $guest->guestName }}</td>
                                                <td>{{ $guest->guestAddress }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $guest->guestStatus == 'hadir' ? 'bg-success' : ($guest->guestStatus == 'tidak_hadir' ? 'bg-danger' : 'bg-warning') }}">
                                                        {{ ucfirst(str_replace('_', ' ', $guest->guestStatus)) }}
                                                    </span>
                                                </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <button type="button"
                                                                class="btn btn-outline-primary btn-edit"
                                                                data-id="{{ $guest->id }}"
                                                                data-name="{{ $guest->guestName }}"
                                                                data-address="{{ $guest->guestAddress }}"
                                                                data-status="{{ $guest->guestStatus }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editGuestModal"
                                                                title="Edit Tamu">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-outline-danger"
                                                                onclick="deleteGuest({{ $guest->id }}, '{{ $guest->guestName }}')"
                                                                title="Hapus Tamu">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                           <a href="{{ url('/undangan/'.$guest->slug) }}">Bagikan</a>
                                                        </div>
                                                    </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Web Section TINGGALIN AJA MALAS NGURUSNYA-->
                <div id="editWebSection" class="d-none">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Edit Website Undangan</h5>
                        </div>
                        <div class="card-body">
                            <form>

                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Story Section -->
                <div id="editStorySection" class="d-none">
                    <div class="container my-5">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white">
                                <h5 class="card-title mb-0">Tambah Cerita Cinta</h5>
                            </div>
                            <div class="card-body">
                                {{-- Pertemuan Pertama --}}
                                <form method="POST" action="{{ route('stories.store') }}"
                                    enctype="multipart/form-data" class="mb-5">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="story1Date" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="story1Date" name="date">
                                    </div>
                                    <div class="mb-3">
                                        <label for="story1Title" class="form-label">Judul</label>
                                        <input type="text" class="form-control" id="story1Title" name="title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="story1Desc" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="story1Desc" name="description" rows="4"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="story1Image" class="form-label">Gambar</label>
                                        <input type="file" class="form-control" id="story1Image" name="image">
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> Simpan Cerita
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Map Section TINGGALIN AJA MALAS NGURUSNYA-->
                <div id="editMapSection" class="d-none">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Edit Lokasi Acara</h5>
                        </div>

                    </div>
                </div>

                <!-- Edit Info Section TINGGALIN AJA MALAS NGURUSNYA-->
                <div id="editInfoSection" class="d-none">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Edit Informasi Sambutan</h5>
                        </div>
                        <div class="card-body">
                            <form>

                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Gallery Section -->
                <div id="editGallerySection">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Edit Galeri Foto</h5>
                            <button class="btn btn-sm btn-primary" onclick="addGalleryImage()">
                                <i class="fas fa-plus me-1"></i> Tambah Foto
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row" id="galleryImages">
                                @forelse($galleries as $gallery)
                                    <div class="col-md-4 mb-3" id="gallery-{{ $gallery->id }}">
                                        <div class="card">
                                            <img src="{{ $gallery->image_url }}" class="card-img-top"
                                                alt="{{ $gallery->alt_text }}">
                                            <div class="card-body p-2">
                                                <button class="btn btn-sm btn-outline-danger w-100"
                                                    onclick="removeGalleryImage({{ $gallery->id }})">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-4" id="empty-gallery">
                                        <p class="text-muted">Belum ada foto dalam galeri</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for adding image -->
                <div class="modal fade" id="addImageModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Foto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form id="addImageForm" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="imageFile" class="form-label">Pilih Foto</label>
                                        <input type="file" class="form-control" id="imageFile" name="image"
                                            accept="image/*" required>
                                        <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="altText" class="form-label">Deskripsi (Opsional)</label>
                                        <input type="text" class="form-control" id="altText" name="alt_text"
                                            placeholder="Deskripsi gambar">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-upload me-1"></i> Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Gift Section -->
                <div id="editGiftSection" class="d-none">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Edit Hadiah & Amplop Digital</h5>
                        </div>
                        <div class="card-body">
                            <form>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Guest Modal -->
    <div class="modal fade" id="guestModal" tabindex="-1" aria-labelledby="guestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="guestModalLabel">Tambah Tamu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="guestForm" method="POST"action="{{ route('guest.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="guestName" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="guestName" required name="guestName">
                        </div>
                        <div class="mb-3">
                            <label for="guestAddress" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="guestAddress" required
                                name="guestAddress">
                        </div>
                        <div class="mb-3">
                            <label for="guestStatus" class="form-label">Status</label>
                            <select class="form-select" id="guestStatus" name="guestStatus">
                                <option value="belum_konfirmasi">Menunggu</option>
                                <option value="hadir">Hadir</option>
                                <option value="tidak_hadir">Tidak Hadir</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" onclick="saveGuest()">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Guest Modal -->
    <div class="modal fade" id="editGuestModal" tabindex="-1" aria-labelledby="editGuestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGuestModalLabel">Edit Tamu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Form yang action-nya akan di-set lewat JS -->
                <form id="editGuestForm" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="modal-body">
                        <input type="hidden" id="editGuestId" name="guest_id">

                        <div class="mb-3">
                            <label for="editGuestName" class="form-label">Nama Tamu</label>
                            <input type="text" class="form-control" id="editGuestName" name="guestName" required>
                        </div>

                        <div class="mb-3">
                            <label for="editGuestAddress" class="form-label">Alamat</label>
                            <textarea class="form-control" id="editGuestAddress" name="guestAddress" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="editGuestStatus" class="form-label">Status</label>
                            <select class="form-select" id="editGuestStatus" name="guestStatus" required>
                                <option value="">Pilih Status</option>
                                <option value="belum_konfirmasi">Belum Konfirmasi</option>
                                <option value="hadir">Hadir</option>
                                <option value="tidak_hadir">Tidak Hadir</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Debug Panel -->
    <div class="mt-4 p-3 bg-light rounded">
        <h5>Debug Information</h5>
        <div id="debugInfo"></div>
        <button class="btn btn-info btn-sm mt-2" onclick="testFormData()">Test Form Data</button>
        <button class="btn btn-success btn-sm mt-2" onclick="simulateSuccess()">Simulate Success</button>
        <button class="btn btn-danger btn-sm mt-2" onclick="simulateError()">Simulate Error</button>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Scripts -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <!--guestedit-->
    <script src="{{ asset('js/guestedit.js') }}"></script>
</body>

</html>
