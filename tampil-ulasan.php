<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pengaduan</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #c5d6e1;
      color: #333;
      padding: 20px;
    }

    header {
      background-color: #1D3557;
      color: white;
      font-family: 'Cascadia Code', monospace;
      border-radius: 10px;
      box-shadow: 0px 4px 8px rgb(255, 255, 255);
      text-align: center;
      padding: 20px 0;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      background: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color:rgb(255, 255, 255);
      font-family: 'Cascadia Code', monospace;;
    }

    h2 {
      text-align: center;
      color:rgb(255, 255, 255);
      font-family: 'Cascadia Code', monospace;;
    }

    .review {
      border-bottom: 1px solid #ddd;
      font-family: 'Cascadia Code', monospace;
      padding: 15px 0;
    }

    .review:last-child {
      border-bottom: none;
    }

    .review h3 {
      margin: 0;
      color: #007BFF;
    }

    .review p {
      margin: 5px 0;
      font-family:  'Lucida Sans';
      color:rgb(3, 3, 3);
    }

    .review .date {
      font-size: 12px;
      color: #888;
    }

    .btn {
      display: inline-block;
      background-color: #1D3557;
      color: white;
      padding: 15px 25px;
      text-decoration: none;
      border-radius: 5px;
      border-color:rgb(255, 255, 255);
      text-align: center;
      margin-top: 20px;
    }

    .btn:hover {
      background-color:#c5d6e1;
      ;
    }
  </style>
</head>

<body>
  <header>
    <h1>DATA PENGADUAN</h1>
  </header>

  <div class="container">
    <?php
    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "ulasan_db");

    // Periksa koneksi
    if ($conn->connect_error) {
        die("<p style='color: red;'>Koneksi database gagal: " . $conn->connect_error . "</p>");
    }

    // Query untuk mengambil data ulasan
    $sql = "SELECT nama, email, ulasan, tanggal FROM ulasan ORDER BY tanggal DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Tampilkan ulasan
        while ($row = $result->fetch_assoc()) {
            echo "<div class='review'>";
            echo "<h3>" . htmlspecialchars($row['nama']) . "</h3>";
            echo "<p class='date'>" . htmlspecialchars($row['tanggal']) . "</p>";
            echo "<p>" . nl2br(htmlspecialchars($row['ulasan'])) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Tidak ada ulasan yang tersedia.</p>";
    }

    $conn->close();
    ?>

    <!-- Tombol Kembali ke Menu Awal -->
    <a href="index.html" class="btn">Kembali ke Menu Awal</a>

  </div>
</body>

</html>
