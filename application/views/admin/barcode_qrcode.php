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
                            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->id_admin, $generator::TYPE_CODE_128)) . '" style="width:200px">';
                            ?>
                            <br>
                            <?= $row->id_admin ?>
                            <br><br>
                            <a class="btn btn-small btn-default btn-sm" target="_blank" href="<?= base_url('Admin/barcode_print/' . $row->id) ?>"><i class="fas fa-print"> Print PDF</i>
                            </a>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>