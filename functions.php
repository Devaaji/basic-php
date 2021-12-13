<?php 

    //database connetion
    $dbconnect = mysqli_connect("localhost", "root", "", "laptops");

    //show data
    function query($query){
        global $dbconnect;

        $result = mysqli_query($dbconnect, $query);
        $rows = [];
        while ( $row = mysqli_fetch_assoc($result) ) {
            $rows[] = $row;
        }
        return $rows;
    }


//create
function tambah($data){
    global $dbconnect;

    $brand = htmlspecialchars ($data["brand"]);
    $processor = htmlspecialchars ($data["processor"]);
    $operating_system = htmlspecialchars ($data["operating_system"]);
    $ram = htmlspecialchars ($data["ram"]);
    $storage = htmlspecialchars ($data["storage"]);
    $Graphics = htmlspecialchars ($data["Graphics"]);
    $harga = htmlspecialchars ($data["harga"]);

    //upload gambar
    $gambar = upload();
    if ( !$gambar ) {
        return false;
    }


    //query insert data
    $query = "INSERT INTO laptop
    VALUES
    ('', '$brand', '$processor', '$operating_system', '$ram', '$storage', '$Graphics', '$harga', '$gambar')";

    mysqli_query($dbconnect, $query);

    return mysqli_affected_rows($dbconnect);

}

//fungsi upload
function upload () {

    $namaFile = $_FILES['gambar']['name'];
    $sizeFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah gambar di upload
    if ( $error === 4 ) {
        echo "<script>
                alert('Masukan Gambar terlebih Dahulu');
                document.location.href = 'tambah.php';
        </script>";
        return false;
    }

    //format gambar tidak boleh yang lain
    $extensiGambarValid = ['jpg', 'jpeg', 'png'];
    $extensiGambar = explode('.', $namaFile);
    $extensiGambar = strtolower(end($extensiGambar));
    if( in_array($extensiGambar, $extensiGambarValid) === false ) {
        echo "<script>
            alert('yang anda ulopad bukan gambar');
            document.location.href = 'tambah.php';
        </script>";
        return false;
    }

    //size gambar harus dibawah 1MB
    if( $sizeFile > 1000000 ){
        echo "<script>
                alert('Ukuran Gambar Max: 1MB');
                document.location.href = 'tambah.php';
        </script>";
        return false;
    }
    //generate nama file
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensiGambar;

    //jika lolos semua dalam pengecekan
    move_uploaded_file($tmpName, 'image/' . $namaFileBaru);

    return $namaFileBaru;

}


//Delete
function hapus($id) {
    global $dbconnect;
    mysqli_query($dbconnect, "DELETE FROM laptop WHERE id = $id");

    return mysqli_affected_rows($dbconnect);
}



//edit
function edit($data) {

    global $dbconnect;

    $id = $data["id"];
    $gambar = htmlspecialchars ($data["gambar"]);
    $brand = htmlspecialchars ($data["brand"]);
    $processor = htmlspecialchars ($data["processor"]);
    $operating_system = htmlspecialchars ($data["operating_system"]);
    $ram = htmlspecialchars ($data["ram"]);
    $storage = htmlspecialchars ($data["storage"]);
    $Graphics = htmlspecialchars ($data["Graphics"]);
    $harga = htmlspecialchars ($data["harga"]);
    $gambarLama = htmlspecialchars ($data["gambarLama"]);

    //cek user pilih gambar atau tiidak
    if ( $_FILES['gambar']['error'] === 4 ){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    

    $query = "UPDATE laptop SET 
        gambar = '$gambar',
        brand = '$brand',
        processor = '$processor',
        operating_system = '$operating_system',
        ram = '$ram',
        storage = '$storage',
        Graphics = '$Graphics',
        harga = '$harga'
        WHERE id = $id
    ";

    mysqli_query($dbconnect, $query);

    return mysqli_affected_rows($dbconnect);

}
//search

function cari($keyword){
    $query = "SELECT * FROM laptop 
    WHERE 
    brand LIKE '%$keyword%' OR 
    processor LIKE '%$keyword%' OR 
    operating_system LIKE '%$keyword%' OR
    ram LIKE '%$keyword%'OR
    storage LIKE '%$keyword%' OR
    Graphics LIKE '%$keyword%'OR
    harga LIKE '%$keyword%' 
    ";

    return query ($query);
}

//membuat register
function registrasi($data){
    //konek database globall
    global $dbconnect;

    $username = strtolower(stripcslashes ($data["username"]));
    $password = mysqli_real_escape_string ($dbconnect, $data["password"]);
    $password2 = mysqli_real_escape_string ($dbconnect, $data["password2"]);

    //cek username ada atau belum
    $result = mysqli_query($dbconnect, "SELECT username FROM user 
                            WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('username sudah terdaftar!');
        </script>";
        return false;
    }

    //cek apa password dan confirm passowrd sama
    if( $password !== $password2 ){
        echo "<script>
            alert('Konfirmasi Password tidak sesuai!');
        </script>";
        return false;
    }
    //enkripsi passwordnya 
    $password = password_hash($password, PASSWORD_BCRYPT);

    //tambah database user
    mysqli_query($dbconnect, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($dbconnect);


}


?>