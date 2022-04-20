<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "sistem_pkl_smk_4");


function query($data) {
	global $conn;
	$result = mysqli_query($conn, $data);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function hapus($query) {
	global $conn;
	$delete = mysqli_query($conn, $query);
	// mengembalikan nilai rows
	return mysqli_affected_rows($conn); 
}

function upload_foto() {
    $nama_file = $_FILES['foto']['name'];
    $ukuran_file = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $target_dir = "../../img/siswa/";

    // cek file yang di upload
    $ekstensi_foto_valid = ['jpg','jpeg','png'];
    $ekstensi_foto = explode('.', $nama_file);
    $ekstensi_foto = strtolower(end($ekstensi_foto));
    if ( $error === 4 ) {
        echo "<script>
                alert('Data berhasil di tambahkan!');
                document.location.href = '../../admin/siswa.php';
            </script>" ;
            return false;
    }
    if ( !in_array($ekstensi_foto, $ekstensi_foto_valid ) ) {
        echo "<script>
                alert('Yang anda upload bukan gambar');
                document.location.href = '../../admin/siswa.php';
            </script>" ;
            return false;
    }
    // cek ukuran foto 
    if ( $ukuran_file < 1 ) {
        echo "<script>
                alert('Ukuran terlalu besar!');
                document.location.href = '../../admin/siswa.php';
            </script>" ;
            return false;
    }

    // generate nama file baru
    $nama_file_baru = "foto-";
    $nama_file_baru .= uniqid();
    $nama_file_baru .= ".";
    $nama_file_baru .= $ekstensi_foto;

    // lulus pengecekan, pindahkan file ke direktori yang di inginkan
    if(move_uploaded_file($tmp_name, $target_dir.$nama_file_baru)) {
        return $nama_file_baru;
    } else {
        return "NULL";
    }  
}

function tambah_siswa($data) {
	global $conn;

	// ambil data yang di inputkan di form 
    $nama_siswa = htmlspecialchars($data["nama_siswa"]);
    $umur = htmlspecialchars($data["umur"]);
    $jurusan_siswa = htmlspecialchars($data["jurusan_siswa"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    
    // upload gambar
    $foto = upload_foto();
    if (!$foto) {
    	$foto = "NULL";
    }

    // menyusun query ke dalam string
    $query = "INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `umur`, `jurusan_siswa`, `id_perusahaan`, `username`, `password`, `foto`)
                VALUES
            ('', '$nama_siswa', '$umur', '$jurusan_siswa', NULL, '$username', '$password', '$foto')";
    // query memasukkan data ke table siswa
    mysqli_query($conn, $query); 

    return mysqli_affected_rows($conn);

}

function edit_data_siswa($data) {
	global $conn;

	// ambil data yang di inputkan di form
	
    $id_siswa = $data['id_siswa']; 
    $nama_siswa = htmlspecialchars($data["nama_siswa"]);
    $umur = htmlspecialchars($data["umur"]);
    $jurusan_siswa = htmlspecialchars($data["jurusan_siswa"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $foto_lama = $data['foto_lama'];

    // cek apakah user pilih gambar baru atau tidak
    if ( $_FILES['foto']['error'] === 4 ) {
        $foto = $foto_lama;
    } else {
        $foto = upload_foto();
    }
    

    // menyusun query ke dalam string
    $query = "UPDATE siswa SET
                nama_siswa = '$nama_siswa',
                umur = '$umur',
                jurusan_siswa = '$jurusan_siswa',
                username = '$username',
                password = '$password',
                foto = '$foto'
            WHERE id_siswa = $id_siswa
                ";
    // query memasukkan data ke table siswa
    mysqli_query($conn, $query); 

    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    global $conn;
    $result_perusahaan = mysqli_query($conn, "SELECT * FROM perusahaan WHERE nama_perusahaan LIKE '%$keyword%'");
    $fetch_perusahaan = mysqli_fetch_assoc($result_perusahaan);
    $id_perusahaan = $fetch_perusahaan['id_perusahaan'];
    $query = "SELECT * FROM siswa
                WHERE
            nama_siswa LIKE '%$keyword%' OR
            umur LIKE '%$keyword%' OR
            jurusan_siswa LIKE '%$keyword%' OR
            username LIKE '%$keyword%' OR
            id_perusahaan LIKE '$id_perusahaan'
    ";
    return query($query);
}


?>