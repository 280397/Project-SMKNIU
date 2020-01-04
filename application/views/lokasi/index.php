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
                    <a href="<?= base_url('Lokasi/add') ?>" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newLokasiModal" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>Tambah Lokasi</a>
                    <div id="example1_wrapper" class="dataTables_wrapper ">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Stok Barang</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php $i = 1; ?>
                                <?php foreach ($lokasi as $l) : ?>
                                    <tr>
                                        <th scope="row" style="width:5%;"><?= $i; ?></th>
                                        <td><?= $l['lokasi']; ?></td>
                                        <?php $idlokasi = $l['id'] ?>
                                        <td><?php
                                            $sql = "SELECT barang.merk FROM barang WHERE barang.id_lokasi = $idlokasi";
                                            $query = $this->db->query($sql);
                                            echo $query->num_rows();
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-small btn-primary" data-target="<?= $l['id'] ?>" href="<?= base_url('Lokasi/indexlokasi/' . $l['id']); ?>"><i class="fas fa-info-circle"></i></a>
                                            <a class="btn btn-small btn-warning" data-target="<?= $l['id'] ?>" href="<?= base_url('Lokasi/editlokasi/' . $l['id']); ?>"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-small btn-danger" href="<?= base_url('Lokasi/hapuslokasi/' . $l['id']); ?>" onclick="return confirm ('Yakin hapus?')"><i class="fas fa-trash"></i></a>
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
    <!-- tambah Lokasi -->
    <div class=" modal fade" id="newLokasiModal" tabindex="-1" role="dialog" aria-labelledby="newLokasiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newLokasiModalLabel">Tambah Lokasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Lokasi/process'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukkan lokasi" required="required" autofocus="autofocus">
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