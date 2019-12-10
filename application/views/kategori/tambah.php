<div id="content">

    <div class="container-fluid">
        <!-- Page Content -->
        <h3><?= $title; ?></h3>
        <hr>
        <form action="<?= base_url('kategori/process'); ?>" method="post">

            <div class="form-group">
                <label for="kategori">Nama kategori</label>
                <input type="hidden" name="id" value="<?= $row->id ?>">
                <input type="text" class="form-control" value="<?= $row->kategori ?>" id="kategori" name="kategori" placeholder="Masukkan kategori" required="required" autofocus="autofocus">
            </div>

            <div class="footer">

                <button name="<?= $page ?>" type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>

</div>
<!-- /.container-fluid -->