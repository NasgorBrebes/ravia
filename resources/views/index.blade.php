<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rama & Oktavia Wedding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
</head>

<body>


    <nav class="navbar navbar-expand-md bg-transparent sticky-top mynavbar">
        <div class="container">
            <a class="navbar-brand" href="#">Ravia</a>
            <button class="navbar-toggler border-0" style="color: white;" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Ravia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link" href="#home">Home</a>
                        <a class="nav-link" href="#mempelai">Mempelai</a>
                        <a class="nav-link" href="#info">Info</a>
                        <a class="nav-link" href="#map">Maps</a>
                        <a class="nav-link" href="#story">Story</a>
                        <a class="nav-link" href="#gallery">Gallery</a>
                        <a class="nav-link" href="#gift-section">Gift</a>
                        @auth
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section id="home" class="home">
        <div class="container">
            <div class="image-home">
                <img src="{{asset('storage/'.$event->homeImage)}}" alt="Pasangan Pengantin">
            </div>
            <p class="quote">
                {{ $event->homeQuote ??    '' }}
                <strong>{{ $event->homeQuoteSource ?? '' }}</strong>
            </p>
        </div>
    </section>


    <section id="mempelai" class="mempelai">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div class="row align-items-center">
                    <!-- Mempelai Pria -->
                    <div class="col-md-6">
                        <div class="circle syachrul mx-auto">
                            @if($event->groomPhoto)
                                <img src="{{ asset('storage/' . $event->groomPhoto) }}" alt="Foto {{ $event->groomName }}">
                            @else
                                <div class="placeholder-content">
                                    <i>👤</i><br>
                                    Foto tidak tersedia
                                </div>
                            @endif
                        </div>
                        <h3>{{ $event->groomName }}</h3>
                        <p class="desc">
                            Putra dari pasangan:<br>
                            Bapak {{ $event->groomFather }}<br>
                            & Ibu {{ $event->groomMother }}<br>
                            {{ $event->groomAddress }}
                        </p>
                    </div>
                    <!-- Mempelai Wanita -->
                    <div class="col-md-6">
                        <div class="circle dhinda mx-auto">
                            @if($event->bridePhoto)
                                <img src="{{ asset('storage/' . $event->bridePhoto) }}" alt="Foto {{ $event->brideName }}">
                            @else
                                <div class="placeholder-content">
                                    <i>👤</i><br>
                                    Foto tidak tersedia
                                </div>
                            @endif
                        </div>
                        <h3>{{ $event->brideName }}</h3>
                        <p class="desc">
                            Putri dari pasangan:<br>
                            Bapak {{ $event->brideFather }}<br>
                            & Ibu {{ $event->brideMother }}<br>
                            {{ $event->brideAddress }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <section id="info" class="info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h2>{{$event->openingGreeting}}</h2>
                    <div>{{$event->welcomeMessage}}</div>
                    <p>Hari</p>
                    <p class="highlight" style="font-size: 25px;">{{ $event->eventDate ? \Carbon\Carbon::parse($event->eventDate)->locale('id')->translatedFormat('j F Y') : '' }}</p>
                    <p>Pukul</p>
                    <p class="highlight" style="font-size: 25px;">{{ $event->eventTime ? \Carbon\Carbon::parse($event->eventTime)->format('H:i') : '' }} s/d selesai</p>
                    <p>Bertempat di</p>
                    <p class="highlight" style="font-size: 25px;">{{ $event->eventLocation }}</p>
                    <p>{{ $event->homeQuoteSource }}</p>
                    <p>{{$event->closingGreeting}}</p>
                    <h2>WASSALAMUALAIKUM WARAHMATULLAH WABARAKATUH</h2>
                </div>
            </div>
        </div>
    </section>

<section id="map" class="map">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <h2>Lokasi Acara</h2>
                
                @if($event->mapEmbedUrl)
                    <div class="map-container" style="display: flex; justify-content: center; margin: 20px 0;">
                        <!-- Render embed code langsung tanpa iframe wrapper -->
                        {!! $event->mapEmbedUrl !!}
                    </div>
                    
                    <!-- Tombol View Map dengan URL dinamis -->
                    @if($event->mapUrl)
                        <a href="{{ $event->mapUrl }}" target="_blank" class="map-btn">View on Google Maps</a>
                    @else
                        <!-- Fallback jika tidak ada mapUrl terpisah -->
                        <a href="#" onclick="openMapFromEmbed()" class="map-btn">View on Google Maps</a>
                    @endif
                @else
                    <div class="no-map">
                        <p>Lokasi akan segera diumumkan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

    <section id="story" class="story">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-10 text-center">
                <span>Cara Kita Bertemu</span>
                <h2 style="font-size: 45px;">Our Story</h2>
                <p>Kisah kami berawal dari sebuah pertemuan sederhana yang perlahan tumbuh menjadi perjalanan cinta
                    yang penuh makna dan harapan.</p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <ul class="timeline">
                    @foreach($story as $index => $item)
                    <li class="{{ $index % 2 == 1 ? 'timeline-inverted' : '' }}">
                        <div class="timeline-image">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h3>{{ $item->title }}</h3>
                                <span>{{ $item->date->format('Y-m-d') }}</span>
                            </div>
                            <div class="timeline-body">
                                <p>{{ $item->description }}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

    <section id="gallery" class="gallery py-5">
        <div class="container">
            <!-- Header Section with Animation -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 col-md-10 col-12 text-center">
                    <div class="gallery-heading" data-aos="fade-up">
                        <span class="subtitle">Our Memory</span>
                        <h2 class="title">Galeri Foto</h2>
                        <div class="divider mx-auto"></div>
                        <p class="description">Momen-momen indah yang telah kami lalui bersama dalam perjalanan cinta
                            kami</p>
                    </div>
                </div>
            </div>

            <!-- Gallery Grid with Hover Effects -->
<div class="row g-4 justify-content-center gallery-container">
    @forelse($galleries as $gallery)
        <div class="col-lg-4 col-md-6 col-12 gallery-item" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 100 }}">
            <div class="gallery-card">
                <a href="{{ Storage::url($gallery->image_path) }}" data-toggle="lightbox" data-gallery="wedding-gallery">
                    <div class="gallery-image">
                        <img src="{{ Storage::url($gallery->image_path) }}" alt="{{ $gallery->alt_text ?? 'Moment Bahagia' }}" class="img-fluid">
                        <div class="overlay">
                            <div class="overlay-content">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @empty
        <!-- Tampilan default jika belum ada foto yang diupload -->
        <div class="col-lg-4 col-md-6 col-12 gallery-item" data-aos="zoom-in" data-aos-delay="100">
            <div class="gallery-card">
                <a href="img/gallery1.jpg" data-toggle="lightbox" data-gallery="wedding-gallery">
                    <div class="gallery-image">
                        <img src="img/t1.jpg" alt="Moment Bahagia 1" class="img-fluid">
                        <div class="overlay">
                            <div class="overlay-content">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 gallery-item" data-aos="zoom-in" data-aos-delay="200">
            <div class="gallery-card">
                <a href="img/gallery2.jpg" data-toggle="lightbox" data-gallery="wedding-gallery">
                    <div class="gallery-image">
                        <img src="img/t2.jpg" alt="Moment Bahagia 2" class="img-fluid">
                        <div class="overlay">
                            <div class="overlay-content">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 gallery-item" data-aos="zoom-in" data-aos-delay="300">
            <div class="gallery-card">
                <a href="img/gallery3.jpg" data-toggle="lightbox" data-gallery="wedding-gallery">
                    <div class="gallery-image">
                        <img src="img/t3.jpg" alt="Moment Bahagia 3" class="img-fluid">
                        <div class="overlay">
                            <div class="overlay-content">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endforelse
