<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $id = $_GET['id']; 

 // Sesuaikan dengan setting MySQL 
$servername = "localhost"; 
$username = "root"; 
$password = "password"; 
$dbname = "elang_latihan8"; 

 // Create connection 
$conn = new mysqli($servername, $username, "", $dbname); 

 // Check connection 
if ($conn->connect_error) { 
die("Connection failed: " . $conn->connect_error); 
} 

 //DELETE FROM table_name WHERE condition; 
$sql = "DELETE FROM data_kecamatan WHERE id = $id"; 

if ($conn->query($sql) === TRUE) { 
echo "Record with id = $id deleted successfully"; 
} else { 
echo "Error: " . $sql . "<br>" . $conn->error; 
} 
$conn->close(); 
header("Location: index.php");
?>
</body>
</html>