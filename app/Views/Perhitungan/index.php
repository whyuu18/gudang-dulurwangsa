<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- cek apakah ada data alternatif -->
<?php if (!empty($data && $alternatif)) : ?>
    <h5 class="mt-5">Perhitungan Metode SAW</h5>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <script>
            alert("<?= session()->getFlashdata('pesan'); ?>");
        </script>
    <?php endif; ?>
    <div class="card mt-3 shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <h6 class="text-muted"># Bobot Preferensi (W)</h6>
        </div>
        <div class="card-body m-2">
            <div class="table-responsive">
                <table class="table table-striped" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr align="center">
                            <?php foreach ($kriteria as $key) : ?>
                                <th><?= $key['kode_kriteria'] ?> (<?= $key['type'] ?>)</th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <?php foreach ($kriteria as $key) : ?>
                                <td>
                                    <?= $key['bobot']; ?>
                                </td>
                            <?php endforeach ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mt-3 shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <h6 class="text-muted"># Matriks Keputusan (X)</h6>
        </div>
        <div class="card-body m-2">
            <div class="table-responsive">
                <table class="table table-striped" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr align="center">
                            <th width="5%" rowspan="2">No</th>
                            <th width=30%>Alternatif</th>
                            <th width=20%>Nomor NIK</th>
                            <?php foreach ($kriteria as $key) : ?>
                                <th><?= $key['kode_kriteria'] ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $i = 0;
                        foreach ($data as $nama_alternatif => $nilaiKriteria) : ?>
                            <tr align="center">
                                <td><?= $no; ?></td>
                                <td align="left"><?= $nama_alternatif ?></td>
                                <td align="center"><?= $alternatif[$i]['nik'] ?></td>
                                <?php foreach ($kriteria as $key) : ?>
                                    <td><?= $nilaiKriteria[$key['id_kriteria']] ?? '-'; ?></td>
                                <?php endforeach ?>
                            </tr>
                        <?php $no++; ?>
                        <?php $i++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mt-3 shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <h6 class="text-muted"># Matriks Ternormalisasi (R)</h6>
        </div>
        <div class="card-body m-2">
            <div class="table-responsive">
                <table class="table table-striped" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr align="center">
                            <th width="5%" rowspan="2">No</th>
                            <th width=30%>Alternatif</th>
                            <th width=20%>Nomor NIK</th>
                            <?php foreach ($kriteria as $key) : ?>
                                <th><?= $key['kode_kriteria'] ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $i = 0; 
                        ?>
                        <?php foreach ($data as $nama_alternatif => $nilaiKriteria) : ?>
                            <tr align="center">
                                <td><?= $no; ?></td>
                                <td align="left"><?= $nama_alternatif ?></td>
                                <td align="center"><?= $alternatif[$i]['nik'] ?></td>
                                <?php foreach ($kriteria as $index => $key) : ?>
                                    <?php
                                    $nilai = array_key_exists($key['id_kriteria'], $nilaiKriteria) ? $nilaiKriteria[$key['id_kriteria']] : 0;
                                    if ($nilai !== 0) {
                                        // Asumsikan bahwa indeks $nilaiMax sesuai dengan urutan kriteria berdasarkan id_kriteria
                                        // Karena $nilaiMax diindeks mulai dari 0, kita gunakan $index yang juga dimulai dari 0 dalam loop kriteria
                                        if ($key['type'] == "Benefit") {
                                            $nilaiDiBagi = $nilai / $nilaiMax[$index];
                                        } else {
                                            $nilaiDiBagi = $nilaiMin[$index] / $nilai;
                                        }
                                    } else {
                                        $nilaiDiBagi = $nilai; // Jika tidak ada nilai, tetapkan 0 sebagai output
                                    }
                                    ?>
                                    <td><?= round($nilaiDiBagi, 3) ?></td>
                                <?php endforeach ?>
                            </tr>
                            <?php 
                            $no++;
                            $i++;
                            ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mt-3 shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <h6 class="text-muted"># Perhitungan/Nilai Preferensi (V)</h6>
        </div>
        <div class="card-body m-2">
            <div class="table-responsive">
                <table class="table table-striped" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr align="center">
                            <th width="2%" rowspan="2">No</th>
                            <th width=22%>Nama Alternatif</th>
                            <th width=17%>Nomor NIK</th>
                            <th width=50%>Perhitungan</th>
                            <th>Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <form id="formHasil" method="post" action="/perhitungan/simpan">
                        <?= csrf_field() ?>
                        <tbody>
                            <?php 
                            $no = 1;
                            $i = 0;
                            ?>
                            <?php foreach ($data_id as $id_alternatif => $nilaiKriteria) : ?>
                                <tr align="center">
                                    <td><?= $no; ?></td>
                                    <td align="left">
                                        <?php foreach ($alternatif as $a) {
                                            if ($a['id_alternatif'] == $id_alternatif) {
                                                echo $a['alternatif'];
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td align="center"><?= $alternatif[$i]['nik']?></td>
                                    <td align="left">
                                        SUM
                                        <?php $nilai_v = 0; ?>
                                        <?php foreach ($kriteria as $index => $key) : ?>
                                            <?php
                                            $nilai = array_key_exists($key['id_kriteria'], $nilaiKriteria) ? $nilaiKriteria[$key['id_kriteria']] : 0;
                                            if ($nilai !== 0) {
                                                // Asumsikan bahwa indeks $nilaiMax sesuai dengan urutan kriteria berdasarkan id_kriteria
                                                // Karena $nilaiMax diindeks mulai dari 0, kita gunakan $index yang juga dimulai dari 0 dalam loop kriteria
                                                if ($key['type'] == "Benefit") {
                                                    $nilaiDiBagi = $nilai / $nilaiMax[$index];
                                                } else {
                                                    $nilaiDiBagi = $nilaiMin[$index] / $nilai;
                                                }
                                            } else {
                                                $nilaiDiBagi = $nilai; // Jika tidak ada nilai, tetapkan '-' sebagai output
                                            }
                                            $perkalianBobot = $key['bobot'] * $nilaiDiBagi;
                                            $nilai_v += $perkalianBobot;
                                            echo "(" . $key['bobot'] . " x " . round($nilaiDiBagi, 3) . ") ";
                                            ?>
                                        <?php endforeach ?>
                                    </td>
                                    <td><?= round($nilai_v, 3) ?></td>
                                </tr>
                                <input type="hidden" name="alternatif[]" value="<?= $id_alternatif ?>">
                                <input type="hidden" name="nilai[]" value="<?= $nilai_v ?>">
                                <?php 
                                $no++;
                                $i++;
                                ?>
                            <?php endforeach ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <button class="btn btn-primary mt-3 <?= $_SESSION['role'] == 1 ? '' : 'd-none' ?>" type="submit">Simpan Hasil Perhitungan</button>
    </form>

    <!-- jika tidak ada data tampilkan pesan -->
<?php else : ?>
    <?php if ($bulan != null && $tahun != null) : ?>
        <div class="alert alert-info mt-5" role="alert">
            Data yang dicari tidak ada, silahkan pilih periode bulan dan tahun yang lain!
        </div>
    <?php else : ?>
        <div class="alert alert-info mt-5" role="alert">
            Silakan pilih bulan dan tahun terlebih dahulu untuk menampilkan data!
        </div>
    <?php endif ?>
<?php endif ?>

<?= $this->endSection('content') ?>