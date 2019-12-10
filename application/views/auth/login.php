<div class="container">





    <div class="row">
        <div class="col-lg-8">
            <div class="row-fluid mt-5">
                <img src="<?= base_url('assets/img/inventory/sclogo.png') ?>" alt="">

            </div>

            <h4>
                <p class="text-white mt-5">SELAMAT DATANG DI : <br>
                    SISTEM INVENTARIS SMKN IHYA' ULUMUDIN <br>
                    SINGOJURUH

                </p>
            </h4>
        </div>
        <div class="col-lg-4">


            <div class="card card-login mx-auto mt-5">
                <div class="card-header text-center">
                    <h3><?= $title; ?></h3>
                </div>
                <div class="card-body">

                    <?= $this->session->flashdata('message'); ?>

                    <form method="post" action="<?= base_url('auth'); ?>">
                        <div class="form-group">
                            <input type="text" id="username" name="username" value="<?= set_value('username'); ?>" class="form-control" placeholder="Username">
                            <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                            <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <button class="btn btn-dark btn-block" href="index.html">Login</button>
                    </form>
                    <div class="text-center">
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>



</div>