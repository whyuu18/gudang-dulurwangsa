<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-header d-flex justify-content-between">
        <h6 class="text-muted">Data Kriteria</h6>
        <a href="<?= base_url('/kriteria/tambah') ?>" class="btn btn-sm btn-primary <?= $_SESSION['role'] == 1 ? '' : ($_SESSION['role'] == 2 ? '' : 'd-none') ?>"><i class="bi bi-plus-circle" aria-hidden="true"></i> Tambah</a>
    </div>
    <div class="card-body m-2">
        <?php if (session()->getFlashdata('pesan')) : ?>
            <?= session()->getFlashdata('pesan') ?>
        <?php endif ?>
        <div class="table-responsive">
            <table id="myTable" class="table table-striped">
                <thead>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Kriteria</th>
                    <th>Type</th>
                    <th>Bobot</th>
                    <th>Cara Penilaian</th>
                    <th class="<?= $_SESSION['role'] == 1 ? '' : ($_SESSION['role'] == 2 ? '' : 'd-none') ?>">Aksi</th>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($kriteria as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['kode_kriteria'] ?></td>
                            <td><?= $row['kriteria'] ?></td>
                            <td><?= $row['type'] ?></td>
                            <td><?= $row['bobot'] ?></td>
                            <td><?= $row['ada_pilihan'] == 0 ? "Pilih Langsung" : "Input Sub Kriteria" ?></td>
                            <td>
                                <form action="/kriteria/edit/<?= $row['id_kriteria'] ?>" method="get" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="GET">
                                    <button type="submit" class="btn btn-sm btn-warning <?= $_SESSION['role'] == 1 ? '' : ($_SESSION['role'] == 2 ? '' : 'd-none') ?>"><i class="bi bi-pencil"></i></button>
                                </form>
                                <form action="/kriteria/hapus/<?= $row['id_kriteria'] ?>" method="post" class="d-inline">
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
<?= $this->endSection('content') ?>