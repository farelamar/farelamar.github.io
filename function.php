<?php
session_start();
// membuat koneksi ke database
$conn= mysqli_connect("localhost","root","mysql","stokbarang");
// menambah barang baru
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];

    $addtotable = mysqli_query($conn, "insert into stock (namabarang, deskripsi, stok) values ('$namabarang', '$deskripsi', '$stok')");
    if($addtotable){
        header('location:index.php');
    }else{
echo "gagal";
header('location:index.php');
    }

};

// menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    
    $cekstoksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];
    $tambahstoksekarangdenganqty = $stoksekarang + $qty;

    $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty) values('$barangnya','$penerima', '$qty')");
    $updatestok = mysqli_query($conn, "update stock set stok='$tambahstoksekarangdenganqty' where idbarang='$barangnya'");

    if($addtomasuk&&$updatestok){
        header('location:masuk.php');
    }else{
echo "gagal";
header('location:masuk.php');
    }
};

// menambah barang keluar
if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    
    $cekstoksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];
    $tambahstoksekarangdenganqty = $stoksekarang - $qty;

    $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, penerima, qty) values('$barangnya','$penerima', '$qty')");
    $updatestok = mysqli_query($conn, "update stock set stok='$tambahstoksekarangdenganqty' where idbarang='$barangnya'");

    if($addtokeluar&&$updatestok){
        header('location:keluar.php');
    }else{
echo "gagal";
header('location:keluar.php');
    }
};
?>