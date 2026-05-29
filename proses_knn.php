<?php
include 'koneksi.php';

// ======================
// INPUT USER
// ======================

$penghasilan = $_POST['penghasilan'];
$tanggungan = $_POST['tanggungan'];
$jalur = $_POST['jalur'];

// ======================
// NILAI K
// ======================

$k = 3;

// ======================
// AMBIL DATASET
// ======================

$query = mysqli_query($conn, "SELECT * FROM dataset");

// ======================
// ARRAY DATA JARAK
// ======================

$data_jarak = [];

// ======================
// HITUNG JARAK
// ======================

while($row = mysqli_fetch_assoc($query)) {

    $jarak = sqrt(
        pow($penghasilan - $row['penghasilan'], 2) +
        pow($tanggungan - $row['tanggungan'], 2) +
        pow($jalur - $row['jalur'], 2)
    );

    $data_jarak[] = [
        'penghasilan' => $row['penghasilan'],
        'tanggungan' => $row['tanggungan'],
        'jalur' => $row['jalur'],
        'grade' => $row['grade'],
        'jarak' => $jarak
    ];
}

// ======================
// SORTING JARAK
// ======================

usort($data_jarak, function($a, $b) {
    return $a['jarak'] <=> $b['jarak'];
});

// ======================
// AMBIL K TETANGGA
// ======================

$tetangga = array_slice($data_jarak, 0, $k);

// ======================
// HITUNG GRADE TERBANYAK
// ======================

$grade_count = [];

foreach($tetangga as $t) {

    $grade = $t['grade'];

    if(!isset($grade_count[$grade])) {
        $grade_count[$grade] = 0;
    }

    $grade_count[$grade]++;
}

// ======================
// SORTING
// ======================

arsort($grade_count);

// ======================
// HASIL PREDIKSI
// ======================

$hasil_grade = array_key_first($grade_count);

// ======================
// SIMPAN HASIL PREDIKSI
// ======================

mysqli_query($conn, "

INSERT INTO hasil_prediksi (
    penghasilan,
    tanggungan,
    jalur,
    hasil_grade
)

VALUES (
    '$penghasilan',
    '$tanggungan',
    '$jalur',
    '$hasil_grade'
)

");

?>

<!DOCTYPE html>
<html>
<head>

    <title>Hasil Prediksi</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>HASIL PREDIKSI UKT kNN</h1>

    <p>
        <b>Penghasilan:</b>
        Rp <?php echo number_format($penghasilan,0,',','.'); ?>
    </p>

    <p>
        <b>Tanggungan:</b>
        <?php echo $tanggungan; ?>
    </p>

    <p>
        <b>Jalur:</b>

        <?php
        if($jalur == 0){
            echo "SPAN";
        } else {
            echo "Mandiri";
        }
        ?>

    </p>

    <h2>
        Prediksi Grade UKT :
        GRADE <?php echo $hasil_grade; ?>
    </h2>

    <hr>

    <h3>3 Tetangga Terdekat</h3>

    <table>

        <tr>
            <th>No</th>
            <th>Penghasilan</th>
            <th>Tanggungan</th>
            <th>Jalur</th>
            <th>Grade</th>
            <th>Jarak</th>
        </tr>

        <?php

        $no = 1;

        foreach($tetangga as $t){

        ?>

        <tr>

            <td><?php echo $no++; ?></td>

            <td>
                Rp <?php echo number_format($t['penghasilan'],0,',','.'); ?>
            </td>

            <td>
                <?php echo $t['tanggungan']; ?>
            </td>

            <td>

                <?php

                if($t['jalur'] == 0){
                    echo "SPAN";
                } else {
                    echo "Mandiri";
                }

                ?>

            </td>

            <td>
                Grade <?php echo $t['grade']; ?>
            </td>

            <td>
                <?php echo round($t['jarak'],2); ?>
            </td>

        </tr>

        <?php } ?>

    </table>

    <br>

    <a href="evaluasi.php">
        <button>Lihat Evaluasi</button>
    </a>

    <a href="index.php">
        <button>Kembali</button>
    </a>

</div>

</body>
</html>