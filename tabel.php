<?php
// Koneksi ke database
$host = 'localhost';
$dbname = 'halte'; // Nama database Anda
$username = 'root';  // Username database Anda
$password = '';      // Password database Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mengambil data dari tabel halte
    $query = $pdo->query("SELECT id, nama_halte, alamat FROM halte");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Halte</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        body {
            font-family: monospace;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
            background-color: #e0f7fa;
        }

        h1, h2 { 
            text-align: center;
            font-size: 30px;
            margin-top: 40px;
        }

        .container {
            display: flex;
            flex-direction: column;
            width: 90%;
            max-width: 1000px;
            margin-top: 20px;
        }

        #table-container {
            width: 100%;
            overflow-y: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #1D3557;
            color: white;
        }

    </style>
</head>

<body>
    <h1>DAFTAR HALTE KEWENANGAN DINAS PERHUBUNGAN SLEMAN</h1>

    <div class="container">
        <!-- Tabel Data -->
        <div id="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nama Halte</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['nama_halte']) ?></td>
                        <td><?= htmlspecialchars($row['alamat']) ?></td>
                        <td>
                            <button onclick="editHalte(<?= $row['id'] ?>)">Edit</button>
                            <button onclick="deleteHalte(<?= $row['id'] ?>)">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div style="text-align: center; margin-top: 20px;">

             <!-- Button kembali -->
            <button onclick="buttonback()" style="
                background-color: #1D3557;
                color: white;
                font-family: monospace;
                padding: 10px 20px;
                font-size: 16px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.2s ease;
            ">Tutup</button>
        </div>

        </div>
    </div>

    <script>
    function editHalte(id) {
        // Arahkan ke halaman edit dengan membawa ID
        window.location.href = "edit.php?id=" + encodeURIComponent(id);
    }

    function deleteHalte(id) {
        if (confirm("Apakah Anda yakin ingin menghapus halte dengan ID " + id + "?")) {
            // Arahkan ke halaman delete dengan membawa ID
            window.location.href = "delete.php?id=" + encodeURIComponent(id);
        }
    }

    function buttonback() {
    window.location.href = "persebaran.html"; 
    }
    </script>
</body>
</html>
