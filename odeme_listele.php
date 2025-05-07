<?php
include 'baglanti.php';

if (isset($_GET['sil'])) {
    $sil_id = $_GET['sil'];
    $conn->query("DELETE FROM odemeler WHERE id = $sil_id");
    header("Location: odeme_listele.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ödeme Listesi</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .btn {
            text-decoration: none;
            padding: 6px 12px;
            margin: 4px;
            border-radius: 4px;
            color: white;
        }
        .sil-btn {
            background-color: red;
        }
        .duzenle-btn {
            background-color: green;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">📋 Ödeme Listesi</h2>

<table>
    <thead>
        <tr>
            <th>Öğrenci Adı</th>
            <th>Tutar</th>
            <th>Tarih</th>
            <th>Ödeme Durumu</th>
            <th>Açıklama</th>
            <th>İşlemler</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Ödemeleri ve ilgili öğrenci bilgilerini çek
        $sql = "SELECT odemeler.id, ogrenciler.ad, ogrenciler.soyad, odemeler.tutar, odemeler.tarih, odemeler.odeme_durumu, odemeler.aciklama 
                FROM odemeler 
                INNER JOIN ogrenciler ON odemeler.ogrenci_id = ogrenciler.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= htmlspecialchars($row['ad']) . " " . htmlspecialchars($row['soyad']) ?></td>
            <td><?= htmlspecialchars($row['tutar']) ?> ₺</td>
            <td><?= htmlspecialchars($row['tarih']) ?></td>
            <td><?= htmlspecialchars($row['odeme_durumu']) ?></td>
            <td><?= htmlspecialchars($row['aciklama']) ?></td>
            <td>
                <a href="?sil=<?= $row['id'] ?>" class="btn sil-btn" onclick="return confirm('Bu ödemeyi silmek istediğinizden emin misiniz?')">🗑️ Sil</a>
            </td>
        </tr>
        <?php endwhile; else: ?>
        <tr><td colspan="6">Kayıtlı ödeme bulunamadı.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<div style="text-align: center; margin-top: 20px;">
    <a href="index.html" class="btn" style="background-color: #3498db;">🏠 Ana Sayfaya Dön</a>
</div>

</body>
</html>
