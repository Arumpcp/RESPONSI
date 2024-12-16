<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pengaduan</title>
    <style>
        /* Styling yang sama seperti sebelumnya */
        body,
        h1,
        p,
        label,
        input,
        textarea {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Cascadia Code', monospace;
            background-color: #e0f7fa;
            color: #333;
            line-height: 1.6;
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

        .form-container {
            background: white;
            border: 5px solid #1D3557;
            border-radius: 8px;
            padding: 20px;
            max-width: 500px;
            margin: 30px auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #457B9D;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-style:oblique;
            display: block;
            font-family: 'Cascadia Code', monospace;
            margin-bottom: 5px;
        }

        .form-group input, .form-group textarea {
            width: 90%;
            font-family: 'Cascadia Code', monospace;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group textarea {
            resize: vertical;
            height: 100px;
        }


        /*submit button*/
        .btn-send {
            display: inline-block;
            background-color: #457B9D;
            display: inline-block;
            font-family: 'Cascadia Code';  
            padding: 13px 20px;
            text-decoration: none;
            border-radius: 10px;
            text-align: center;
            color: white;
            font-size: 14px;
            border-radius: 10px;
        }

        .btn-send:hover {
            background-color:rgb(0, 0, 0);
        }

        .success {
            color: green;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        /*back button*/
        .back-btn {
            margin-top: 10px;
            display: inline-block;
            font-family: 'Cascadia Code', monospace;
            background-color: #1D3557;   
            padding: 13px 23px;
            text-decoration: none;
            border-radius: 10px;
            text-align: center;
            color: white;
            font-family: 'Cascadia Code';
            font-size: 14px;
            border-radius: 10px;
        }

        .back-btn:hover {
            background-color:#c5d6e1;
        }
    </style>
</head>

<body>
    <header>
        <h1><Footer></Footer>FORMULIR PENGADUAN</h1>
    </header>

    <div class="form-container">
        <h2>Tuliskan Pengaduan Anda</h2>

        <?php
        // Proses Formulir
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = $_POST['name'];
            $email = $_POST['email'];
            $ulasan = $_POST['review'];

            // Koneksi ke Database
            $conn = new mysqli("localhost", "root", "", "ulasan_db");

            // Periksa koneksi
            if ($conn->connect_error) {
                die("<p class='error'>Koneksi database gagal: " . $conn->connect_error . "</p>");
            }

            // Query untuk menyimpan data
            $stmt = $conn->prepare("INSERT INTO ulasan (nama, email, ulasan) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nama, $email, $ulasan);

            if ($stmt->execute()) {
                echo "<p class='success'>Pengaduan telah disimpan! Terima kasih.</p>";
            } else {
                echo "<p class='error'>Terjadi kesalahan saat menyimpan pengaduan. Silakan coba lagi.</p>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>

        <form action="form-ulasan.php" method="post">
            <div class="form-group">
                <label for="name">NAMA:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">EMAIL:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="review">PENGADUAN:</label>
                <textarea id="review" name="review" required></textarea>
            </div>
            <button type="submit" class="btn-send">Kirim Ulasan</button>
        </form>

        <!-- Tombol Kembali ke Menu Awal -->
        <a href="index.html" class="btn back-btn">Tutup</a>
    </div>
</body>

</html>