</div>

            <!-- Gift Section -->
            <section id="gift-section" class="gift-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <h2 class="section-title">Wedding Gift</h2>
                            <p class="mb-5">Kehadiran dan doa Anda adalah hadiah terindah bagi kami. Namun jika Anda
                                ingin
                                memberikan tanda kasih, kami menyediakan informasi di bawah ini:</p>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <!-- Bank 1 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="gift-card">
                                <div class="gift-header">
                                    <h5 class="mb-0">{{ $event->bankName1 }}</h5>
                                </div>
                                <div class="gift-body">
                                    <img src="{{asset('storage/'.$event->bankLogo1)}}" 
                                        alt="Logo {{ $event->bankLogo1 }}" 
                                        class="bank-logo"
                                        onerror="this.src='{{ asset('img/default-bank.jpg') }}'">
                                    <p class="mb-2" style="color: #F5C28D;">a.n {{ $event->accountName1 }}</p>
                                    <div class="account-number" id="bca-number">{{ $event->accountNumber1 }}</div>
                                    <button class="copy-btn"
                                        onclick="copyToClipboard('bca-number', 'bca-success', 'bca-failed')">
                                        <i class="fa fa-copy me-2"></i>Salin No. Rekening
                                    </button>
                                    <div class="copy-success" id="bca-success">
                                        <i class="fa fa-check-circle me-1"></i>Berhasil disalin!
                                    </div>
                                    <div class="copy-failed" id="bca-failed">
                                        <i class="fa fa-info-circle me-1"></i>Silakan salin manual: tekan lama dan
                                        pilih
                                        "Salin"
                                    </div>
                                    <!-- Hidden input for fallback -->
                                    <textarea class="clipboard-input" id="bca-input">8720374981</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Bank 2 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="gift-card">
                                <div class="gift-header">
                                    <h5 class="mb-0">{{ $event->bankName2 }}</h5>
                                </div>
                                <div class="gift-body">
                                    <img src="{{asset('storage/'.$event->bankLogo2)}}" 
                                        alt="Logo {{ $event->bankLogo2 }}" 
                                        class="bank-logo"
                                        onerror="this.src='{{ asset('img/default-bank.jpg') }}'">
                                    <p class="mb-2" style="color: #F5C28D;">a.n {{ $event->accountName2 }}</p>
                                    <div class="account-number" id="mandiri-number">{{$event->accountNumber2}}</div>
                                    <button class="copy-btn"
                                        onclick="copyToClipboard('mandiri-number', 'mandiri-success', 'mandiri-failed')">
                                        <i class="fa fa-copy me-2"></i>Salin No. Rekening
                                    </button>
                                    <div class="copy-success" id="mandiri-success">
                                        <i class="fa fa-check-circle me-1"></i>Berhasil disalin!
                                    </div>
                                    <div class="copy-failed" id="mandiri-failed">
                                        <i class="fa fa-info-circle me-1"></i>Silakan salin manual: tekan lama dan
                                        pilih
                                        "Salin"
                                    </div>
                                    <!-- Hidden input for fallback -->
                                    <textarea class="clipboard-input" id="mandiri-input">1290374650</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <p class="gift-message">Terima kasih atas doa dan restu yang diberikan untuk pernikahan
                                kami.</p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="audio-player">
                <button id="playPauseBtn">▶</button>
            </div>
            <audio id="bgMusic" loop>
                <source src="musik/Rachmaninov - Symphony No. 2 Op. 27 III. Adagio_ Adagio (LSO).mp3"
                    type="audio/mp3">
            </audio>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.5/dist/index.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
            </script>
            <script src="musik.js"></script>
            <script src="script.js"></script>
</body>

</html>
