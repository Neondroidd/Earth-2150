<?php
session_start();

// Logout logic
if (isset($_POST['logout'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: login.php");
    exit;
}

// Check if the user is not logged in, then redirect to the login page
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="./public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./public/main/style.css">
    <title>Earth 2150</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Bootstrap JS and Popper.js -->
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <!-- Your custom scripts -->
    <script src="./public/main/index.js"></script>
</head>


<body data-bs-theme="dark">
    <!-- Theme Changer START -->
    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button"
            aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <div class="icon"><i class="bi bi-circle-half"></i></div>
        </button>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
                    aria-pressed="false">
                    <i class="bi bi-sun-fill"></i> Light
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="dark"
                    aria-pressed="true">
                    <i class="bi bi-moon-stars-fill"></i> Dark
                </button>
            </li>
            <li>
                <button id="auto" type="button" class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="auto" aria-pressed="false">
                    <i class="bi bi-circle-half"></i> Auto
                </button>
            </li>
        </ul>
    </div>
    <!-- Theme Change END -->

    <div class="container col-xxl-12">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="./public/images/earth.png" alt="Logo" height="30" width="30"> <span class="fs-4">Earth
                        2150</span>
                </a>
            </div>
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="#" class="nav-link px-2">Home</a></li>
                <li><a href="#Teknologi" class="nav-link px-2">Teknologi</a></li>
                <li><a href="#luarAngkasa" class="nav-link px-2">Luar Angkasa</a></li>
            </ul>
            <div class="col-md-3 text-end">
                <?php if (isset($_SESSION["username"])) : ?>
                <!-- If session is active, show Logout button -->
                <form method="post" action="">
                    <button type="submit" class="btn btn-danger" name="logout">Logout</button>
                </form>
                <?php else : ?>
                <!-- If session is not active, show Login button -->
                <button type="button" class="btn btn-primary me-2"><a href="/login.php"
                        class="text-decoration-none text-light">Login</a></button>
                <?php endif; ?>
            </div>
        </header>
    </div>
    <!-- Navbar END -->

    <main>
        <div class="container col-xxl-12 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <video autoplay loop muted playsinline class="img-fluid rounded-3 shadow-sm" width="100%"
                        height="100%">
                        <source src="./public/videos/Earth.mp4" type="video/mp4">
                    </video>
                </div>
                <div class="col-lg-6">
                    <h1 id="Changer" class="display-5 fw-bold lh-1 mb-3">Bumi 2150</h1>
                    <p class="lead">Bumi transformasi melalui teknologi, keberlanjutan, dan kolaborasi global. Kota
                        ramah lingkungan, energi terbarukan, dan restorasi ekosistem. Koloni manusia di luar angkasa
                        pusat penelitian. Teknologi kesehatan tingkatkan harapan hidup. Kesadaran keberlanjutan dan
                        kerja sama global atasi tantangan. Masa depan 2150 keseimbangan teknologi dan pelestarian,
                        bentuk dunia lebih baik bagi generasi mendatang.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 "><a href="#Teknologi"
                                class="text-decoration-none text-light">Learn More</a></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- section 1 -->
        <hr id="Teknologi" class="border-top">
        <div id="" class="container col-xxl-14 px-4 py-5">
            <h1 class="display-5 fw-bold lh-1 mb-3"> Era Teknologi Canggih Menuju Bumi Berkelanjutan</h1>
            <p class="lead">Pada tahun 2150, Bumi menyaksikan kemajuan teknologi yang mencengangkan. Energinya sebagian
                besar didukung oleh sumber daya terbarukan, dengan penggunaan teknologi nuklir, surya, dan energi panas
                bumi yang menggantikan bahan bakar fosil. Keterhubungan digital mencapai tingkat luar biasa, dengan
                jaringan supercepat dan komputasi kuantum mempercepat inovasi di berbagai bidang. Teknologi nanoscale
                dan bioteknologi telah merevolusi sektor kesehatan, membawa pengobatan yang lebih efektif dan
                personalisasi. Penerbangan antariksa rutin, dengan koloni manusia di luar angkasa dan eksplorasi
                interplanet menjadi kenyataan. Kehidupan sehari-hari didukung oleh kecerdasan buatan yang canggih,
                ditingkatkan oleh teknologi augmented reality yang meresapi setiap aspek kehidupan manusia. Tahun 2150
                mencirikan era di mana inovasi teknologi telah membentuk dunia yang lebih efisien, berkelanjutan, dan
                terkoneksi.</p>
        </div>

        <!-- section 2 -->
        <div id="luarAngkasa" class="container col-xxl-14 px-4 py-5">
            <h1 class="display-5 fw-bold lh-1 mb-3">Pencapaian Luar Biasa Manusia di Luar Angkasa</h1>
            <p class="lead">Pada tahun 2150, manusia telah meraih kemajuan luar angkasa yang luar biasa. Stasiun luar
                angkasa telah menjadi pusat penelitian dan eksplorasi, menjadi pangkalan untuk misi antarplanet dan
                kolonisasi di luar angkasa. Penerbangan antariksa menjadi rutin, dengan transportasi antarplanet yang
                efisien dan ramah lingkungan. Koloni manusia di Bulan dan Mars telah berkembang, menciptakan hubungan
                yang erat antara Bumi dan permukiman manusia di luar angkasa. Teknologi hidroponik dan penggunaan sumber
                daya lokal di permukiman luar angkasa mendukung kemandirian ekonomi dan keberlanjutan. Era ini
                mencirikan pencapaian manusia dalam menjelajahi dan memanfaatkan luar angkasa untuk kepentingan ilmiah
                dan perkembangan manusia secara keseluruhan.</p>
        </div>
    </main>

    <div class="container">
        <footer class="row py-3 my-4 border-top">
            <div class="col-md-4">
                <!-- First column content -->
                <div class="d-flex align-items-center">
                    <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                        <img src="./public/images/earth.png" alt="Logo" height="30" width="30">
                    </a>
                    <span class="mb-3 mb-md-0 text-body-secondary">&copy;<span id="year"></span> <a
                            class="text-body-primary" href="https://www.instagram.com/heyy.orville/" target="_blank"
                            style="text-decoration: none;">Orville</a> | All Rights Reserved
                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Second column content -->
                <figure class="text-center">
                    <blockquote class="blockquote">
                        <p id="container-quotes">A well-known quote, contained in a blockquote element.</p>
                    </blockquote>
                    <figcaption id="author-quotes" class="blockquote-footer"> ND
                    </figcaption>
                </figure>
            </div>
            <div class="col-md-4">
                <!-- Third column content -->
                <ul class="text-end nav justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="text-body-secondary" href="https://wa.me/+6281341772610"
                            target="_blank"><i class="bi bi-whatsapp"></i></a></li>
                    <li class="ms-3"><a class="text-body-secondary" href="https://www.instagram.com/heyy.orville/"
                            target="_blank"><i class="bi bi-instagram"></i></a></li>
                    <li class="ms-3"><a class="text-body-secondary"
                            href="https://www.facebook.com/orvillegiovanni.sambono/" target="_blank"><i
                                class="bi bi-facebook"></i></a></li>
                </ul>
            </div>
        </footer>
    </div>

</body>

</html>