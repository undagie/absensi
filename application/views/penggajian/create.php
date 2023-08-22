<div class="row">
    <div class="col-12">
        <div class="card">
            <form action="<?= base_url('penggajian/store') ?>" method="post">
                <div class="card-header">
                    <h4 class="card-title">Tambah Penggajian</h4>
                </div>
                <div class="card-body border-top py-0 my-3">
                    <h4 class="text-muted my-3">Profil</h4>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="id_user">Nama Karyawan</label>
                                <select name="id_user" id="id_user" class="form-control">
                                    <option>-- Pilih Karyawan --</option>
                                    <?php foreach ($users as $user) : ?>
                                        <option value="<?= $user->id_user ?>"><?= $user->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="bulan">Bulan</label>
                                <input type="number" name="bulan" id="bulan" class="form-control" value="<?= date('m') + 1 ?>" min="1" max="12" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <input type="number" name="tahun" id="tahun" class="form-control" value="<?= date('Y') ?>" min="1900" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="honor_lembur">Honor Lembur</label>
                                <input type="number" name="honor_lembur" id="honor_lembur" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="gaji_pokok">Gaji Pokok</label>
                                <input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="bonus">Bonus</label>
                                <input type="number" name="bonus" id="bonus" class="form-control" value="0" placeholder="Masukan Bonus" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top py-0 my-3">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="potongan">Potongan</label>
                                <input type="number" name="potongan" id="potongan" class="form-control" value="0" placeholder="Masukan Potongan" required />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="total_gaji">Total Gaji</label>
                                <input type="text" name="total_gaji" id="total_gaji" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <a href="javascript:history.back()" class="btn btn-secondary pull-right"><i class="fa fa-arrow-left"></i> Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>