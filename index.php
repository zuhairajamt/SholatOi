<?php
$url = file_get_contents('https://api.myquran.com/v1/sholat/kota/semua');
$data = json_decode($url, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SholatOI</title>
    <link rel="stylesheet" href="stylesheet.css" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
</head>

<body>
    <div class="header">
        <a href="" class="logo"><img src="assets/Masjid.png" alt="gambar_masjid"></a>
        <div class="header-right">
          <a class="active" href="#home">Home</a>
          <a href="#sholat">Jadwal Sholat</a>
          <a href="#quran">Al-Qur'an</a>
        </div>
      </div>
      
      <div class="judul" id="home">
        <h2>SholatOi</h2>
        <p>Mencari jadwal sholat dengan mudah</p>
        <p>Membaca Al-Qur'an agar dapat pahala</p>
      </div>
      
      <!-- BAGIAN JADWAL SHOLAT -->
      <div id="sholat">
        <h3>Pilih Lokasi</h3>
        <form method="get">
          <div class="form-sholat">
            <select name="city" id="city">
            <option id="search"></option>
            <?php foreach($data as $city):?>
              <option value=" <?php echo $id= $city['id']?> "> <?php echo $city['lokasi']; ?> </option> 
              <?php $id = $_GET['city']; ?>
            <?php endforeach;?>
            </select>
            <button type="submit" class="tombol"> Cari </button>
            <div id="resultkota"></div> 
          </div>
        </form>
      </div>

      <?php
       $tanggal = date("Y/m/d");
        // echo $id . "<br>";
        $idbaru = trim($id," "); // menghapus spasi dari isi id lama
        //$urlk = file_get_contents('https://api.myquran.com/v1/sholat/jadwal/1638/'.$tanggal);      id surabaya
        $urlk = file_get_contents('https://api.myquran.com/v1/sholat/jadwal/'.$idbaru.'/'.$tanggal);
        $datak = json_decode($urlk, true);
    
        error_reporting(0); // menyembunyikan pesan error waktu user belum memilih kota
        
        $imsak = $datak['data']['jadwal']['imsak'];
        $subuh = $datak['data']['jadwal']['subuh'];
        $terbit = $datak['data']['jadwal']['terbit'];
        $dzuhur = $datak['data']['jadwal']['dzuhur'];
        $ashar = $datak['data']['jadwal']['ashar'];
        $maghrib = $datak['data']['jadwal']['maghrib'];
        $isya = $datak['data']['jadwal']['isya'];
      ?>

      <table style="width:80%">
        <tr>
          <th>Jadwal</th>
          <th>pukul</th>
        </tr>
        <tr>
          <td>Imsak</td>
          <td><?=$imsak?></td>
        </tr>
        <tr>
          <td>Subuh</td>
          <td><?=$subuh?></td>
        </tr>
        <tr>
          <td>Terbit</td>
          <td><?=$terbit?></td>
        </tr>
        <tr>
          <td>Dzuhur</td>
          <td><?=$dzuhur?></td>
        </tr>
        <tr>
          <td>Ashar</td>
          <td><?=$ashar?></td>
        </tr>
        <tr>
          <td>Maghrib</td>
          <td><?=$maghrib?></td>
        </tr>
        <tr>
          <td>Isya</td>
          <td><?=$isya?></td>
        </tr>
      </table>
      
      <!-- BAGIAN AL QURAN -->
      <div class="quran" id="quran">
        <h2>Menampilkan acak ayat surat</h2>
      <?php 
        $url = file_get_contents('https://api.banghasan.com/quran/format/json/acak');
        $data = json_decode($url, true);
        
        echo "Surat ke- ";
        echo $data['acak']['id']['surat'];
        echo " Ayat ke- ";
        echo $data['acak']['id']['ayat'];
        echo "<br> <br>";
        echo $data['surat']['nama'];
        echo "<br> <br>";
        echo $data['acak']['ar']['teks'];
        echo "<br>";
        echo $data['acak']['id']['teks'];
        echo "<br> <br>";
        echo "Keterangan <br>";
        echo $data['surat']['keterangan'];
      ?>
      </div>





 <script type="text/javascript">
 // menampilkan id kota waktu diklik
 $('#city').on('change',function(){ 
   $('#resultkota').html($(this).val());   
 });
 //bagian select2
 $(document).ready(function() {
     $('#city').select2();
 });
 $(document).ready(function() {
     $('#city').select2({
      placeholder: 'Pilih kab/kota',
      allowClear: true
     });
 });
</script>

</body>
</html>
