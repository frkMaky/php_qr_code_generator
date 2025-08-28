<?php

use chillerlan\QRCode\{QRCode, QROptions};

require_once __DIR__ . '/vendor/autoload.php';

if (isset($_POST['data'])) $data = $_POST['data'];
else $data = "";

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="container">
        <form action="" method="POST">
            <h1>QR Code Generator</h1>

            <label>Introduce Texto o URL</label>
            <input type="text"
                name="data"
                value="<?php echo $data; ?>"
                placeholder="Introduce URL o Texto">

            <label>Selecciona tamaño del QR</label>
            <select name="size">
                <option value="500">Pequeño (500x500)</option>
                <option value="750">Mediano (750x750)</option>
                <option value="1000">Grande (1000x1000)</option>
            </select>

            <button type="submit">Generar QR</button>
        </form>
    </div>
    <div class="qr">
        <?php
        if (isset($_POST['data']) && !empty($_POST['data'])) {
            $data = $_POST['data'];
            $size = (int)$_POST['size'];

            $filePath = 'qrcodes/' . uniqid() . '.png';
            // Generar QR
            $options = (new QROptions());
            $qrcode = (new QRCode($options))->render($data);

            echo "<h2>Este es tu código QR:</h2>";
            echo '<img src="' . $qrcode . '" alt="QR Code" width=' . $size . ' height=' . $size . ' />';
            echo "<br><a href='$qrcode' download>Descargar código QR</a>";
        } else {
            echo "<br>No se han recibido datos";
        }
        ?>
    </div>

</body>

</html>