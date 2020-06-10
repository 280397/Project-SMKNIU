<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-none: 1px solid #EEE;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>

<body>

    <p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span style='font-size:14.0pt;
font-family:"Times New Roman","serif"'><img width=356 height=66 id="Picture 1" src="assets/img/inventory/image001.png"></span></b></p>
    <p><span>==============================================================================</span></p>
    <caption style="margin=15px">LAPORAN INSVENTARISASI PERALATAN DAN ASET</caption>
    <p>Stok Barang: <?= $count ?></p>
    <p>Date: <?php
                $tgl = new DateTime();
                echo $tgl->format('l, F jS, Y');
                ?></p>
    <table style="width:100%">

        <thead>
            <tr style="text-align:center;">

                <th scope="col">Kode Inventaris</th>
                <th scope="col">Nama</th>
                <th scope="col">Merek</th>
                <th scope="col">Model</th>
                <th scope="col">Kondisi</th>
                <th scope="col">Lokasi</th>
                <!-- <th scope="col">Lokasi</th>
                <th scope="col">Gambar</th>

                <th scope="col">Action</th> -->
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($row->result() as $key => $data) { ?>
                <tr>
                    <!-- <th scope="row" style="width:5%;"><?= $i; ?></th> -->

                    <td><?= $data->barcode ?></td>
                    <td><?= $data->nk ?></td>
                    <td><?= $data->merk ?></td>
                    <td><?= $data->model ?></td>
                    <td><?= $data->k ?></td>
                    <td><?= $data->l ?></td>


                </tr>
                <?php $i++; ?>
            <?php } ?>
        </tbody>
    </table>
    <div class="row">
        <p style="text-align:center">REKAPITULASI</p>

        <div class=" col-md-3" style="display:inline">
            <p>Rekapitulasi Per Kategori</p>
            <table style="width:50%">

                <thead>
                    <tr style="text-align:center;">

                        <th scope="col">Nama Barang</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($kategori as $l) : ?>
                        <tr>
                            <!-- <th scope="row" style="width:5%;"><?= $i; ?></th> -->

                            <td><?= $l['kategori'] ?></td>
                            <td>
                                <?php
                                $idkategori = $l['id'];
                                $sql = "SELECT barang.merk FROM barang WHERE barang.nama_barang = $idkategori";
                                $query = $this->db->query($sql);
                                echo $query->num_rows();
                                ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>


    </div>
    <div class="row">
        <div class="col-md-3" style="display:inline">
            <p>Rekapitulasi Per Kondisi</p>
            <table style="width:50%">

                <thead>
                    <tr style="text-align:center;">

                        <th scope="col">Kondisi</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($kondisi as $l) : ?>
                        <tr>
                            <!-- <th scope="row" style="width:5%;"><?= $i; ?></th> -->

                            <td><?= $l['kondisi'] ?></td>
                            <td>
                                <?php
                                $idkondisi = $l['id'];
                                $sql = "SELECT barang.merk FROM barang WHERE barang.id_kondisi = $idkondisi";
                                $query = $this->db->query($sql);
                                echo $query->num_rows();
                                ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>

    </div>
    <div class="row">
        <table style="width:100%;">

            <thead>
                <tr>

                    <td scope="col" style="border:1px solid #ffffff;">
                        <p style="text-align:center;">Kepala UPT SMK Negeri Singojuruh</p><br><br><br>
                        <p style="text-align:center;"><u>GATOT KURNIATA S.Pd., M.M.</u></p>
                        <p style="text-align:center;margin-top:-10px">NIP. 19660210 199103 1 017</p>
                    </td>
                    <td scope="col" style="border:1px solid #ffffff;">
                        <p style="text-align:center;">Waka Sarpras</p><br><br><br>
                        <p style="text-align:center;"><u>MOH. HARIS, ST., MT.</u></p>
                        <p style="text-align:center;margin-top:-10px">NIP. 19660210 199103 1 017</p>
                    </td>
                    <td scope="col" style="border:1px solid #ffffff;">
                        <p style="text-align:center;">Pengurus Barang</p><br><br><br>
                        <p style="text-align:center;"><u><?php echo $user['name']; ?></u></p>
                        <p style="text-align:center;margin-top:-10px">NIP. -</p>

                    </td>
                </tr>
            </thead>

        </table>
    </div>
    </div>
</body>

</html>




<div class="card-footer small text-muted">Updated <?= date('Y-m-d H:i:s') ?></div>