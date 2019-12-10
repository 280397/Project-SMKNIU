<div id="content">

    <div class="container-fluid">
        <!-- Page Content -->
        <div class="box">
            <div class="box-header">
                <h3><?= $title; ?></h3>
            </div>
            <hr>
        </div>

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                <?= $title; ?>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <div class="table-responsive">
                    <a href="<?= base_url('lokasi/add') ?>" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newLokasiModal" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>Tambah Lokasi</a>
                    <div id="example1_wrapper" class="dataTables_wrapper ">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Stok Barang</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($lokasi as $l) : ?>
                                <?php $idlokasi = $l['id'] ?>
                                <tr>
                                    <th scope="row" style="width:5%;"><?= $i; ?></th>
                                    <td><?= $l['lokasi'] ?></td>
                                    <td><?php
                                            $sql = "SELECT barang.merk FROM barang WHERE barang.id_lokasi = $idlokasi";
                                            $query = $this->db->query($sql);
                                            echo $query->num_rows();
                                            ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-small btn-primary" data-target="<?= $l['id'] ?>" href="<?= base_url('lokasi/indexlokasi/' . $l['id']); ?>"><i class="fas fa-info-circle"></i></a>
                                        <a class="btn btn-small btn-warning" data-target="<?= $l['id'] ?>" href="<?= base_url('lokasi/editlokasi/' . $l['id']); ?>"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-small btn-danger" href="<?= base_url('lokasi/hapuslokasi/' . $l['id']); ?>" onclick="return confirm ('Yakin hapus?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <!-- tambah lokasi -->
    <div class=" modal fade" id="newLokasiModal" tabindex="-1" role="dialog" aria-labelledby="newLokasiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newLokasiModalLabel">Tambah lokasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('lokasi/process'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi" required="required" autofocus="autofocus">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button name="<?= $page ?>" type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>