<div id="content">

    <div class="container-fluid">
        <!-- Page Content -->
        <h2><?= $title; ?></h2>
        <hr>

        <!-- Icon Cards-->
        <div class="row">
            <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-shopping-cart"></i>
                        </div>
                        <h3><?= $count ?></h3>
                        <div class="mr-5">Stok Barang!</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="<?= base_url('barang') ?>">
                        <span class="float-left">Lihat Detail</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card text-white bg-info o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-list"></i>
                        </div>
                        <div class="mr-5">Peminjaman!</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="<?= base_url('peminjaman') ?>">
                        <span class="float-left">Lihat Detail</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-share"></i>
                        </div>
                        <h3>
                            <?php
                            $sql = "SELECT barang.merk FROM barang WHERE barang.id_kondisi = 1";
                            $query = $this->db->query($sql);
                            echo $query->num_rows();
                            ?>
                        </h3>
                        <div class="mr-5">Barang Baru!</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="<?= base_url('kondisi/indexkondisi/1') ?>">
                        <span class="float-left">Lihat Detail</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>


            <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card text-white bg-danger o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-life-ring"></i>
                        </div>
                        <h3>
                            <?php
                            $sql = "SELECT barang.merk FROM barang WHERE barang.id_kondisi = 2";
                            $query = $this->db->query($sql);
                            echo $query->num_rows();
                            ?>
                        </h3>
                        <div class="mr-5">Barang Rusak!</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="<?= base_url('kondisi/indexkondisi/2') ?>">
                        <span class="float-left">Lihat Detail</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-wrench"></i>
                        </div>
                        <h3>
                            <?php
                            $sql = "SELECT barang.merk FROM barang WHERE barang.id_kondisi = 3";
                            $query = $this->db->query($sql);
                            echo $query->num_rows();
                            ?>
                        </h3>
                        <div class="mr-5">Barang Diperbaiki!</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="<?= base_url('kondisi/indexkondisi/3') ?>">
                        <span class="float-left">Lihat Detail</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card text-white bg-secondary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-sitemap"></i>
                        </div>
                        <h3>
                            <?php

                            $sql = "SELECT barang_lokasi.id FROM barang_lokasi";
                            $query = $this->db->query($sql);
                            echo $query->num_rows();
                            ?>
                        </h3>
                        <div class="mr-5">Lokasi!</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="<?= base_url('lokasi') ?>">
                        <span class="float-left">Lihat Detail</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>



    </div>
    <!-- /.container-fluid -->