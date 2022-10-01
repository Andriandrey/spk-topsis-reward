<?php 
mysql_select_db($database_koneksi, $koneksi);
$query_rs_kriteria= "SELECT COUNT(*) AS jumlahKriteria FROM tb_kriteria WHERE 1 = 1";
$rs_kriteria= mysql_query($query_rs_kriteria, $koneksi) or die(mysql_error());
$row_rs_kriteria= mysql_fetch_assoc($rs_kriteria);
$totalRows_rs_kriteria= mysql_num_rows($rs_kriteria);

mysql_select_db($database_koneksi, $koneksi);
$query_rs_alternatif = "SELECT COUNT(*) AS jumlahAlternatif FROM tb_alternatif WHERE 1 = 1";
$rs_alternatif = mysql_query($query_rs_alternatif, $koneksi) or die(mysql_error());
$row_rs_alternatif = mysql_fetch_assoc($rs_alternatif);
$totalRows_rs_alternatif = mysql_num_rows($rs_alternatif);


?>