<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="text-muted">Tambah Data User</h6>
        <a href="<?= base_url('/users') ?>" class="btn btn-secondary btn-sm"></span>
            <i class="bi bi-backspace"></i><span class="text"> Kembali</span>
        </a>
    </div>

    <form action="/users/simpan" method="post">
        <?= csrf_field() ?>
        <div class="card-body px-5 py-4 mb-4">
            <div class="row">
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Username</label>
                    <input autocomplete="off" type="text" name="username" value="<?= old('username') ?>" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" autofocus />
                    <div class="invalid-feedback">
                        <?php $validation->getError('username'); ?>
                    </div>
                </div>

                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Password</label>
                    <input autocomplete="off" type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('password'); ?>
                    </div>
                </div>

                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Ulangi Password</label>
                    <input autocomplete="off" type="password" name="confirm_password" class="form-control <?= ($validation->hasError('confirm_password')) ? 'is-invalid' : ''; ?>" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('confirm_password'); ?>
                    </div>
                </div>

                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Nama</label>
                    <input autocomplete="off" type="text" name="nama" value="<?= old('nama') ?>" class="form-control" required />
                </div>

                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">E-Mail</label>
                    <input autocomplete="off" type="email" name="email" value="<?= old('username') ?>" class="form-control" required />
                </div>

                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Level</label>
                    <select name="role" class="form-control" required>
                        <option value="">--Pilih--</option>
                        <option value="1">System Administrator</option>
                        <option value="2">Administrator</option>
                        <option value="3">User</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success btn-sm"><i class="bi bi-save"></i> Simpan</button>
            <button type="reset" class="btn btn-info btn-sm"><i class="bi bi-circle"></i> Reset</button>
        </div>
    </form>
</div>
<?= $this->endSection('content') ?>