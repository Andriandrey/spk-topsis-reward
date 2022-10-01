<?php  
if ((isset($_GET['id_kriteria'])) && ($_GET['id_kriteria'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tb_kriteria WHERE id_kriteria=%s",
                       GetSQLValueString($_GET['id_kriteria'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());

  pesanlink('Data Kriteria berhasil dihapus','?page=kriteria/view');
}
?> 