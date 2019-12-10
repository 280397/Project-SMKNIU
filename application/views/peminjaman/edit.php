<section id="content">

    <section class="container-fluid">
        <!-- Page Content -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $title; ?></h3>

                <hr>
            </div>
            <div class="box-body">
                <?php $this->view('message'); ?>
                <?= form_open_multipart('user_pjm/process') ?>
                <div class="form-group">
                    <label for="sumber">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $row->name; ?>" required="required" autofocus="autofocus">
                    <input type="hidden" value="<?= $row->id ?>" name="id">
                </div>
                <div class="form-group">
                    <label for="sumber">NIS</label>
                    <input type="text" class="form-control" id="nis" name="nis" value="<?= $row->nis; ?>" required="required" autofocus="autofocus">
                    <input type="hidden" value="<?= $row->id ?>" name="id">
                </div>
                <div class="form-group">
                    <label for="sumber">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $row->kelas; ?>" required="required" autofocus="autofocus">
                    <input type="hidden" value="<?= $row->id ?>" name="id">
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $row->username; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?= $row->password; ?>" required>
                </div>
                <div class="form-group">

                    <button name="<?= $page ?>" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </section>
</section>
<!-- /.container-fluid -->