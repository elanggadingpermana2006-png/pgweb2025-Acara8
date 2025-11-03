<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web GIS Kabupaten Sleman</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1, h3 {
            text-align: center;
            margin: 0;
        }

        h3 {
            margin-bottom: 20px;
            color: #555;
        }

        /* Tata letak dua kolom (tabel di kiri, peta di kanan) */
        .container {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        /* Tabel */
        table {
            border-collapse: collapse;
            width: 330px;
            font-size: 14px;
        }

        th, td {
            border: 1px solid #999;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: blue;
            font-size: 13px;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Peta */
        #map {
            width: 700px;
            height: 450px;
            border: 1px solid #999;
        }

        /* Responsif */
        @media (max-width: 900px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            #map {
                width: 95%;
            }
        }
    </style>
</head>
<body>
    <h1>Web GIS</h1>
    <h3>Kabupaten Sleman</h3>

    <div class="container">
        <!-- Bagian kiri: tabel -->
        <div class="table-section">
            <?php
            // 🔹 Koneksi ke database
            $conn = new mysqli("localhost", "root", "", "elang_latihan8");
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // 🔹 Ambil data dari tabel
            $sql = "SELECT * FROM data_kecamatan";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr>
                        <th>Kecamatan</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
                        <th>Luas</th>
                        <th>Jumlah Penduduk</th>
                        <th colspan='2'>Aksi</th>
                    </tr>";

                $markers = []; // untuk peta

                while($row = $result->fetch_assoc()) {
                    $markers[] = $row;
                    echo "<tr>
                            <td>{$row['kecamatan']}</td>
                            <td>{$row['longitude']}</td>
                            <td>{$row['latitude']}</td>
                            <td>{$row['luas']}</td>
                            <td>{$row['jumlah_penduduk']}</td>
                            <td>
                                <a href='edit/index.php?id={$row['id']}'>Edit</a>
                                <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Yakin ingin hapus data ini?\")'>Hapus</a>
                            </td>
                        </tr>";
                }

                echo "</table>";
            } else {
                echo "Tidak ada data.";
            }

            $conn->close();
            ?>
        </div>

        <!-- Bagian kanan: peta -->
        <div id="map"></div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // 🔹 Inisialisasi peta
        var map = L.map("map").setView([-7.8, 110.3], 11);

        // 🔹 Tambahkan base map OpenStreetMap
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // 🔹 Data dari PHP
        var data = <?php echo json_encode($markers); ?>;

        // 🔹 Tambahkan marker dari database
        data.forEach(function(item) {
            if (item.latitude && item.longitude) {
                L.marker([item.latitude, item.longitude])
                .addTo(map)
                .bindPopup(
                    "<b>" + item.kecamatan + "</b><br>" +
                    "Luas: " + item.luas + " km²<br>" +
                    "Penduduk: " + item.jumlah_penduduk
                );
            }
        });
    </script>
</body>
</html>
