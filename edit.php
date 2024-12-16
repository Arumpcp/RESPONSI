<?php
$host = 'localhost';
$dbname = 'halte';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ambil ID dari parameter GET untuk pre-populate data
    $id = $_GET['id'] ?? null;

    if (!$id) {
        die("ID tidak valid.");
    }

    // Ambil data berdasarkan ID
    $stmt = $pdo->prepare("SELECT * FROM halte WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $halte = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$halte) {
        die("Data tidak ditemukan.");
    }

    // Proses form jika dikirim (POST request)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama_halte = $_POST['nama_halte'] ?? '';
        $alamat = $_POST['alamat'] ?? '';

        if (!empty($nama_halte) && !empty($alamat)) {
            // Update data ke database
            $updateStmt = $pdo->prepare("UPDATE halte SET nama_halte = :nama_halte, alamat = :alamat WHERE id = :id");
            $updateStmt->bindParam(':nama_halte', $nama_halte, PDO::PARAM_STR);
            $updateStmt->bindParam(':alamat', $alamat, PDO::PARAM_STR);
            $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($updateStmt->execute()) {
                echo "<script>alert('Data berhasil diperbarui!'); window.location.href = 'tabel.php';</script>";
            } else {
                echo "Terjadi kesalahan saat memperbarui data.";
            }
        } else {
            echo "Nama halte dan alamat tidak boleh kosong.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perubahan Data Halte</title>
    <style>
        body {
            font-family: 'Cascadia Code', monospace;
            background-color: #e0f7fa;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            font-family: 'Cascadia Code', monospace;
        }

        form {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 3px solid #1D3557;
            font-family: 'Cascadia Code', monospace;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(255, 255, 255, 0.2);
        }

        input[type="text"], input[type="submit"] {
            width: 90%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            font-family: 'Cascadia Code', monospace;
            border: 5px solid #1D3557;
            border-radius: 5px;
        }

        input[type="submit"] {
            margin-top: 10px;
            background-color: #1D3557;
            color: white;
            width: 96%;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #e0f7fa;
        }
    </style>
</head>
<body>
    <h2>Perubahan Data Halte</h2>
    <form method="POST">
        <label for="nama_halte">Nama Halte:</label>
        <input type="text" name="nama_halte" id="nama_halte" value="<?= htmlspecialchars($halte['nama_halte']); ?>" required>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" id="alamat" value="<?= htmlspecialchars($halte['alamat']); ?>" required>

        <input type="submit" value="Simpan Perubahan">
    </form>
</body>
</html> 