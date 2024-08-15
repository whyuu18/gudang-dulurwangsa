<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- notifikasi pesan -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <?= session()->getFlashdata('pesan') ?>
<?php endif ?>
<!-- cek apakah ada data alternatif -->
<?php if (!empty($alternatif)) : ?>
    <div class="card mt-4 shadow-sm">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-dark"><i class="bi bi-table"></i> Data Alternatif</h6>
            <a href="<?= base_url('/alternatif/tambah') ?>" class="btn btn-sm btn-primary <?= $_SESSION['role'] == 1 ? '' : 'd-none' ?>">
                <i class="bi bi-plus-circle"></i> Tambah
            </a>
        </div>
        <div class="card-body m-2">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        <th class="<?= $_SESSION['role'] == 1 ? '' : 'd-none' ?>">Aksi</th>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($alternatif as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['alternatif'] ?></td>
                                <td class="<?= $_SESSION['role'] == 1 ? '' : 'd-none' ?>">
                                    <form action="/alternatif/edit/<?= $row['id_alternatif'] ?>" method="get" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="GET">
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                    </form>
                                    <form action="/alternatif/hapus/<?= $row['id_alternatif'] ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin?')"><i class="bi bi-trash"></i></button>
                                    </form>
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