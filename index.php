<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // Sesuaikan dengan setting MySQL 
    $servername = "localhost"; 
    $username = "root"; 
    $password = " "; 
    $dbname = "elang_latihan8";
    
    // Create connection 
    $conn = new mysqli($servername, $username, "", $dbname); 
    // Check connection 
    if ($conn->connect_error) { 
        die("Gagal Koneksi: " . $conn->connect_error); 
    }

    $sql = "SELECT * FROM data_kecamatan"; 
    //menyimpan eksekusi query
    $result = $conn->query($sql);

    echo "<a href='input/index.html'>input</a>";

    //memeriksa hasil query apakah memiliki data
    if ($result->num_rows > 0) { 
    echo "<table border='1px'><tr>
    <th>ID</th>
    <th>Kecamatan</th>
    <th>Longitude</th>
    <th>Latitude</th> 
    <th>Luas</th> 
    <th>Jumlah Penduduk</th>
    <th colspan='2'>Aksi</th>"; 
    
    // mengambil data hasil query dan menampilkan dalam array asosiatif 
    while($row = $result->fetch_assoc()) { 
        echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row["kecamatan"]."</td>
        <td>".$row["longitude"]."</td>
        <td>".$row["latitude"]."</td>
        <td>".$row["luas"]."</td>
        <td align='right'>".$row["jumlah_penduduk"]."</td>
        <td><a href='delete.php?id=".$row['id']."'>Hapus</a></td>
        <td><a href='edit/index.php?id=".$row['id']."'>Edit</a></td>
        </tr>"; 
    } 
        echo "</table>"; 
    } else { 
        echo "0 results"; 
    } 
    $conn->close();
    ?>
</body>
</html>