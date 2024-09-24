<?php
if(isset($_POST['hitung'])){
    $modal = $_POST['modal']; 
    $bunga = $_POST['bunga']; 
    $suku = $_POST['suku']; 
    $periode = $_POST['periode']; 
    $jangka = $_POST['jangka']; 

   
    function hitungBungaTunggal($modal, $bunga, $jangka) {
        $bunga_decimal = $bunga / 100;
        $total_bunga = $modal * $bunga_decimal * $jangka;
        $total_pinjaman = $modal + $total_bunga;
        return $total_pinjaman;
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

    $hasil = hitungBungaTunggal($modal, $bunga, $jangka_waktu_bunga);
    $hasil_formatted = number_format($hasil, 2, ',', '.');

   
    echo "================================================================<br>";
    echo "Modal awal: Rp. ".number_format($modal, 2, ',', '.')."<br>";
    echo "Suku bunga: ".$bunga."%"."/".$suku."<br>";
    echo "Jangka waktu: ".$jangka." ".$periode."<br>"; 
    echo "Total pinjaman setelah bunga: Rp. ".$hasil_formatted."<br>";
    echo "================================================================<br>";
}
?>


<body style="display: flex; flex-direction: column; align-items: center; text-align: center;">
    <h1>SUKU BUNGA TUNGGAL</h1>
    <form action="" method="post">
        <label for="text">Modal Awal (Rp)</label><br>
        <input type="number" name="modal" id="modal" required><br><br>

        <label for="text">Suku Bunga (%)</label><br>
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
</body>
