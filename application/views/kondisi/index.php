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
                    <!--<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKondisiModal"><i class="fas fa-plus"></i> Tambah Kondisi</a>-->
                    <div id="example1_wrapper" class="dataTables_wrapper ">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kondisi</th>
                                    <th scope="col">Stok Barang</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kondisi as $k) : ?>
                                    <tr>
                                        <th scope="row" style="width:5%;"><?= $i; ?></th>
                                        <td><?= $k['kondisi']; ?></td>
                                        <?php $idkondisi = $k['id'] ?>
                                        <td><?php
                                            $sql = "SELECT barang.merk FROM barang WHERE barang.id_kondisi = $idkondisi";
                                            $query = $this->db->query($sql);
                                            echo $query->num_rows();
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-small btn-primary" data-target="<?= $k['id'] ?>" href="<?= base_url('kondisi/indexkondisi/' . $k['id']); ?>"><i class="fas fa-info-circle"></i></a>
                                            <!-- <a class="btn btn-small btn-warning" data-target="<?= $k['id'] ?>" href="<?= base_url('kondisi/editkondisi/' . $k['id']); ?>"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-small btn-danger" href="<?= base_url('kondisi/hapuskondisi/' . $k['id']); ?>"><i class="fas fa-trash"></i></a> -->
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
    <!-- tambah kondisi -->
    <div class=" modal fade" id="newKondisiModal" tabindex="-1" role="dialog" aria-labelledby="newKondisiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newKondisiModalLabel">Tambah Kondisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('kondisi/process'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">

                            <input type="text" class="form-control" id="kondisi" name="kondisi" placeholder="Masukkan kondisi" required="required" autofocus="autofocus">
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