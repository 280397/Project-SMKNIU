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
                                    <th scope="col">Peminjam</th>
                                    <th scope="col">Keperluan</th>

                                    <th scope="col">Nama Petugas</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <th scope="row" style="width:5%;"><?= $i; ?></th>
                                        <td><?= $data->a ?></td>
                                        <td><?= $data->keperluan ?></td>

                                        <td><?= $data->b ?></td>

                                        <td>
                                            <a class="btn btn-small btn-primary" data-target="<?= $data->id ?>" href="<?= base_url('barang/editbarang/' . $data->id) ?>"><i class="fas fa-edit"></i></a>
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