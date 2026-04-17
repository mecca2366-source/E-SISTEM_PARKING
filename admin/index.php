<?php 
session_start();
include '../koneksi.php';

// TOTAL HARI INI
$q_total = mysqli_query($koneksi, "
    SELECT COUNT(*) as total 
    FROM transaksi 
    WHERE DATE(waktu_masuk)=CURDATE()
");
$total = mysqli_fetch_assoc($q_total);

// MASIH PARKIR
$q_parkir = mysqli_query($koneksi, "
    SELECT COUNT(*) as parkir 
    FROM transaksi 
    WHERE status='masuk'
");
$parkir = mysqli_fetch_assoc($q_parkir);

// PENDAPATAN
$q_pendapatan = mysqli_query($koneksi, "
    SELECT SUM(tarif) as total 
    FROM transaksi 
    WHERE DATE(waktu_masuk)=CURDATE()
");
$pendapatan = mysqli_fetch_assoc($q_pendapatan);
$total_pendapatan = $pendapatan['total'] ?? 0;

// DATA TABEL
$data = mysqli_query($koneksi, "
    SELECT * FROM transaksi 
    ORDER BY id_transaksi DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Dashboard</title>

    <style>
    body {
        margin: 0;
        font-family: Arial;
        background: #f5f5f5;
    }

    /* CARDS */
    .cards {
        display: flex;
        gap: 20px;
        padding: 20px;
    }

    .card {
        flex: 1;
        background: #F2EDC2;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    }

    .card .angka {
        font-size: 30px;
        color: orange;
    }

    /* TABLE */
    .table-container {
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #346739;
        color: white;
        padding: 10px;
    }

    td {
        padding: 10px;
        text-align: center;
    }

    tr:nth-child(even) {
        background: #eee;
    }

    .status-masuk {
        background: orange;
        padding: 5px 10px;
        border-radius: 10px;
    }

    .status-keluar {
        background: red;
        color: white;
        padding: 5px 10px;
        border-radius: 10px;
    }
    </style>
</head>

<body>

<?php include 'header.php'; ?>

<!-- CARDS -->
<div class="cards">
    <div class="card">
        <h3>Total Kendaraan Hari Ini</h3>
        <div class="angka"><?= $total['total'] ?></div>
    </div>

    <div class="card">
        <h3>Kendaraan Masih Parkir</h3>
        <div class="angka"><?= $parkir['parkir'] ?></div>
    </div>

    <div class="card">
        <h3>Total Pendapatan</h3>
        <div class="angka">Rp <?= number_format($total_pendapatan,0,',','.') ?></div>
    </div>
</div>

<!-- TABLE -->
<div class="table-container">
    <h3>Riwayat Transaksi</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Kode Tiket</th>
            <th>Plat</th>
            <th>Jenis</th>
            <th>Waktu</th>
            <th>Status</th>
        </tr>

        <?php if(mysqli_num_rows($data) > 0){ ?>
            <?php while($row = mysqli_fetch_assoc($data)){ ?>
            <tr>
                <td><?= $row['id_transaksi'] ?></td>
                <td><?= $row['kode_tiket'] ?></td>
                <td><?= $row['plat_nomor'] ?></td>
                <td><?= $row['jenis_kendaraan'] ?></td>
                <td>
                    <?= $row['waktu_masuk'] ?> 
                    <?= $row['waktu_keluar'] ? "- ".$row['waktu_keluar'] : "" ?>
                </td>
                <td>
                    <?php if($row['status']=="masuk"){ ?>
                        <span class="status-masuk">Parkir</span>
                    <?php } else { ?>
                        <span class="status-keluar">Keluar</span>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="6">Belum ada data transaksi</td>
            </tr>
        <?php } ?>

    </table>
</div>

</div> <!-- penutup main-content dari header -->

</body>
</html>