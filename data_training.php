<?php
include 'koneksi.php';

// ======================
// AMBIL DATASET
// ======================

$query = mysqli_query($conn, "SELECT * FROM dataset");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Training</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container">

    <h1>DATA TRAINING kNN</h1>

    <table>

        <tr>
            <th>ID</th>
            <th>Penghasilan</th>
            <th>Tanggungan</th>
            <th>Jalur</th>
            <th>Grade</th>
        </tr>

        <?php
        while($row = mysqli_fetch_assoc($query)){
        ?>

        <tr>

            <td>
                <?php echo $row['id']; ?>
            </td>

            <td>
                Rp <?php echo number_format($row['penghasilan'],0,',','.'); ?>
            </td>

            <td>
                <?php echo $row['tanggungan']; ?>
            </td>

            <td>

                <?php
                if($row['jalur'] == 0){
                    echo "SPAN";
                } else {
                    echo "Mandiri";
                }
                ?>

            </td>

            <td>
                Grade <?php echo $row['grade']; ?>
            </td>

        </tr>

        <?php } ?>

    </table>

    <br>

    <a href="index.php">
        <button>Kembali</button>
    </a>

</div>

</body>
</html>