<?php
include 'baglanti.php';

if (isset($_GET['sil'])) {
    $sil_id = $_GET['sil'];
    $conn->query("DELETE FROM egitmenler WHERE id = $sil_id");
    header("Location: egitmen_listele.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Eğitmen Listesi</title>
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

<h2 style="text-align:center;">📋 Eğitmen Listesi</h2>

<table>
    <thead>
        <tr>
            <th>Ad</th>
            <th>Soyad</th>
            <th>Branş</th>
            <th>Telefon</th>
            <th>İşlemler</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM egitmenler";
        $result = $conn->query($sql);

        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= htmlspecialchars($row['ad']) ?></td>
            <td><?= htmlspecialchars($row['soyad']) ?></td>
            <td><?= htmlspecialchars($row['brans']) ?></td>
            <td><?= htmlspecialchars($row['telefon']) ?></td>
            <td>
                <a href="?sil=<?= $row['id'] ?>" class="btn sil-btn" onclick="return confirm('Bu eğitmeni silmek istediğinizden emin misiniz?')">🗑️ Sil</a>
                
            </td>
        </tr>
        <?php endwhile; else: ?>
        <tr><td colspan="5">Kayıtlı eğitmen bulunamadı.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<div style="text-align: center; margin-top: 20px;">
    <a href="index.html" class="btn" style="background-color: #3498db;">🏠 Ana Sayfaya Dön</a>
</div>

</body>
</html>
