<?php 
// menghubungkan ke file function
require '../../function/function.php';
// ambil data di url
$id_siswa = $_GET['id_siswa'];

$delete_siswa = hapus("DELETE FROM siswa WHERE id_siswa = '$id_siswa'");

if ($delete_siswa > 0) {
	echo "<script>
		alert('Data berhasil di hapus');
		document.location.href = '../../admin/siswa.php';
	</script>";
} else {
	echo "<script>
		alert('Data gagal di hapus');
		document.location.href = '../../admin/siswa.php';
	</script>";
}

?>