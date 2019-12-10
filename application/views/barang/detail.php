<div id="content">

    <div class="container-fluid">
        <!-- Page Content -->
        <h1><?= $title; ?></h1>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group row">
                    <!-- <?php echo var_dump($row); ?> -->
                    <div class="col-sm-4">
                        <img src="<?= base_url('assets/img/barang/' . $row['gambar']) ?>" style="width:200px">

                        <hr>
                        <?php
                        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row['barcode'], $generator::TYPE_CODE_128)) . '" style="width:200px">';
                        ?>
                        <br>
                        <?= $row['barcode'] ?>
                        <br>
                        <a class="btn btn-small btn-default btn-sm" target="_blank" href="<?= base_url('barang/barcode_print/' . $row['id']) ?>"><i class="fas fa-print"> Print PDF</i>
                        </a>
                        <hr>
                        <?php
                        $qrCode = new Endroid\QrCode\QrCode($row['barcode']);
                        $qrCode->writeFile('assets/img/qr-code/inventory-' . $row['barcode'] . '-qrcode.png');
                        ?>
                        <img src="<?= base_url('assets/img/qr-code/inventory-' . $row['barcode'] . '-qrcode.png') ?>" style="width:200px">
                        <br>
                        <a class="btn btn-small btn-default btn-sm" target="_blank" href="<?= base_url('barang/qrcode_print/' . $row['id']) ?>"><i class="fas fa-print"> Print PDF</i>
                        </a>
                        <br>
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Nama Barang</label>
                            <div class="col-sm-9">
                                <label class="col-form-label">: <?= $row['nk']; ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Merek</label>
                            <div class="col-sm-9">
                                <label class="col-form-label">: <?= $row['merk']; ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Model</label>
                            <div class="col-sm-9">
                                <label class="col-form-label">: <?= $row['model']; ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Tanggal masuk</label>
                            <div class="col-sm-9">
                                <label class="col-form-label">: <?= $row['tgl_masuk']; ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Kondisi</label>
                            <div class="col-sm-9">
                                <label class="col-form-label">: <?= $row['k']; ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Lokasi</label>
                            <div class="col-sm-9">
                                <label class="col-form-label">: <?= $row['l']; ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Detail lokasi</label>
                            <div class="col-sm-9">
                                <label class="col-form-label">: <?= $row['dtl_lokasi']; ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Sumber barang</label>
                            <div class="col-sm-9">
                                <label class="col-form-label">: <?= $row['sumber']; ?></label>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- /.container-fluid -->