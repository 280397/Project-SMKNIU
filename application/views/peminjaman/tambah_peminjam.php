<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Add User</div>
        <div class="card-body">
            <form method="post" action="<?= base_url('user_pjm/add'); ?>">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-12">
                            <input type="text" id="name" name="name" value="<?= set_value('name'); ?>" class="form-control" placeholder="Full name" required>
                            <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-12">
                            <input type="text" id="nis" name="nis" value="<?= set_value('nis'); ?>" class="form-control" placeholder="NIS / NIP">
                            <?= form_error('nis', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-12">
                            <input type="text" id="kelas" name="kelas" value="<?= set_value('kelas'); ?>" class="form-control" placeholder="kelas">
                            <?= form_error('kelas', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-12">
                            <input type="text" id="username" name="username" value="<?= set_value('username'); ?>" class="form-control" placeholder="Username" required>
                            <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-12">
                            <input type="password" id="password1" name="password1" class="form-control" placeholder="Password" required>
                            <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </form>
            <div class="text-center">
            </div>
        </div>
    </div>
</div>