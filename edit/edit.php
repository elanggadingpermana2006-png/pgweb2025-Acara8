<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $id = $_POST['id']; 
    $kecamatan = $_POST['kecamatan']; 
    $longitude = $_POST['longitude']; 
    $latitude = $_POST['latitude']; 
    $luas = $_POST['luas']; 
    $jumlah_penduduk = $_POST['jumlah_penduduk']; 

// Sesuaikan dengan setting MySQL 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "elang_latihan8"; 

// Create connection 
$conn = new mysqli($servername, $username, "", $dbname); 

// Check connection 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 

// Jalankan query update hanya jika semua field sudah diisi
if (!empty($id) && !empty($kecamatan)) {
    $sql = "UPDATE data_kecamatan 
            SET kecamatan='$kecamatan', 
                longitude='$longitude', 
                latitude='$latitude', 
                luas='$luas', 
                jumlah_penduduk='$jumlah_penduduk' 
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) { 
        echo "Record edited successfully"; 
        header("Location: ../index.php");
        exit();
    } else { 
        echo "Error: " . $sql . "<br>" . $conn->error; 
    } 
} else {
    echo "Data tidak lengkap!";
}

$conn->close(); 
?>

</body>
</html>