<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

  $file = feature_image('image_posting');
  if (!empty($file)) {
  $updateSQL = sprintf("UPDATE tb_posting SET title_posting=%s, konten_posting=%s, image_posting=%s, ut_posting=%s, ub_posting=%s, active_posting=%s WHERE id_posting=%s",
                       GetSQLValueString($_POST['title_posting'], "text"),
                       GetSQLValueString($_POST['konten_posting'], "text"),
                       GetSQLValueString($file, "text"),
                       GetSQLValueString($_POST['ut_posting'], "date"),
                       GetSQLValueString($_POST['ub_posting'], "int"),
                       GetSQLValueString($_POST['active_posting'], "text"),
                       GetSQLValueString($_POST['id_posting'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
  
  $insertSQL2 = sprintf("INSERT INTO tb_photoposting (images_photoposting, tanggal_photoposting, ct_photoposting,cb_photoposting,pemilik_photoposting) VALUES (%s,%s, %s, %s, %s)",
						   GetSQLValueString($file, "text"),
						   GetSQLValueString($tglsekarang, "date"),
						   GetSQLValueString($today, "date"),
						   GetSQLValueString($ID, "int"),
						   GetSQLValueString($ID, "int"));
	
	  mysql_select_db($database_koneksi, $koneksi);
	  $Result2 = mysql_query($insertSQL2, $koneksi) or die(mysql_error());
  
  pesan('success','Postingan berhasil diubah dengan mengubah gambar utama');
  }else{
  
  $updateSQL = sprintf("UPDATE tb_posting SET title_posting=%s, konten_posting=%s, ut_posting=%s, ub_posting=%s, active_posting=%s WHERE id_posting=%s",
                       GetSQLValueString($_POST['title_posting'], "text"),
                       GetSQLValueString($_POST['konten_posting'], "text"),
                       //GetSQLValueString($file, "text"),
                       GetSQLValueString($_POST['ut_posting'], "date"),
                       GetSQLValueString($_POST['ub_posting'], "int"),
                       GetSQLValueString($_POST['active_posting'], "text"),
                       GetSQLValueString($_POST['id_posting'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
  
  pesan('success','Postingan berhasil diubah tanpa mengubah gambar utama');
  }
}

$colname_rs_posting = "-1";
if (isset($_GET['post'])) {
  $colname_rs_posting = $_GET['post'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_posting = sprintf("SELECT * FROM tb_posting WHERE id_posting = %s", GetSQLValueString($colname_rs_posting, "int"));
$rs_posting = mysql_query($query_rs_posting, $koneksi) or die(mysql_error());
$row_rs_posting = mysql_fetch_assoc($rs_posting);
$totalRows_rs_posting = mysql_num_rows($rs_posting);
?>

<a href="?page=informasi/view" class="btn btn-primary"><span class="fa fa-arrow-left"></span> Kembali</a><br />
<br />

<?php title('warning','Update Posting','Silahkan perbaharui postingan di sini'); ?>
<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="100%" height="295">
    <tr valign="baseline">
      <td colspan="3"><div align="left"><strong>Title</strong></div>
      <input type="text" name="title_posting" value="<?php echo htmlentities($row_rs_posting['title_posting'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td colspan="3"><div align="left"><strong>Konten</strong></div>
      <textarea name="konten_posting" id="editor1" cols="45" rows="5">
      	<?php echo htmlentities($row_rs_posting['konten_posting'], ENT_COMPAT, 'utf-8'); ?>
      </textarea></td>
    </tr>
    <tr valign="baseline">
      <td width="43%"><div align="left"><strong>Image</strong></div>
      <input name="image_posting" type="file" class="form-control input-sm" size="32"/><br>
      <div class="col-md-12">
      <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modal-primary"> Ambil Gambar dari Galeri</button>
      </div>      <br>

      
      </td>

      
      <td width="4%">&nbsp;</td>
      <td width="53%"><div align="left"><strong>Gambar Sebelumnya</strong></div>
      <?php if (!empty($row_rs_posting['image_posting'])) { ?>
	  	<img src="../feature_images/<?php echo htmlentities($row_rs_posting['image_posting'], ENT_COMPAT, 'utf-8'); ?>" class="img-responsive" width="300px">
        <a href="?page=informasi/delete&image=<?= $row_rs_posting['id_posting']; ?>" >Hapus Gambar</a>
      <?php }else{ ?>  
       <img src="../feature_images/default.jpg" class="img-responsive" width="300px">
      <?php } ?>     
      <br />
      
 </td>
    </tr>
    <tr valign="baseline">
      <td colspan="3"><div align="left"><strong>Status</strong></div>
        <select name="active_posting" class="form-control input-sm">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_posting['active_posting'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Posting</option>
        <option value="P" <?php if (!(strcmp("P", htmlentities($row_rs_posting['active_posting'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Daftar</option>
         
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td height="48" colspan="3" valign="middle"><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="ut_posting" value="<?php echo htmlentities($row_rs_posting['ut_posting'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="ub_posting" value="<?php echo htmlentities($row_rs_posting['ub_posting'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_posting" value="<?php echo $row_rs_posting['id_posting']; ?>" />
</form> 


<!-- INI MODAL -->
 		<div class="modal modal-default fade" id="modal-primary">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Galeri Gambar Posting</h4>
              </div>
              <div class="modal-body">
                <div class="box-body">
 					<?php require_once('galeri.php'); ?> 
                </div>
              </div>
               
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->