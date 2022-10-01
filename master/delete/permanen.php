<?php  

if ((isset($_GET['id_admin'])) && ($_GET['id_admin'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tb_admin WHERE id_admin=%s",
                       GetSQLValueString($_GET['id_admin'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
  
  pesanlink('Data Absen Ujian Berhasil di hapus','?page=view/admin');
}

 
?>