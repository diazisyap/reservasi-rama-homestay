<?php
$namaHomestay = "Rama Homestay";
$deskripsi = "Selamat datang di Rama Homestay. Temukan kenyamanan menginap terbaik.";
$kamarTersedia = true;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $namaHomestay; ?></title>
</head>
<body>

    <p><?php echo $deskripsi; ?></p>
    
    <?php if ($kamarTersedia): ?>
        <a href="/rooms">Pesan Kamar</a>
    <?php else: ?>
        <p>Maaf, Kamar Penuh</p>
    <?php endif; ?>

</body>
</html>
