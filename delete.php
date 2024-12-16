<?php
// Koneksi ke database
$host = 'localhost';
$dbname = 'halte';
$username = 'root';
$password = '';

try {
    // Membuat koneksi ke database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Memastikan ID valid
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        // Persiapkan query untuk menghapus data berdasarkan ID
        $stmt = $pdo->prepare("DELETE FROM halte WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Eksekusi query
        if ($stmt->execute()) {
            // Redirect setelah penghapusan berhasil
            header("Location: tabel.php");
            exit();  // Pastikan tidak ada kode yang dieksekusi setelah ini
        } else {
            echo "Terjadi kesalahan saat menghapus data.";
        }
    } else {
        echo "ID tidak valid.";
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>