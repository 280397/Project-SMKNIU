<div id="content">

    <div class="container-fluid">
        <!-- Page Content -->
        <h3><?= $titl; ?></h3>
        <hr>
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">

                <?= $title; ?> <i class="fa fa-barcode"></i>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example1_wrapper" class="dataTables_wrapper ">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <?php
                            $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
                            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) . '" style="width:200px">';
                            ?>
                            <br>
                            <?= $row->barcode ?>
                            <br><br>
                            <a class="btn btn-small btn-default btn-sm" target="_blank" href="<?= base_url('barang/barcode_print/' . $row->id) ?>"><i class="fas fa-print"> Print PDF</i>
                            </a>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">

                <?= $title1; ?> <i class="fa fa-qrcode"></i>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example1_wrapper" class="dataTables_wrapper ">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <?php
                            $qrCode = new Endroid\QrCode\QrCode($row->barcode);
                            $qrCode->writeFile('assets/img/qr-code/inventory-' . $row->barcode . '-qrcode.png');
                            ?>
                            <img src="<?= base_url('assets/img/qr-code/inventory-' . $row->barcode . '-qrcode.png') ?>" style="width:200px">
                            <br>
                            <?= $row->barcode ?>
                            <br><br>
                            <a class="btn btn-small btn-default btn-sm" target="_blank" href="<?= base_url('barang/qrcode_print/' . $row->id) ?>"><i class="fas fa-print"> Print PDF</i>
                            </a>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>