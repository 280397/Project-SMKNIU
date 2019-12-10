<div id="content">

    <div class="container-fluid">
        <!-- Page Content -->
        <h3><?= $title; ?></h3>
        <hr>
        <form action="<?= base_url('kondisi/process'); ?>" method="post">

            <div class="form-group">
                <label for="kondisi">Nama kondisi</label>
                <input type="hidden" name="id" value="<?= $row->id ?>">
                <input type="text" class="form-control" value="<?= $row->kondisi ?>" id="kondisi" name="kondisi" placeholder="kondisi" required="required" autofocus="autofocus">
            </div>

            <div class="footer">

                <button name="<?= $page ?>" type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
<!-- /.container-fluid -->