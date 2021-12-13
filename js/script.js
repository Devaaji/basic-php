//ambil element dulu

var keyword = document.getElementById('keyword');
var tombolCari = document.getElementById('tombol-cari');
var container = document.getElementById('container');


//tambahkan event ketika keyword ditulis

keyword.addEventListener('keyup', function() {
    // console.log(keyword.value);

    //buat objet ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajaxnya
    xhr.onreadystatechange = function () {
        if( xhr.readyState == 4 && xhr.status == 200 ) {
            container.innerHTML = xhr.responseText;
        }
    }

    // eksekusi ajax
    xhr.open('GET', 'ajax/ajax.php?keyword=' + keyword.value, true);
    xhr.send();

})