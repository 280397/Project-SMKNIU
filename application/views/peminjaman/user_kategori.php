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
                    <a href="<?= base_url('user_kategori/add') ?>" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKategoriModal" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>Tambah kategori</a>
                    <div id="example1_wrapper" class="dataTables_wrapper ">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Stok Barang</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php $i = 1; ?>
                                <?php foreach ($kategori as $l) : ?>
                                <tr>
                                    <th scope="row" style="width:5%;"><?= $i; ?></th>
                                    <td><?= $l['kategori']; ?></td>
                                    <?php $idkategori = $l['id'] ?>
                                    <td><?php
                                            $sql = "SELECT barang.merk FROM barang WHERE barang.nama_barang = $idkategori";
                                            $query = $this->db->query($sql);
                                            echo $query->num_rows();
                                            ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-small btn-primary" data-target="<?= $l['id'] ?>" href="<?= base_url('kategori/indexkategori/' . $l['id']); ?>"><i class="fas fa-info-circle"></i></a>
                                        <a class="btn btn-small btn-warning" data-target="<?= $l['id'] ?>" href="<?= base_url('kategori/editkategori/' . $l['id']); ?>"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-small btn-danger" href="<?= base_url('kategori/hapuskategori/' . $l['id']); ?>" onclick="return confirm ('Yakin hapus?')"><i class="fas fa-trash"></i></a>
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
    <!-- tambah kategori -->
    <div class=" modal fade" id="newKategoriModal" tabindex="-1" role="dialog" aria-labelledby="newKategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newKategoriModalLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user_kategori/process'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan kategori" required="required" autofocus="autofocus">
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