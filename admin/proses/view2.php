<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  for ($a = 1; $a <= $_POST['id_tempbobot']; $a++) {
  $insertSQL = sprintf("UPDATE tb_alternatif SET preferentif=%s WHERE id_alternatif=%s",
                       GetSQLValueString($_POST['name'.$a], "double"),
                       GetSQLValueString($_POST['id_tempbobot'.$a], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  }
  
  echo "
  <script>
  	document.location = '?page=proses/result';
  </script>
  ";
}

mysql_select_db($database_koneksi, $koneksi);
$query_rs_alternatif = "SELECT * FROM tb_alternatif ORDER BY nama_alternatif ASC";
$rs_alternatif = mysql_query($query_rs_alternatif, $koneksi) or die(mysql_error());
$rs_alternatif2 = mysql_query($query_rs_alternatif, $koneksi) or die(mysql_error());
$rs_alternatif3 = mysql_query($query_rs_alternatif, $koneksi) or die(mysql_error());
$rs_alternatif4 = mysql_query($query_rs_alternatif, $koneksi) or die(mysql_error());
$rs_alternatif5 = mysql_query($query_rs_alternatif, $koneksi) or die(mysql_error());
$row_rs_alternatif = mysql_fetch_assoc($rs_alternatif);
$row_rs_alternatif2 = mysql_fetch_assoc($rs_alternatif2);
$row_rs_alternatif3 = mysql_fetch_assoc($rs_alternatif3);
$row_rs_alternatif4 = mysql_fetch_assoc($rs_alternatif4);
$row_rs_alternatif5 = mysql_fetch_assoc($rs_alternatif5);
$totalRows_rs_alternatif = mysql_num_rows($rs_alternatif);


mysql_select_db($database_koneksi, $koneksi);
$query_rs_kriteria = "SELECT id_kriteria, nama_kriteria, bobot_kriteria, keterangan FROM tb_kriteria";
$rs_kriteria = mysql_query($query_rs_kriteria, $koneksi) or die(mysql_error());
$rs_kriteria2 = mysql_query($query_rs_kriteria, $koneksi) or die(mysql_error());
$rs_kriteria3 = mysql_query($query_rs_kriteria, $koneksi) or die(mysql_error());
$rs_kriteria4 = mysql_query($query_rs_kriteria, $koneksi) or die(mysql_error());
$rs_kriteria5 = mysql_query($query_rs_kriteria, $koneksi) or die(mysql_error());
$row_rs_kriteria = mysql_fetch_assoc($rs_kriteria);
$row_rs_kriteria2 = mysql_fetch_assoc($rs_kriteria2);
$row_rs_kriteria3 = mysql_fetch_assoc($rs_kriteria3);
$row_rs_kriteria4 = mysql_fetch_assoc($rs_kriteria4);
$row_rs_kriteria5 = mysql_fetch_assoc($rs_kriteria5);
$totalRows_rs_kriteria = mysql_num_rows($rs_kriteria);
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<p><?php
	pesan('success','<b>Langkah 5 : </b> MENCARI NILAI SOLUSI IDEAL POSITIF (MAKS) DAN SOLUSI IDEAL NEGATIF (MIN)');
?>
</p><form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<div class="table-responsive">
 
<table width="100%" class="table table-striped table-bordered">
<thead>
   <tr bgcolor="#003366">
    <th><span class="style1"></span></th>
     
    <?php do { ?>
    <th bgcolor="#FF6600"><span class="style1"><?php echo $row_rs_kriteria['nama_kriteria']; ?></span></th>
    <?php } while ($row_rs_kriteria = mysql_fetch_assoc($rs_kriteria)); ?>
  </tr>
  </thead>
   <tbody>
    <tr>
      <td>MAX</td>
      <?php do { 
		mysql_select_db($database_koneksi, $koneksi);
		if ($row_rs_kriteria2['keterangan'] == 'B') {
		$query_rs_bobot =  sprintf("SELECT max(temp_bobot) as nilai FROM tb_bobot WHERE kriteria_id = %s", 
										GetSQLValueString($row_rs_kriteria2['id_kriteria'], "int"));
		}else{
		$query_rs_bobot =  sprintf("SELECT min(temp_bobot) as nilai FROM tb_bobot WHERE kriteria_id = %s", 
										GetSQLValueString($row_rs_kriteria2['id_kriteria'], "int"));
		}								
		$rs_bobot = mysql_query($query_rs_bobot, $koneksi) or die(mysql_error());
		$row_rs_bobotmax = mysql_fetch_assoc($rs_bobot);
		$totalRows_rs_bobot = mysql_num_rows($rs_bobot);
		
		$bmax[] = $row_rs_bobotmax['nilai'];
	  ?>
      <td><?php echo $row_rs_bobotmax['nilai']; ?></td>
      <?php } while ($row_rs_kriteria2 = mysql_fetch_assoc($rs_kriteria2)); ?>
    </tr>
    <tr>
      <td>MIN</td>
      <?php do { 
		mysql_select_db($database_koneksi, $koneksi);
		if ($row_rs_kriteria3['keterangan'] == 'B') {
		$query_rs_bobot =  sprintf("SELECT min(temp_bobot) as nilai FROM tb_bobot WHERE kriteria_id = %s", 
										GetSQLValueString($row_rs_kriteria3['id_kriteria'], "int"));
		}else{
		$query_rs_bobot =  sprintf("SELECT max(temp_bobot) as nilai FROM tb_bobot WHERE kriteria_id = %s", 
										GetSQLValueString($row_rs_kriteria3['id_kriteria'], "int"));
		}
		$rs_bobot = mysql_query($query_rs_bobot, $koneksi) or die(mysql_error());
		$row_rs_bobotmin = mysql_fetch_assoc($rs_bobot);
		$totalRows_rs_bobot = mysql_num_rows($rs_bobot);
		$bmin[] = $row_rs_bobotmin['nilai'];
	  ?>
      <td><?php echo $row_rs_bobotmin['nilai']; ?></td>
      <?php } while ($row_rs_kriteria3 = mysql_fetch_assoc($rs_kriteria3)); ?>
    </tr>
  </tbody>
</table>
</div>

<div class="col-md-12">
<p><?php 
 pesan('success','<b>Langkah 6 : </b> MENCARI D+ DAN D- UNTUK SETIAP ALTERNATIF');
 ?> </p>
</div>
<div class="col-md-6">
  <div class="table-responsive">
    <p>D+ </p>
    <table width="100%" class="table table-striped table-bordered">
      <thead>
        <tr bgcolor="#003366">
          <th><span class="style1">NO.</span></th>
          <th><span class="style1">NAMA ALTERNATIF</span></th>
          <th bgcolor="#FF6600"></th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; do { ?>
        <tr>
          <td align="center"><?php echo $no++; ?></td>
          <td><?php echo $row_rs_alternatif3['nama_alternatif']; ?></td>
          <?php 
          $total = 0;
		  $b = 0;
          for ($a = 1; $a <= $totalRows_rs_kriteria; $a++ ) { 
            mysql_select_db($database_koneksi, $koneksi);
            $query_rs_bobot =  sprintf("SELECT temp_bobot FROM tb_bobot WHERE alternatif_id = %s AND kriteria_id = %s", 
                                            GetSQLValueString($row_rs_alternatif3['id_alternatif'], "int"),
                                            GetSQLValueString($a, "int"));
            $rs_bobot = mysql_query($query_rs_bobot, $koneksi) or die(mysql_error());
            $row_rs_bobot = mysql_fetch_assoc($rs_bobot);
            $totalRows_rs_bobot = mysql_num_rows($rs_bobot);
            
          ?>
          <?php $hasil = $row_rs_bobot['temp_bobot'] - $bmax[$b]; 
          $hasilpow = pow($hasil, 2);
          $total += $hasilpow;
		  
          ?>
          <?php $b++; } ?>
          <td><?php echo number_format(sqrt($total),5);?></td>
        </tr>
        <?php } while ($row_rs_alternatif3 = mysql_fetch_assoc($rs_alternatif3)); ?>
      </tbody>
    </table>
  </div>
</div>
<div class="col-md-6">
  <div class="table-responsive">
    <p>D- </p>
    <table width="100%" class="table table-striped table-bordered">
      <thead>
        <tr bgcolor="#003366">
          <th><span class="style1">NO.</span></th>
          <th><span class="style1">NAMA ALTERNATIF</span></th>
          <th bgcolor="#FF6600"></th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1;  do { ?>
        <tr>
          <td align="center"><?php echo $no++; ?></td>
          <td><?php echo $row_rs_alternatif2['nama_alternatif']; ?></td>
          <?php 
          $total= 0;
		  $b = 0;
          for ($a = 1; $a <= $totalRows_rs_kriteria; $a++ ) { 
            mysql_select_db($database_koneksi, $koneksi);
            $query_rs_bobot =  sprintf("SELECT temp_bobot FROM tb_bobot WHERE alternatif_id = %s AND kriteria_id = %s", 
                                            GetSQLValueString($row_rs_alternatif2['id_alternatif'], "int"),
                                            GetSQLValueString($a, "int"));
            $rs_bobot = mysql_query($query_rs_bobot, $koneksi) or die(mysql_error());
            $row_rs_bobot = mysql_fetch_assoc($rs_bobot);
            $totalRows_rs_bobot = mysql_num_rows($rs_bobot);
            
          ?>
          <?php $hasil = $row_rs_bobot['temp_bobot'] - $bmin[$b]; 
          $hasilpow = pow($hasil, 2);
          $total += $hasilpow;
          ?>
          <?php 
		  $b++;
		  } ?>
          <td><?php echo number_format(sqrt($total),5); ?></td>
        </tr>
        <?php } while ($row_rs_alternatif2 = mysql_fetch_assoc($rs_alternatif2)); ?>
      </tbody>
    </table>
  </div>
</div>
<div class="col-md-6">
    <div class="table-responsive">
    <p>Langkah 7 : MENCARI HASIL PREFERENSI</p>
    <table width="100%" class="table table-striped table-bordered">
    <thead>
       <tr bgcolor="#003366">
        <th><span class="style1">NO.</span></th>
        <th><span class="style1">NAMA ALTERNATIF</span></th>         
        <th bgcolor="#FF6600"><span class="style1">PREFERENSI (V)</span></th>
         
       </tr>
        </thead>
      <?php $no = 1; do { ?>
        <tr>
          <td align="center"><?php echo $no; ?></td>
          <td><?php echo $row_rs_alternatif5['nama_alternatif']; ?></td>
          <?php 
          $total = 0;
		  $b = 0;
          for ($a = 1; $a <= $totalRows_rs_kriteria; $a++ ) { 
            mysql_select_db($database_koneksi, $koneksi);
            $query_rs_bobot =  sprintf("SELECT temp_bobot FROM tb_bobot WHERE alternatif_id = %s AND kriteria_id = %s", 
                                            GetSQLValueString($row_rs_alternatif5['id_alternatif'], "int"),
                                            GetSQLValueString($a, "int"));
            $rs_bobot = mysql_query($query_rs_bobot, $koneksi) or die(mysql_error());
            $row_rs_bobot = mysql_fetch_assoc($rs_bobot);
            $totalRows_rs_bobot = mysql_num_rows($rs_bobot);
            
          ?>
          <?php $hasil = $row_rs_bobot['temp_bobot'] - $bmax[$b]; 
          $hasilpow = pow($hasil, 2);
          $total += $hasilpow;
		  
          ?>
          <?php $b++; } ?>
           
          <!--- --->
          <?php 
          $totalx= 0;
		  $b = 0;
          for ($a = 1; $a <= $totalRows_rs_kriteria; $a++ ) { 
            mysql_select_db($database_koneksi, $koneksi);
            $query_rs_bobot =  sprintf("SELECT temp_bobot FROM tb_bobot WHERE alternatif_id = %s AND kriteria_id = %s", 
                                            GetSQLValueString($row_rs_alternatif5['id_alternatif'], "int"),
                                            GetSQLValueString($a, "int"));
            $rs_bobot = mysql_query($query_rs_bobot, $koneksi) or die(mysql_error());
            $row_rs_bobot = mysql_fetch_assoc($rs_bobot);
            $totalRows_rs_bobot = mysql_num_rows($rs_bobot);
            
          ?>
          <?php $hasil = $row_rs_bobot['temp_bobot'] - $bmin[$b]; 
          $hasilpow = pow($hasil, 2);
          $totalx += $hasilpow;
          ?>
          <?php 
		  $b++;
		  } ?>
          <td><div align="center">
            <?php $satu = sqrt($total); $dua = sqrt($totalx);
		  $hasil = $dua / ($dua + $satu);
		   
		  echo number_format($hasil,5); ?>
          </div>
          
          <input type="hidden" name="name<?= $no;?>" value="<?= number_format($hasil,5); ?>" />
          <input type="hidden" name="id_tempbobot<?= $no;?>" value="<?= $no;?>" />
          </td>
        </tr>
        <?php 
		$no++;
		} while ($row_rs_alternatif5 = mysql_fetch_assoc($rs_alternatif5)); ?>
        </tbody>
     </table> 
    </div>
    <p> </p>
</div>

<input type="hidden" name="id_tempbobot" value="<?= $totalRows_rs_alternatif;?>" />
 <input type="submit" value="Simpan dan Lihat Ranking" class="btn btn-danger btn-lg btn-block">
  <input type="hidden" name="MM_update" value="form1" />
  
</form>