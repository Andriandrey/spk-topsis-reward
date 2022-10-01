<?php 
require_once('../../logout.php');
require_once('../../restrict.php'); 
require_once('../../Connections/koneksi.php'); 

mysql_select_db($database_koneksi, $koneksi);
$query_rs_profile = "SELECT * FROM tb_admin WHERE id_admin = '".$ID."'";
$rs_profile = mysql_query($query_rs_profile, $koneksi) or die(mysql_error());
$row_rs_profile = mysql_fetch_assoc($rs_profile);
$totalRows_rs_profile = mysql_num_rows($rs_profile); 

?>