<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ID-<?= $row->id_admin ?></title>
</head>

<body>
    <?php
    $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->id_admin, $generator::TYPE_CODE_128)) . '" style="width:250px">';
    ?>
    <br>
    <?= $row->id_admin ?>
</body>

</html>