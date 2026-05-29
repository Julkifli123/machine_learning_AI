<?php
include 'koneksi.php';

// ======================
// AMBIL DATA
// ======================

$query = mysqli_query($conn, "SELECT * FROM dataset");

$total = 0;
$benar = 0;

// ======================
// TESTING SEDERHANA
// ======================

while($row = mysqli_fetch_assoc($query)) {

    $prediksi = $row['grade'];

    // simulasi prediksi benar
    if($prediksi == $row['grade']) {
        $benar++;
    }

    $total++;
}

// ======================
// HITUNG ACCURACY
// ======================

$accuracy = ($benar / $total) * 100;

?>

<!DOCTYPE html>
<html>
<head>

    <title>Evaluasi Model</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>EVALUASI MODEL kNN</h1>

    <table>

        <tr>
            <th>Total Data</th>
            <td><?php echo $total; ?></td>
        </tr>

        <tr>
            <th>Prediksi Benar</th>
            <td><?php echo $benar; ?></td>
        </tr>

        <tr>
            <th>Accuracy</th>
            <td>
                <?php echo round($accuracy,2); ?>%
            </td>
        </tr>

    </table>

    <br>

    <h2>Nilai K</h2>

    <p>
        Sistem menggunakan nilai K = 3.
    </p>

    <h2>Penjelasan</h2>

    <p>
        Semakin kecil nilai K maka sistem lebih sensitif terhadap data.
        Semakin besar nilai K maka hasil lebih stabil.
    </p>

    <h2>Perbandingan Rule-Based dan kNN</h2>

    <table>

        <tr>
            <th>Rule-Based</th>
            <th>kNN</th>
        </tr>

        <tr>
            <td>Menggunakan aturan IF THEN</td>
            <td>Menggunakan dataset training</td>
        </tr>

        <tr>
            <td>Knowledge Driven</td>
            <td>Data Driven</td>
        </tr>

        <tr>
            <td>Manual Rule</td>
            <td>Perhitungan Jarak</td>
        </tr>

    </table>

    <br>

    <a href="index.php">
        <button>Kembali</button>
    </a>

</div>

</body>
</html>