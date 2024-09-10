<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="text-muted">Tambah Data Alternatif</h6>
    </div>
    <div class="col">
        <div class="row">
            <?php if(session()->getFlashdata('errors')) : ?>
                <div class="mt-1 col-md-5">
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('errors') ?>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>

    <form action="/alternatif/simpan" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="card-body px-5 py-4 mb-4">

            <div class="row">
                <div class="form-group col-md-12 mt-2">
                    <label class="form-label">Nama Alternatif</label>
                    <input onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" type="text" name="alternatif" class="form-control <?= ($validation->hasError('alternatif')) ? 'is-invalid' : ''; ?>" placeholder="Masukan Alternatif" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('alternatif'); ?>
                    </div>
                </div>
                <div class="form-group col-md-12 mt-2">
                    <label class="form-label">Nomor NIK</label>
                    <input autocomplete="off" inputmode="numeric" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="16" name="nik" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" placeholder="Masukkan Nomor NIK" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('nik'); ?>
                    </div>
                </div>
                <div class="form-group col-md-12 mt-2 mb-3">
                    <label class="form-label">Upload KTP</label>
                    <input type="file" name="foto_ktp" class="form-control" placeholder="foto_ktp" />
                    <div class="row"><label class="text-danger">*Pastikan foto KTP sudah benar</label></div>
                    <div class="row"><label class="text-danger">*Upload foto KTP hanya berlaku 1 kali</label></div>
                </div>
            </div>
            
        <div class="card-footer text-right pt-2">
            <button name="submit" value="submit" type="submit" class="btn btn-success btn-sm"><i class="bi bi-save"></i> Simpan</button>
            <a href="<?= base_url('/alternatif') ?>" class="btn btn-info btn-sm"></span>
                <span class="text">Kembali</span>
            </a>
            <!-- <button type="reset" class="btn btn-info btn-sm"><i class="fa fa-sync-alt"></i> Reset</button> -->
        </div>
    </form>
</div>
<?= $this->endSection('content') ?>