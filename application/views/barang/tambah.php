<section id="content">

    <section class="container-fluid">
        <!-- Page Content -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $title; ?></h3>

                <hr>
            </div>
            <div class="box-body">
                <?php $this->view('message'); ?>
                <?= form_open_multipart('Barang/process') ?>
                <div class="form-group">
                    <label for="barcode">Barcode *</label>
                    <input type="hidden" name="id" value="<?= $row->id ?>">
                    <input type="text" class="form-control" id="barcode" name="barcode" value="<?= $row->barcode ?>" placeholder="Masukkan kode barang" required="required" autofocus="autofocus">
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama barang *</label>
                    <select name="nama_barang" id="nama_barang" class="form-control" required="required" autofocus="autofocus">
                        <option value="">--Pilih kategori--</option>
                        <?php foreach ($kategori->result() as $key => $data) { ?>
                            <option value="<?= $data->id ?>" <?= $data->id == $row->nama_barang ? "selected" : null ?>><?= $data->kategori ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="merk">Merek barang *</label>
                    <input type="text" class="form-control" id="merk" name="merk" value="<?= $row->merk ?>" placeholder="Masukkan merek barang">
                </div>
                <div class="form-group">
                    <label for="model">Model barang *</label>
                    <input type="text" class="form-control" id="model" name="model" value="<?= $row->model ?>" placeholder="Masukkan model barang" required="required" autofocus="autofocus">
                </div>
                <div class="form-group">
                    <label for="model">Tanggal masuk *</label>
                    <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= $row->tgl_masuk ?>" required="required" autofocus="autofocus">
                </div>
                <div class=" form-group">
                    <label for="id_kondisi">Kondisi barang *</label>
                    <select name="id_kondisi" id="id_kondisi" class="form-control" required="required" autofocus="autofocus">
                        <option value="">--Pilih kondisi--</option>
                        <?php foreach ($kondisi->result() as $key => $data) { ?>
                            <option value="<?= $data->id ?>" <?= $data->id == $row->id_kondisi ? "selected" : null ?>><?= $data->kondisi ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_lokasi">Lokasi barang *</label>
                    <select name="id_lokasi" id="id_lokasi" class="form-control" required="required" autofocus="autofocus">
                        <option value="">--Pilih lokasi--</option>
                        <?php foreach ($lokasi->result() as $key => $data) { ?>
                            <option value="<?= $data->id ?>" <?= $data->id == $row->id_lokasi ? "selected" : null ?>><?= $data->lokasi ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dtl_lokasi">Detail Lokasi barang *</label>
                    <textarea type="text" class="form-control" id="dtl_lokasi" name="dtl_lokasi" required="required" autofocus="autofocus"><?= $row->dtl_lokasi ?></textarea>
                </div>

                <div class="form-group">
                    <label for="sumber">Sumber barang *</label>
                    <input type="text" class="form-control" id="sumber" name="sumber" value="<?= $row->sumber ?>" placeholder="Masukkan sumber barang" required="required" autofocus="autofocus">
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar *</label>
                    <div class="form-group">

                        <?php if ($page == 'edit') {
                            if ($row->gambar != null) { ?>
                                <div style="margin-buttom:5px">
                                    <img src="<?= base_url('assets/img/barang/' . $row->gambar) ?>" style="width:300px" alt="">
                                </div>
                        <?php
                            }
                        } ?>
                        <div class="custom-file col-md-4">
                            <input type="file" class="custom-file-input" id="gambar" name="gambar">
                            <label for="gambar" class="custom-file-label">Choose file</label>
                            <small>* Biarkan kosong jika tidak <?= $page == 'edit' ? 'diganti' : 'ada' ?></small>
                        </div>
                    </div>
                </div>

                <div class="form-group">

                    <button name="<?= $page ?>" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </section>
</section>
<!-- /.container-fluid -->