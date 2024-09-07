<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="text-muted">Input Penilaian Untuk Alternatif <b><?= $idAlternatif['alternatif'] ?></b></h6>
        <a href="<?= base_url('/alternatif') ?>" class="btn btn-secondary btn-sm"></span>
            <span class="text">Kembali</span>
        </a>
    </div>
    <div class="row my-3">
        <div class="col md-5">
            <img src="<?= base_url('img/' . $idAlternatif['foto_ktp']) ?>" alt="" width="300" height="300" class="img-thumbnail">
        </div>
    </div>
    <form action="/penilaian/simpan/<?= $idAlternatif['id_alternatif'] ?>" method="post">
        <?= csrf_field() ?>
        <div class="card-body px-5 py-4 mb-2">
            <div class="row">
                <?php foreach ($subkriteriaData as $data) : ?>
                    <div class="form-group col-md-6 mt-2 mb-2">
                        <input type="hidden" name="idKriteria[]" value="<?= $data['kriteria']['id_kriteria'] ?>">
                        <label class="form-label"><?= $data['kriteria']['kriteria'] ?></label>
                        <?php if ($data['kriteria']['ada_pilihan'] == 1) { ?>
                            <select name="nilai[]" class="form-control" required>
                                <option value="#" disabled selected>-- pilih --</option>
                                <?php foreach ($data['subkriteria'] as $subItem) : ?>
                                    <option value="<?= $subItem['nilai'] ?>"><?= $subItem['sub_kriteria'] ?></option>
                                <?php endforeach ?>
                            </select>
                        <?php } else {  ?>
                            <input type="number" name="nilai[]" class="form-control" step="0.001" required autocomplete="off">
                        <?php } ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success btn-sm"><i class="bi bi-save2"></i> Simpan</button>
            <button type="reset" class="btn btn-info btn-sm"><i class="bi bi-sync-alt"></i> Reset</button>
        </div>
    </form>
</div>

<?= $this->endSection('content') ?>