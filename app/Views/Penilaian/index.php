<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">

    <!-- notifikasi pesan -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <?= session()->getFlashdata('pesan') ?>
    <?php endif ?>

    <!-- cek apakah ada data alternatif -->
    <?php if (!empty($alternatif)) : ?>
        <div class="card mt-4 shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <h5>Daftar Data Penilaian</h5>
                <!-- <a href="#tambah-kriteria" class="btn btn-sm btn-primary">Tambah Kriteria</a> -->
            </div>
            <div class="card-body m-2">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                            <th>No</th>
                            <!-- <th>Bulan</th>
                        <th>Tahun</th> -->
                            <th>Nama Alternatif</th>
                            <th>Nomor NIK</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            <?php foreach ($alternatif as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['alternatif'] ?></td>
                                    <td><?= $row['nik'] ?></td>
                                    <td>
                                        <?php if (!empty(($row['isPenilaianExists']))) : ?>
                                            <!-- Tombol Edit -->
                                            <form action="/penilaian/edit/<?= $row['id_alternatif'] ?>" method="get" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="GET">
                                                <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                            </form>
                                        <?php else : ?>
                                            <!-- Tombol Input -->
                                            <form action="/penilaian/tambah/<?= $row['id_alternatif'] ?>" method="get" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="GET">
                                                <button type="submit" class="btn btn-sm btn-primary">Input</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- jika tidak ada data tampilkan pesan -->
    <?php else : ?>
        <div class="alert alert-info mt-5" role="alert">
            Data tidak ada atau Silakan pilih bulan dan tahun terlebih dahulu untuk menampilkan data!
        </div>
    <?php endif ?>
    <?= $this->endSection('content') ?>