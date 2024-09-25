<!doctype html>
<html lang="en">
    <head>
        <title>Cari Modal Awal - Bunga Tunggal</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <style>
            body {
                background-color: #f9fafb;
                font-family: 'Arial', sans-serif;
                background-image: url('baldi.png'); 
                background-repeat: no-repeat;
                background-size: cover;
            }

            h1 {
                color: #2c3e50;
                text-align: center;
                margin-top: 20px;
            }
            label {
                font-weight: bold;
                color: #34495e;
            }
            .container {
                max-width: 600px;
                margin: 40px auto;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .card {
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border: none;
            }
            input[type="number"], select, input[type="submit"] {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ced4da;
                border-radius: 5px;
                outline: none; /* Removes the outline */
            }
            input[type="submit"] {
                background-color: #3498db;
                color: white;
                font-weight: bold;
                border: none;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background-color: #2980b9;
            }
            .result {
                text-align: center;
                font-size: 18px;
                color: #27ae60;
                margin-top: 20px;
            }
        </style>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        
        <main>
            <div class="container">
                <h1>MODAL AWAL TUNGGAL</h1>
                <div class="card bg-white">
                    <?php
                    if (isset($_POST['hitung'])) {
                        $total_pinjaman = $_POST['total_pinjaman']; 
                        $bunga = $_POST['bunga']; 
                        $suku = $_POST['suku']; 
                        $periode = $_POST['periode']; 
                        $jangka = $_POST['jangka']; 

                        // Fungsi untuk menghitung modal awal dengan bunga tunggal
                        function hitungModalAwalTunggal($total_pinjaman, $bunga, $jangka) {
                            $bunga_decimal = $bunga / 100;
                            $modal = $total_pinjaman / (1 + ($bunga_decimal * $jangka));
                            return $modal;
                        }

                        // Mengonversi jangka waktu sesuai periode yang dipilih
                        switch ($periode) {
                            case "bulan":
                                $jangka_waktu = $jangka; // Dalam bulan
                                break;
                            case "triwulan":
                                $jangka_waktu = $jangka * 3; // 1 triwulan = 3 bulan
                                break;
                            case "semester":
                                $jangka_waktu = $jangka * 6; // 1 semester = 6 bulan
                                break;
                            case "tahun":
                                $jangka_waktu = $jangka * 12; // 1 tahun = 12 bulan
                                break;
                            default:
                                $jangka_waktu = 0;
                        }

                        // Mengonversi suku bunga sesuai interval waktu yang dipilih
                        switch ($suku) {
                            case "bulan":
                                $jangka_waktu_bunga = $jangka_waktu; // Suku bunga per bulan
                                break;
                            case "triwulan":
                                $jangka_waktu_bunga = $jangka_waktu / 3; // Suku bunga per triwulan
                                break;
                            case "semester":
                                $jangka_waktu_bunga = $jangka_waktu / 6; // Suku bunga per semester
                                break;
                            case "tahun":
                                $jangka_waktu_bunga = $jangka_waktu / 12; // Suku bunga per tahun
                                break;
                            default:
                                $jangka_waktu_bunga = 0;
                        }

                        // Menghitung modal awal dengan bunga tunggal
                        $modal_awal = hitungModalAwalTunggal($total_pinjaman, $bunga, $jangka_waktu_bunga);
                        $modal_awal_formatted = number_format($modal_awal, 2, ',', '.');
                        $total_pinjaman_formatted = number_format($total_pinjaman, 2, ',', '.');

                        // Output hasil perhitungan
                        echo '<div class="result">';
                        echo "Total Pinjaman: Rp. $total_pinjaman_formatted<br>";
                        echo "Suku bunga: $bunga%"."/".$suku."<br>";
                        echo "Jangka waktu: $jangka $periode<br>"; 
                        echo "Modal awal: Rp. $modal_awal_formatted<br>";
                        echo '</div>';
                    }
                    ?>
                    <form action="" method="post">
                        <label for="total_pinjaman">Total Pinjaman (Rp)</label><br>
                        <input type="number" name="total_pinjaman" id="total_pinjaman" required><br><br>

                        <label for="bunga">Suku Bunga (%)</label><br>
                        <input type="number" step="0.01" name="bunga" id="bunga" required>

                        <select name="suku" id="suku" required>
                            <option value="bulan">Per Bulan</option>
                            <option value="triwulan">Per Triwulan</option>
                            <option value="semester">Per Semester</option>
                            <option value="tahun">Per Tahun</option>
                        </select><br><br>

                        <label for="jangka">Jumlah Periode</label><br>
                        <input type="number" name="jangka" id="jangka" required>
                        <select name="periode" id="periode" required>
                            <option value="bulan">Bulan</option>
                            <option value="triwulan">Triwulan</option>
                            <option value="semester">Semester</option>
                            <option value="tahun">Tahun</option>
                        </select><br><br>

                        <input type="submit" name="hitung" value="Hitung">
                    </form>
                </div>
                <div>
                    <a href="totalpinjamanamajemuk.php"><input type="submit" value="total bunga majemuk"></a>
                </div>
            </div>
        </main>

        <footer>
            <!-- place footer here -->
        </footer>
        
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4JQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous">
        </script>
    </body>
</html>
