<div id="content-wrapper">

    <div class="container-fluid">
        <!-- Page Content -->
        <h1><?= $title; ?></h1>
        <hr>
        <div class="row">
            <div class="col-lg-8">

                <?= form_open_multipart('user/edit'); ?>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Full name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Picture</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label for="image" class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>

                </form>


            </div>
        </div>
    </div>
    <!-- /.container-fluid -->