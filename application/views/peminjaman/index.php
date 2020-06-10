<div id="content">

    <div class="container-fluid">
        <!-- Page Content -->
        <h3><?= $title; ?></h3>
        <hr>

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                Item : <?= $count ?>
            </div>
            <div class="card-body">

                <?= $this->session->flashdata('message'); ?>
                <div class="table-responsive">
                    <div id="example1_wrapper" class="dataTables_wrapper ">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Peminjam</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Tgl Pinjam</th>
                                    <th scope="col">Pengajuan Pengembalian</th>
                                    <th scope="col">Admin</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($pinjam as $data) { ?>
                                    <tr>
                                        <th scope="row" style="width:5%;"><?= $i; ?></th>

                                        <td><?= $data->id_user_pjm ?></td>
                                        <td><?= $data->kelas ?></td>
                                        <td><?= $data->kode ?></td>
                                        <td><?= $data->barcode ?></td>
                                        <td><?= $data->bar ?></td>
                                        <td><?= $data->tgl_pinjam ?></td>
                                        <td><?= $data->tgl_aju_kembali ?></td>
                                        <td><?= $data->id_admin ?></td>

                                        <td style="background-color: red; color:white;text-transform: capitalize;"><?= $data->status ?>
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