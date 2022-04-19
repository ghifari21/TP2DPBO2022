<?php

include("conf.php");
include("includes/DB.class.php");
include("includes/BidangDivisi.class.php");
include("includes/Divisi.class.php");
include("includes/Pengurus.class.php");
include("includes/Template.class.php");

// open db
$pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();

$bidangDivisi = new BidangDivisi($db_host, $db_user, $db_pass, $db_name);
$bidangDivisi->open();

$divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$divisi->open();

// call get method
$bidangDivisi->getBidangDivisi();
$divisi->getDivisi();

// if user clicked submit btn
if (isset($_POST['btn-submit'])) {
    // call insert method
    $pengurus->insertPengurus($_POST, $_FILES);
    header("location:index.php");
}

// fetch all records from bidang divisi
$dataBidangDivisi = null;
while (list($id_bidang, $jabatan, $id_divisi) = $bidangDivisi->getResult()) {
    $divisi->getDetailDivisi($id_divisi);
    $namaDivisi = $divisi->getResult();
    
    // create input select option
    $dataBidangDivisi .= "
        <option value='". $id_bidang ."'>". $jabatan ." - ". $namaDivisi['nama_divisi'] ."</option>
    ";
}

// close db
$pengurus->close();
$bidangDivisi->close();
$divisi->close();

// apply to the template
$tpl = new Template("templates/pengurus.html");
$tpl->replace("DATA_BIDANG_DIVISI", $dataBidangDivisi);
$title = "Tambah Pengurus";
$tpl->replace("DATA_TITLE", $title);
$tpl->write();

?>