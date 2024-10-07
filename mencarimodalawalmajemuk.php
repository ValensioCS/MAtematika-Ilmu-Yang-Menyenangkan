<!doctype html>
<html lang="en">
    <head>
        <title>Cari Modal Awal</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

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
            input[type="number"], select, input[type="submit"] {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ced4da;
                border-radius: 5px;
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
                <h1>MODAL AWAL MAJEMUK</h1>
                <?php
                    if (isset($_POST['hitung'])) {
                        $total_pinjaman = $_POST['total_pinjaman']; 
                        $bunga = $_POST['bunga']; 
                        $suku = $_POST['suku']; 
                        $periode = $_POST['periode']; 
                        $jangka = $_POST['jangka']; 
                
                        function cariModalAwal($total_pinjaman, $bunga, $jangka) {
                            $bunga_decimal = $bunga / 100;
                            $modal_awal = $total_pinjaman / pow((1 + $bunga_decimal), $jangka);
                            return $modal_awal;
                        }
                
                        switch ($periode) {
                            case "bulan":
                                $jangka_waktu = $jangka;
                                break;
                            case "triwulan":
                                $jangka_waktu = $jangka * 3;
                                break;
                            case "semester":
                                $jangka_waktu = $jangka * 6;
                                break;
                            case "tahun":
                                $jangka_waktu = $jangka * 12;
                                break;
                            default:
                                $jangka_waktu = 0;
                        }
                
                        switch ($suku) {
                            case "bulan":
                                $jangka_waktu_bunga = $jangka_waktu;
                                break;
                            case "triwulan":
                                $jangka_waktu_bunga = $jangka_waktu / 3;
                                break;
                            case "semester":
                                $jangka_waktu_bunga = $jangka_waktu / 6;
                                break;
                            case "tahun":
                                $jangka_waktu_bunga = $jangka_waktu / 12;
                                break;
                            default:
                                $jangka_waktu_bunga = 0;
                        }
                
                        $hasil_modal_awal = cariModalAwal($total_pinjaman, $bunga, $jangka_waktu_bunga);
                        $hasil_formatted = number_format($hasil_modal_awal, 2, ',', '.');
                
                        echo '<div class="result">';
                        echo "Total Pinjaman: Rp. ".number_format($total_pinjaman, 2, ',', '.')."<br>";
                        echo "Suku bunga: ".$bunga."%"."/".$suku."<br>";
                        echo "Jangka waktu: ".$jangka." ".$periode."<br>"; 
                        echo "Modal Awal yang diperlukan: Rp. ".$hasil_formatted."<br>";
                        echo '</div>';
                    }
                ?>
            
                <form action="" method="post">
                    <label for="total_pinjaman">Total Pinjaman Akhir (Rp)</label><br>
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
                <div>
                    <a href="index.php"><input type="submit" value="total bunga tunggal"></a>
                </div>
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQA
