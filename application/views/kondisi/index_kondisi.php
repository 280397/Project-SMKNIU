<div id="content">

    <div class="container-fluid">
        <!-- Page Content -->
        <h3><?= $title; ?></h3>
        <hr>
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                <?= $title; ?></div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <div class="table-responsive">

                    <div id="example1_wrapper" class="dataTables_wrapper ">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Merek</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">Kondisi</th>
                                    <th scope="col">Lokasi</th>
                                    <!-- <th scope="col">Sumber</th> -->
                                    <th scope="col">Gambar</th>
                                    <!-- <th scope="col">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($row as $data) { ?>
                                <tr>
                                    <th scope="row" style="width:5%;"><?= $i; ?></th>
                                    <td>
                                        <?= $data['barcode'] ?><br>
                                        <!-- <i class="btn btn-small btn-default" data-target="<?= $data['id'] ?>" href="<?= base_url('lokasi/barcode_qrcode/' . $data['id']) ?>">Generate <i class="fas fa-barcode"></i> <i class="fas fa-qrcode"></i></a> -->
                                    </td>

                                    <td><?= $data['kategori'] ?></td>
                                    <td><?= $data['merk'] ?></td>
                                    <td><?= $data['model'] ?></td>
                                    <td><?= $data['kondisi'] ?></td>
                                    <td><?= $data['lokasi'] ?></td>
                                    <!-- <td><?= $data['sumber'] ?></td> -->

                                    <td>
                                        <?php if ($data['gambar'] != null) { ?>
                                        <img src="<?= base_url('assets/img/barang/' . $data['gambar']) ?>" alt="" style="width:100px">
                                        <?php } ?>
                                    </td>
                                    <!-- <td>
                                        <a class="btn btn-small btn-primary" data-target="<?= $data['barcode'] ?>" href="<?= base_url('barang/editbarang/' . $data['id']) ?>"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-small btn-danger" href="<?= base_url('lokasi/hapusbarang/' . $data['barcode']) ?>" onclick="return confirm ('Yakin hapus?')"><i class="fas fa-trash"></i></a>
                                    </td> -->
                                </tr>
                                <?php $i++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer small text-muted">Updated <?= date('Y'); ?></div>
        </div>
    </div>