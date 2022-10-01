<?php  

if ((isset($_GET['id_admin'])) && ($_GET['id_admin'] != "")) {
  /*$deleteSQL = sprintf("DELETE FROM tb_admin WHERE id_admin=%s",
                       GetSQLValueString($_GET['id_admin'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
  
  pesanlink('Data berhasil dihapus!','?page=insert/admin'); */
  
  $updateSQL = sprintf("UPDATE tb_admin SET active_admin=%s, rb=%s WHERE id_admin=%s",
                       GetSQLValueString('N', "text"),
                       GetSQLValueString($ID, "text"),
                       GetSQLValueString($_GET['id_admin'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
  
  pesanlink('Data Berhasil dihapus','?page=insert/admin');
}

if ((isset($_GET['id_menu'])) && ($_GET['id_menu'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tb_menu WHERE id_menu=%s",
                       GetSQLValueString($_GET['id_menu'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
  
  pesanlink('Menu berhasil dihapus!','?page=insert/menu');
}

if ((isset($_GET['id_photo'])) && ($_GET['id_photo'] != "")) {
  if ($_GET['img'] == $row_rs_profile['photo_master']) {
  	pesanlink('Oops! Gambar masih dipakai tidak bisa dihapus','?page=insert/photo');
  }else{
  $deleteSQL = sprintf("DELETE FROM tb_photo WHERE id_photo=%s",
                       GetSQLValueString($_GET['id_photo'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
  
  pesanlink('Photo berhasil dihapus!','?page=insert/photo');
  }
}
?> 