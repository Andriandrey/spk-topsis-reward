<?php
if ((isset($_GET['image'])) && ($_GET['image'] != "")) {
  $updateSQL = sprintf("UPDATE tb_posting SET image_posting=%s WHERE id_posting=%s",
                       GetSQLValueString("default.jpg", "text"),
					   GetSQLValueString($_GET['image'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
  
  echo "<script>
  document.location = '?page=informasi/update&post=".$_GET['image']."'</script>";
}

if ((isset($_GET['post'])) && ($_GET['post'] != "")) {
  $updateSQL = sprintf("UPDATE tb_posting SET active_posting=%s WHERE id_posting=%s",
                       GetSQLValueString("N", "text"),
					   GetSQLValueString($_GET['post'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
  
  echo "<script>
  	document.location = '?page=informasi/view&hapus=true';
  </script>";
}
?>