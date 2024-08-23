<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- table data subkriteria -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <?= session()->getFlashdata('pesan') ?>
<?php endif ?>
<?php if ($subkriteriaData[0]['kriteria']['ada_pilihan'] != '0') : ?>
    <?php foreach ($subkriteriaData as $data) : ?>
        <div class="card mt-3 shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <h6 class="text-muted">Data Subkriteria untuk Kriteria "<b><?= ucwords($data['kriteria']['kriteria']) ?></b>"</h6>
                <form action="/sub-kriteria/tambah/<?= $data['kriteria']['id_kriteria'] ?>" method="get" class="d-inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="GET">
                    <button type="submit" class="btn btn-sm btn-primary <?= $_SESSION['role'] == 1 ? '' : ($_SESSION['role'] == 2 ? '' : 'd-none') ?>"><i class="bi bi-plus-circle" aria-hidden="true"></i> Tambah</button>
                </form>
            </div>

            <div class="card-body m-2">
                <div class="table-responsive">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th>No</th>
                                    <th>Nama Sub Kriteria</th>
                                    <th>Nilai</th>
                                    <th class="<?= $_SESSION['role'] == 1 ? '' : ($_SESSION['role'] == 2 ? '' : 'd-none') ?>">Aksi</th>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data['subkriteria'] as $subkriteriaItem) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $subkriteriaItem['sub_kriteria'] ?></td>
                                            <td><?= $subkriteriaItem['nilai'] ?></td>
                                            <td>
                                                <form action="/sub-kriteria/edit/<?= $subkriteriaItem['id_sub_kriteria'] ?>" method="get" class="d-inline">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="id_kriteria" value="<?= $subkriteriaItem['id_kriteria'] ?>">
                                                    <input type="hidden" name="_method" value="GET">
                                                    <button type="submit" class="btn btn-sm btn-warning <?= $_SESSION['role'] == 1 ? '' : ($_SESSION['role'] == 2 ? '' : 'd-none') ?>"><i class="bi bi-pencil"></i></button>
                                                </form>
                                                <form action="/sub-kriteria/hapus/<?= $subkriteriaItem['id_sub_kriteria'] ?>" method="post" class="d-inline">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-sm btn-danger <?= $_SESSION['role'] == 1 ? '' : ($_SESSION['role'] == 2 ? '' : 'd-none') ?>" onclick="return confirm('Apakah yakin?')"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php else : ?>
    <div class="alert alert-info mt-5" role="alert">
        Untuk Menampilkan input subkriteria, pilih cara penilaian dengan "<b>Pilih Sub Kriteria</b>" pada form Kriteria!
    </div>
<?php endif ?>

<?= $this->endSection('content') ?>