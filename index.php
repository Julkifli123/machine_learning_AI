<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>

    <title>Sistem Prediksi UKT kNN</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <div class="logo">

        <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/52/Logo_UIN_Mataram.png/600px-Logo_UIN_Mataram.png">

    </div>

    <h1>
        SISTEM PREDIKSI UKT UIN MATARAM
    </h1>

    <div class="card">

        <p>
            Sistem ini menggunakan algoritma
            <b>k-Nearest Neighbor (kNN)</b>
            untuk memprediksi grade UKT mahasiswa.
        </p>

    </div>

    <form action="proses_knn.php" method="POST">

        <label>Penghasilan Orang Tua</label>

        <input
            type="number"
            name="penghasilan"
            placeholder="Contoh: 3000000"
            required
        >

        <label>Jumlah Tanggungan</label>

        <input
            type="number"
            name="tanggungan"
            placeholder="Contoh: 4"
            required
        >

        <label>Jalur Masuk</label>

        <select name="jalur" required>

            <option value="">
                -- Pilih Jalur --
            </option>

            <option value="0">
                SPAN / Reguler
            </option>

            <option value="1">
                Mandiri
            </option>

        </select>

        <center>

            <button type="submit">
                Prediksi UKT
            </button>

        </center>

    </form>

    <div class="menu">

        <a href="data_training.php">

            <button type="button">
                Data Training
            </button>

        </a>

        <a href="evaluasi.php">

            <button type="button">
                Evaluasi Model
            </button>

        </a>

    </div>

    <div class="footer">

        <p>
            Mini Project Machine Learning kNN
            <br>
            UIN Mataram
        </p>

    </div>

</div>

</body>
</html>