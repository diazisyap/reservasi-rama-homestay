<?php

/**
 * Script otomatis untuk mengubah seluruh diagram menjadi ukuran persis 3:4 (2400 x 3200 HD)
 * dengan diagram di-scale secara proporsional agar BESAR, JELAS, dan MEMENUHI KANVAS
 * dengan margin rapi (3%-4%), latar belakang putih bersih, tanpa stretch dan tanpa blur.
 */

$imagesDir = __DIR__ . '/images';
$targets = [
    '01_usecase_global.png',
    '02_usecase_tamu.png',
    '03_usecase_admin.png',
    '04_erd_rama_homestay.png',
    '05_seq_registrasi_login.png',
    '06_seq_cek_ketersediaan_kamar.png',
    '07_seq_booking_kamar.png',
    '08_seq_pembayaran_midtrans.png',
    '09_seq_pembatalan_reservasi.png',
    '10_seq_manajemen_kamar_admin.png',
    '11_seq_pengelolaan_status_reservasi.png',
    '12_seq_ulasan_moderasi_testimoni.png',
    '13_seq_laporan_export_admin.png',
    '14_class_diagram_rama_homestay.png'
];

$targetCanvasW = 2400;
$targetCanvasH = 3200; // Rasio persis 3:4 (0.75)

echo "=== MEMPROSES SKALASI MAKSIMAL 3:4 (2400x3200 HD) UNTUK SELURUH DIAGRAM ===\n\n";

foreach ($targets as $filename) {
    $filePath = $imagesDir . '/' . $filename;
    if (!file_exists($filePath)) {
        continue;
    }

    $src = imagecreatefrompng($filePath);
    if (!$src) {
        continue;
    }

    $srcW = imagesx($src);
    $srcH = imagesy($src);

    // Pertama, crop auto-trim border putih kosong berlebih dari sumber jika ada
    // Cari bounding box sebenarnya dari konten non-putih
    $minX = $srcW;
    $minY = $srcH;
    $maxX = 0;
    $maxY = 0;

    // Sampling setiap 2 pixel untuk performa tinggi
    for ($y = 0; $y < $srcH; $y += 2) {
        for ($x = 0; $x < $srcW; $x += 2) {
            $rgb = imagecolorat($src, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            // Jika bukan putih murni (ada garis/teks diagram)
            if ($r < 250 || $g < 250 || $b < 250) {
                if ($x < $minX) $minX = $x;
                if ($x > $maxX) $maxX = $x;
                if ($y < $minY) $minY = $y;
                if ($y > $maxY) $maxY = $y;
            }
        }
    }

    // Berikan padding 15px dari bounding box konten
    $pad = 20;
    $cropX = max(0, $minX - $pad);
    $cropY = max(0, $minY - $pad);
    $cropW = min($srcW - $cropX, ($maxX - $minX) + ($pad * 2));
    $cropH = min($srcH - $cropY, ($maxY - $minY) + ($pad * 2));

    if ($cropW <= 0 || $cropH <= 0) {
        $cropX = 0; $cropY = 0; $cropW = $srcW; $cropH = $srcH;
    }

    // Buat kanvas target 2400 x 3200 persis 3:4
    $canvas = imagecreatetruecolor($targetCanvasW, $targetCanvasH);
    $white = imagecolorallocate($canvas, 255, 255, 255);
    imagefill($canvas, 0, 0, $white);

    // Area efektif diagram di dalam kanvas (margin 4% di setiap sisi)
    $usableW = $targetCanvasW * 0.92;
    $usableH = $targetCanvasH * 0.92;

    // Skala proporsional agar diagram sebesar mungkin mengisi kanvas
    $scale = min($usableW / $cropW, $usableH / $cropH);
    $destW = (int)round($cropW * $scale);
    $destH = (int)round($cropH * $scale);

    $destX = (int)round(($targetCanvasW - $destW) / 2);
    $destY = (int)round(($targetCanvasH - $destH) / 2);

    // Gambar dengan interpolasi kualitas tertinggi
    imagecopyresampled($canvas, $src, $destX, $destY, $cropX, $cropY, $destW, $destH, $cropW, $cropH);

    imagepng($canvas, $filePath, 9);

    imagedestroy($src);
    imagedestroy($canvas);

    printf("✓ %-38s -> %dx%d (Rasio: %.3f | Diagram: %dx%d)\n", 
        $filename, $targetCanvasW, $targetCanvasH, round($targetCanvasW / $targetCanvasH, 3), $destW, $destH);
}

echo "\nSemua gambar berhasil diskalakan memenuhi kanvas 3:4 dengan kejernihan maksimal!\n";
