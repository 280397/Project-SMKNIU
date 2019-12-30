<div id="content">

    <div class="container-fluid">
        <!-- Page Content -->
        <h3><?= $title; ?></h3>
        <hr>

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                Stok barang : <?= $count ?>
            </div>
            <div class="card-body">

                <?= $this->session->flashdata('message'); ?>
                <div class="table-responsive">
                    <a class="btn btn-primary mb-3 col-sm-2" href="<?= base_url('barang/add'); ?>"><i class="fas fa-plus"></i> Tambah barang
                    </a>
                    <a class="btn btn-warning mb-3" target="_blank" href="<?= base_url('barang/printAll'); ?>"><i class="fas fa-print"></i> Print
                    </a>

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
                                    <th scope="col">Gambar</th>

                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <th scope="row" style="width:5%;"><?= $i; ?></th>
                                        <td>
                                            <?= $data->barcode ?><br>
                                            <a class="btn btn-small btn-default" data-target="<?= $data->id ?>" href="<?= base_url('barang/barcode_qrcode/' . $data->id) ?>">Generate <i class="fas fa-barcode"></i> <i class="fas fa-qrcode"></i></a>
                                        </td>
                                        <td><?= $data->nama_barang ?></td>
                                        <td><?= $data->merk ?></td>
                                        <td><?= $data->model ?></td>
                                        <td><?= $data->id_kondisi ?></td>
                                        <td><?= $data->id_lokasi ?></td>
                                        <td>
                                            <?php if ($data->gambar != null) { ?>
                                                <img src="<?= base_url('assets/img/barang/' . $data->gambar) ?>" alt="" style="width:100px">
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-small btn-success" data-target="<?= $data->id ?>" href="<?= base_url('barang/detail/' . $data->id) ?>"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-small btn-warning" data-target="<?= $data->id ?>" href="<?= base_url('barang/editbarang/' . $data->id) ?>"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-small btn-danger" href="<?= base_url('barang/hapusbarang/' . $data->id) ?>" onclick="return confirm ('Yakin hapus?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer small text-muted">Updated <?= date('Y-m-d H:i:s') ?></div>
        </div>
    </div>