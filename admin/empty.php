<?php 
if ((isset($_GET['reset'])) && ($_GET['reset'] != "")) {
  $deleteSQL1 = "TRUNCATE TABLE tb_kriteria";
  $deleteSQL2 = "TRUNCATE TABLE tb_bobot";
  $deleteSQL3 = "TRUNCATE TABLE tb_alternatif";
  
  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL1, $koneksi) or die(mysql_error());
  
  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL2, $koneksi) or die(mysql_error());
  
  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL3, $koneksi) or die(mysql_error());
  
  if ($Result1) {
  	pesanlink('Nilai berhasil dikosongkan','?page=home');
  }	
}

if ((isset($_GET['kosongkan'])) && ($_GET['kosongkan'] != "")) {
  $updateSQL = sprintf("UPDATE tb_bobot SET nilai_bobot=%s, temp_bobot=%s WHERE 1 = 1",
                       GetSQLValueString(0, "int"),
                       GetSQLValueString(0, "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
  
  $updateSQL2 = sprintf("UPDATE tb_alternatif SET preferentif=%s WHERE 1 = 1",
                       GetSQLValueString(0, "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL2, $koneksi) or die(mysql_error());
  
  if ($Result1) {
  	pesanlink('Nilai berhasil dikosongkan','?page=home');
  }	
}
?> 