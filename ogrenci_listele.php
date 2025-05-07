<?php
include 'baglanti.php';

if (isset($_GET['sil'])) {
    $sil_id = $_GET['sil'];
    $conn->query("DELETE FROM ogrenciler WHERE id = $sil_id");
    header("Location: ogrenci_listele.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Öğrenci Listesi</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
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

<h2 style="text-align:center;">👨‍🎓 Öğrenci Listesi</h2>

<table>
    <thead>
        <tr>
            <th>Ad</th>
            <th>Soyad</th>
            <th>TC</th>
            <th>Telefon</th>
            <th>Ehliyet sınıfı</th>
            <th>Doğum Tarihi</th>
            <th>İşlemler</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM ogrenciler";
        $result = $conn->query($sql);

        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= htmlspecialchars($row['ad']) ?></td>
            <td><?= htmlspecialchars($row['soyad']) ?></td>
            <td><?= htmlspecialchars($row['tc']) ?></td>
            <td><?= htmlspecialchars($row['telefon']) ?></td>
            <td><?= htmlspecialchars($row['ehliyet_sinifi']) ?></td>
            <td><?= htmlspecialchars($row['dogum_tarihi']) ?></td>
            <td>
                <a href="?sil=<?= $row['id'] ?>" class="btn sil-btn" onclick="return confirm('Bu öğrenciyi silmek istediğinizden emin misiniz?')">🗑️ Sil</a>
                
            </td>
        </tr>
        <?php endwhile; else: ?>
        <tr><td colspan="7">Kayıtlı öğrenci bulunamadı.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<div style="text-align: center; margin-top: 20px;">
    <a href="index.html" class="btn" style="background-color: #3498db;">🏠 Ana Sayfaya Dön</a>
</div>

</body>
</html>
