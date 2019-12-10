<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QR-Code-<?= $row->barcode ?></title>
</head>

<body>
    <br>
    <br>
    <img src="assets/img/qr-code/inventory-<?= $row->barcode ?>-qrcode.png" style="width:250px">
    <br>
    <?= $row->barcode ?>
</body>

</html>