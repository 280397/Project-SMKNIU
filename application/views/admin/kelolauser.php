<div id="content">

    <div class="container-fluid">
        <!-- Page Content -->
        <h3><?= $title; ?></h3>
        <hr>


        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                <?= $title; ?></div>
            <div class="card-body">
                <?= $this->session->flashdata('messageuser'); ?>
                <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <a class="btn btn-primary mb-3" href="<?= base_url('admin/adduser'); ?>"><i class="fas fa-plus"></i> Tambah Admin</a>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Role</th>
                                <th scope="col">Active</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($row->result() as $key => $data) { ?>
                            <tr>
                                <th scope="row" style="width:5%;"><?= $i; ?></th>
                                <td><?= $data->name ?></td>
                                <td><?= $data->username ?></td>
                                <td><?= $data->role ?></td>
                                <td><?= $data->active ?></td>
                                <td>
                                    <a class="btn btn-small btn-primary" data-target="<?= $data->id ?>" href="<?= base_url('admin/edit/' . $data->id) ?>"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-small btn-danger" href="<?= base_url('admin/hapususer/' . $data->id) ?>" onclick="return confirm ('Yakin hapus?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>



        <!-- Edit user -->
        <?php
        $get_user = $this->db->get('user')->result_array();
        foreach ($get_user as $data) : ?>
        <div class=" modal fade" id="newEditUserModal<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="newEditUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newEditUserModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('admin/edituser'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="sumber">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $data['name']; ?>" required="required" autofocus="autofocus" readonly>
                                <input type="hidden" value="<?= $data['id'] ?>" name="id">
                            </div>
                            <div class="form-group">
                                <label for="sumber">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $data['username']; ?>" required="required" autofocus="autofocus" readonly>
                                <input type="hidden" value="<?= $data['id'] ?>" name="id">
                            </div>
                            <div class="form-group">
                                <label for="role_id">Role</label>
                                <select name="role_id" id="role_id" class="form-control" required="required" autofocus="autofocus">
                                    <?php foreach ($role as $r) : ?>
                                    <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" value="<?= $data['id'] ?>" name="id">
                            </div>
                            <div class="form-group">
                                <label for="sumber">Aktif</label>
                                <select name="is_active" id="is_active" class="form-control" required="required" autofocus="autofocus">
                                    <?php foreach ($active as $a) : ?>
                                    <option value="<?= $a['id']; ?>"><?= $a['is_active']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- hapus Modal-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to delete?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="<?= base_url('admin/hapususer/' . $n['id']); ?>">Delete</a>
                    </div>
                </div>
            </div>
        </div>