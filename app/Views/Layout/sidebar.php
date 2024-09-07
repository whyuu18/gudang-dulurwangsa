<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Dashboard</li>

        <li class="nav-item">
            <a class="nav-link <?= $title == 'Dashboard' ? 'active' : 'collapsed' ?>" href=" /">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading mt-4 <?= $_SESSION['role'] == 1 || 2 || 3 ? '' : 'd-none' ?>">SPK</li>

        <!-- menu sidebar -->
        <li class="nav-item <?= $_SESSION['role'] == 1 || 2 || 3 ? '' : 'd-none' ?>">
            <a class="nav-link collapsed" data-bs-target="#kriteria-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Kriteria</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <?php ($title == "Data Kriteria" || $title == "Data Sub Kriteria") ? $show = "show" : $show = ""; ?>
            <ul id="kriteria-nav" class="nav-content collapse <?= $show ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/kriteria" class="<?= $title == 'Data Kriteria' ? 'active' : 'collapsed' ?>">
                        <i class="bi bi-circle"></i><span>Kriteria</span>
                    </a>
                </li>

                <li>
                    <a href="/sub-kriteria" class="<?= $title == 'Data Sub Kriteria' ? 'active' : 'collapsed' ?>">
                        <i class="bi bi-circle"></i><span>Sub Kriteria</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link <?= $title == 'Data Alternatif' ? 'active' : 'collapsed' ?>" href=" /alternatif">
                <i class="bi bi-person-bounding-box"></i>
                <span>Alternatif</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#alternatif-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>SPK</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <?php ($title == "Edit Penilaian" || $title == "Penilaian" || $title == "Perhitungan" || $title == "Data Hasil") ? $show = "show" : $show = ""; ?>
            <ul id="alternatif-nav" class="nav-content collapse <?= $show ?>" data-bs-parent="#sidebar-nav">
                <!-- <li class="<?= $_SESSION['role'] == 1 ? '' : ($_SESSION['role'] == 2 ? '' : 'd-none') ?>">
                    <a href="/penilaian" class="<?= $title == 'Penilaian' ? 'active' : 'collapsed' ?>">
                        <i class="bi bi-circle"></i><span>Penilaian</span>
                    </a>
                </li> -->
                <li>
                    <a href="/perhitungan" class="<?= $title == 'Perhitungan' ? 'active' : 'collapsed' ?>">
                        <i class="bi bi-circle"></i><span>Perhitungan</span>
                    </a>
                </li>
                <li>
                    <a href="/hasil" class="<?= $title == 'Data Hasil' ? 'active' : 'collapsed' ?>">
                        <i class="bi bi-circle"></i><span>Hasil</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-heading mt-4">User</li>
        <li class="nav-item <?= $_SESSION['role'] == 1 ? '' : 'd-none' ?>">
            <a class="nav-link <?= $title == 'Data Users' ? 'active' : 'collapsed' ?>" href=" /users">
                <i class="bi bi-person-plus-fill"></i>
                <span>User</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link <?= $title == 'Profile User' ? 'active' : 'collapsed' ?>" href=" /profile-user">
                <i class="bi bi-person-circle"></i>
                <span>Profile User</span>
            </a>
        </li><!-- End Contact Page Nav -->
    </ul>

</aside><!-- End Sidebar-->