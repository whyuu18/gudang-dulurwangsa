<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-header d-flex justify-content-between">
        <h6 class="text-muted">Data Users</h6>
        <a href="<?= base_url('/users/tambah') ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus-circle" aria-hidden="true"></i> Tambah</a>
    </div>
    <div class="card-body m-2">
        <?php if (session()->getFlashdata('pesan')) : ?>
            <?= session()->getFlashdata('pesan') ?>
        <?php endif ?>
        <div class="table-responsive">
            <table id="myTable" class="table table-striped">
                <thead align="center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($users as $row) : ?>
                        <tr align="center">
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td>
                                <?= $row['role'] == 1 ? "System Administrator" : ($row['role'] == 2 ? "Administrator" : "User") ; ?>
                            </td>
                            <td>
                                <form action="/users/edit/<?= $row['id_user'] ?>" method="get" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="GET">
                                    <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                </form>
                                <form action="/users/hapus/<?= $row['id_user'] ?>" method="post" class="d-inline">
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
<?= $this->endSection('content') ?>