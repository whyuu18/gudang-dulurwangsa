<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- cek apakah ada data alternatif -->
<?php if (!empty($hasil && $alternatif)) : ?>
        <div class="card mt-4 shadow-sm">
                <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark align-self-center"><i class="bi bi-table"></i> Data Hasil</h6>
                        <div>
                                <a class="btn btn-sm btn-primary align-self-center" href="/hasil/cetak"><i class="bi bi-printer"></i> Cetak</a>
                                <!-- <a class="btn btn-sm btn-danger align-self-center" href="/hasil/hapus" onclick="return confirm('Apakah yakin?')"><i class="bi bi-trash" aria-hidden="true"></i> Hapus</a> -->
                        </div>
                </div>
                <div class="card-body m-2">
                        <div class="table-responsive">
                                <table id="#" class="table table-striped">
                                        <thead align="center">
                                                <th>No</th>
                                                <th>Nama Alternatif</th>
                                                <th>Nomor NIK</th>
                                                <th>Nilai Preferensi</th>
                                        </thead>
                                        <tbody
                                                <?php 
                                                $no = 1;
                                                $i = 0;
                                                ?>
                                                <?php foreach ($hasil as $row) : ?>
                                                        <tr>
                                                                <td align="center"><?= $no++ ?></td>
                                                                <td width=30%><?= $row['alternatif'] ?></td>
                                                                <td align="center"><?= $alternatif[$i]['nik'] ?></td>
                                                                <td align="center"><?= $row['nilai'] ?></td>
                                                                <!-- <td class="fw-bold text-danger"><?php // $row['nilai'] <= 0.7 ? "Tidak Bagus" : "Bagus" 
                                                                                                        ?></td> -->
                                                        </tr>
                                                        <?php $i++; ?>
                                                <?php endforeach ?>
                                        </tbody>
                                </table>
                        </div>
                </div>
        </div>
        <!-- jika tidak ada data tampilkan pesan -->
<?php else : ?>
        <div class="alert alert-info mt-5" role="alert">
                Data tidak ada!
        </div>
<?php endif ?>

<?= $this->endSection('content') ?>