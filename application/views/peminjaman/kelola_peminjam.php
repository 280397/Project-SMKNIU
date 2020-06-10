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
                    <a class="btn btn-primary mb-3 col-sm-2" href="<?= base_url('user_pjm/add'); ?>"><i class="fas fa-plus"></i> Tambah user
                    </a>
                    <div id="example1_wrapper" class="dataTables_wrapper ">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIS / NIP</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($row as $p) : ?>
                                <tr>
                                    <th scope="row" style="width:5%;"><?= $i; ?></th>
                                    <td><?= $p['name']; ?></td>
                                    <td><?= $p['nis']; ?></td>
                                    <td><?= $p['kelas']; ?></td>
                                    <td><?= $p['username']; ?></td>
                                    <td><?= $p['password']; ?></td>
                                    <td>

                                        <a class="btn btn-small btn-warning" data-target="<?= $p['id'] ?>" href="<?= base_url('user_pjm/edituser/' . $p['id']); ?>"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-small btn-danger" href="<?= base_url('user_pjm/hapususer/' . $p['id']); ?>"><i class="fas fa-trash"></i></a>
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