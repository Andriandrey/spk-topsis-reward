<?php   
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  for ($a = 1; $a <= $_POST['id_tempbobot']; $a++) {
  $insertSQL = sprintf("UPDATE tb_bobot SET temp_bobot=%s WHERE id_bobot=%s",
                       GetSQLValueString($_POST['name'.$a], "double"),
                       GetSQLValueString($_POST['id_tempbobot'.$a], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  }
  
  echo "
  <script>
  	document.location = '?page=proses/view2';
  </script>
  ";
}

mysql_select_db($database_koneksi, $koneksi);
$query_rs_alternatif = "SELECT * FROM tb_alternatif ORDER BY nama_alternatif ASC";
$rs_alternatif = mysql_query($query_rs_alternatif, $koneksi) or die(mysql_error());
$rs_alternatif2 = mysql_query($query_rs_alternatif, $koneksi) or die(mysql_error());
$rs_alternatif3 = mysql_query($query_rs_alternatif, $koneksi) or die(mysql_error());
$rs_alternatif4 = mysql_query($query_rs_alternatif, $koneksi) or die(mysql_error());
$row_rs_alternatif = mysql_fetch_assoc($rs_alternatif);
$row_rs_alternatif2 = mysql_fetch_assoc($rs_alternatif2);
$row_rs_alternatif3 = mysql_fetch_assoc($rs_alternatif3);
$row_rs_alternatif4 = mysql_fetch_assoc($rs_alternatif4);
$totalRows_rs_alternatif = mysql_num_rows($rs_alternatif);


mysql_select_db($database_koneksi, $koneksi);
$query_rs_kriteria = "SELECT id_kriteria, nama_kriteria, bobot_kriteria, keterangan FROM tb_kriteria";
$rs_kriteria = mysql_query($query_rs_kriteria, $koneksi) or die(mysql_error());
$rs_kriteria2 = mysql_query($query_rs_kriteria, $koneksi) or die(mysql_error());
$rs_kriteria3 = mysql_query($query_rs_kriteria, $koneksi) or die(mysql_error());
$row_rs_kriteria = mysql_fetch_assoc($rs_kriteria);
$row_rs_kriteria2 = mysql_fetch_assoc($rs_kriteria2);
$row_rs_kriteria3 = mysql_fetch_assoc($rs_kriteria3);
$totalRows_rs_kriteria = mysql_num_rows($rs_kriteria);
?>

<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<div class="table-responsive">
<p><?php 
 pesan('success','<b>Langkah 2 : </b> MEMBUAT MATRIKS PERBANDINGAN ALTERNATIF DAN KRITERIA');
 ?> </p>
<table width="100%" class="table table-striped table-bordered">
<thead>
   <tr bgcolor="#003366">
    <th><span class="style1">NO.</span></th>
    <th><span class="style1">NAMA ALTERNATIF</span></th>
    <?php do { ?>
    <th bgcolor="#FF6600"><span class="style1"><?php echo $row_rs_kriteria['nama_kriteria']; ?></span></th>
    <?php } while ($row_rs_kriteria = mysql_fetch_assoc($rs_kriteria)); ?>
  </tr>
    </thead>
   <tbody>
  <?php $no = 1; do { ?>
    <tr>
      <td align="center"><?php echo $no++; ?></td>
      <td><?php echo $row_rs_alternatif['nama_alternatif']; ?></td>
      <?php for ($a = 1; $a <= $totalRows_rs_kriteria; $a++ ) { 
		mysql_select_db($database_koneksi, $koneksi);
		$query_rs_bobot =  sprintf("SELECT nilai_bobot FROM tb_bobot WHERE alternatif_id = %s AND kriteria_id = %s", 
										GetSQLValueString($row_rs_alternatif['id_alternatif'], "int"),
										GetSQLValueString($a, "int"));
		$rs_bobot = mysql_query($query_rs_bobot, $koneksi) or die(mysql_error());
		$row_rs_bobot = mysql_fetch_assoc($rs_bobot);
		$totalRows_rs_bobot = mysql_num_rows($rs_bobot);
	  ?>
	  <td><?php echo $row_rs_bobot['nilai_bobot']; ?></td>
      <?php } ?>
    </tr>
    <?php } while ($row_rs_alternatif = mysql_fetch_assoc($rs_alternatif)); ?>
    <tr>
      <td colspan="2" align="right"><strong>HASIL PEMBAGI</strong></td>
      <?php for ($a = 1; $a <= $totalRows_rs_kriteria; $a++ ) { 
	    $query_rs_bobotx =  sprintf("SELECT nilai_bobot FROM tb_bobot WHERE kriteria_id = %s", GetSQLValueString($a, "int"));
		$rs_bobotx = mysql_query($query_rs_bobotx, $koneksi) or die(mysql_error());
		$row_rs_bobotx = mysql_fetch_assoc($rs_bobotx);
		$totalRows_rs_bobotx = mysql_num_rows($rs_bobotx);
	  
	  ?>
      <td>
	  <?php 
	  $nilai = 0;
	  do { ?>
	  <?php 
	  	$nilai = $nilai + pow($row_rs_bobotx['nilai_bobot'],2); 
		//echo $pow = pow($row_rs_bobotx['nilai_bobot'],2) ; 
	  ?>
      <?php } while ($row_rs_bobotx = mysql_fetch_assoc($rs_bobotx)); 
	  $hasil = sqrt($nilai);
	  echo $ok = number_format($hasil,5);
	  $arr_hasil[] = $hasil;
	  ?>
      </td>
      <?php } ?>
    </tr>
    </tbody>
 </table> 
 
 
<p><?php 
 pesan('success','<b>Langkah 3 : </b> MEMBUAT MATRIKS KEPUTUSAN TERNORMALISASI');
 ?></p>
<table width="100%" class="table table-striped table-bordered">
  <thead>
    <tr bgcolor="#003366">
      <th><span class="style1">NO.</span></th>
      <th><span class="style1">NAMA ALTERNATIF</span></th>
      <?php do { ?>
      <th bgcolor="#FF6600"><span class="style1"><?php echo $row_rs_kriteria2['nama_kriteria']; ?></span></th>
      <?php } while ($row_rs_kriteria2 = mysql_fetch_assoc($rs_kriteria2)); ?>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; do { ?>
    <tr>
      <td align="center"><?php echo $no++; ?></td>
      <td><?php echo $row_rs_alternatif2['nama_alternatif']; ?></td>
      <?php 
	    $b = 0;
		for ($a = 1; $a <= $totalRows_rs_kriteria; $a++ ) { 
	    
		mysql_select_db($database_koneksi, $koneksi);
		$query_rs_bobot =  sprintf("SELECT nilai_bobot FROM tb_bobot WHERE alternatif_id = %s AND kriteria_id = %s", 
										GetSQLValueString($row_rs_alternatif2['id_alternatif'], "int"),
										GetSQLValueString($a, "int"));
		$rs_bobot = mysql_query($query_rs_bobot, $koneksi) or die(mysql_error());
		$row_rs_bobot = mysql_fetch_assoc($rs_bobot);
		$totalRows_rs_bobot = mysql_num_rows($rs_bobot);	
	  ?>
      <td><?php 
	  $hasil_step3 = $row_rs_bobot['nilai_bobot'] / $arr_hasil[$b]; 
	  echo number_format($hasil_step3, 5);
	  $arr_step3[] = $hasil_step3;
	  
	  ?></td>
      <?php 
	  	$b++;
	   } ?>
    </tr>
    <?php } while ($row_rs_alternatif2 = mysql_fetch_assoc($rs_alternatif2)); ?>
  </tbody>
</table>
<p><?php 
 pesan('success','<b>Langkah 4 : </b> MENGHITUNG MATRIKS KEPUTUSAN TERNORMALISASI DAN TERBOBOT');
 ?></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<table width="100%" class="table table-striped table-bordered">
  <thead>
    <tr bgcolor="#003366">
      <th><span class="style1">NO.</span></th>
      <th><span class="style1">NAMA ALTERNATIF</span></th>
      <?php do { ?>
      <?php $arr_bobot[] = $row_rs_kriteria3['bobot_kriteria']; ?>
      <th bgcolor="#FF6600"><span class="style1"><?php echo $row_rs_kriteria3['nama_kriteria']; ?></span></th>
      <?php } while ($row_rs_kriteria3 = mysql_fetch_assoc($rs_kriteria3)); ?>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; $total = 0; do { ?>
    <tr>
      <td align="center"><?php echo $no; ?></td>
      <td><?php echo $row_rs_alternatif3['nama_alternatif']; ?></td>
      <?php 
	    $b = 0;
		for ($a = 1; $a <= $totalRows_rs_kriteria; $a++ ) { 
	    
		mysql_select_db($database_koneksi, $koneksi);
		$query_rs_bobot =  sprintf("SELECT nilai_bobot FROM tb_bobot WHERE alternatif_id = %s AND kriteria_id = %s", 
										GetSQLValueString($row_rs_alternatif3['id_alternatif'], "int"),
										GetSQLValueString($a, "int"));
		$rs_bobot = mysql_query($query_rs_bobot, $koneksi) or die(mysql_error());
		$row_rs_bobot = mysql_fetch_assoc($rs_bobot);
		$totalRows_rs_bobot = mysql_num_rows($rs_bobot);	
		
		$hasil_step3 = $row_rs_bobot['nilai_bobot'] / $arr_hasil[$b]; 
	    $hasil_step4 = $hasil_step3 * $arr_bobot[$b];
		$arr[] = $hasil_step4;
 	  ?>
      <td><?= number_format($hasil_step4,5); ?> 
      <input type="hidden" name="id_tempbobot" value="<?= count($arr);?>" />
      <input type="hidden" name="name<?= count($arr);?>" value="<?= number_format($hasil_step4,5); ?>" />
      <input type="hidden" name="id_tempbobot<?= count($arr);?>" value="<?= count($arr);?>" />
      
        </td>
      <?php 
	  $b++;
	  } ?>
      
    </tr>
    <?php 
	$no++;
	$total++; 
	} while ($row_rs_alternatif3 = mysql_fetch_assoc($rs_alternatif3)); ?>
  </tbody>
</table>
<input type="submit" value="Simpan dan Lihat Nilai Preferentif (V)" class="btn btn-danger btn-lg btn-block">
  <input type="hidden" name="MM_update" value="form1" />
  
</form> 
<p></p>
 <p></p>
</div>