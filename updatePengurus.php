<?php

include("conf.php");
include("includes/DB.class.php");
include("includes/BidangDivisi.class.php");
include("includes/Divisi.class.php");
include("includes/Pengurus.class.php");
include("includes/Template.class.php");

// if user clicked edit btn
if (isset($_GET['nim'])) {
    // fetch the pk
    $prevNIM = $_GET['nim'];

    // open the db
    $pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
    $pengurus->open();

    $bidangDivisi = new BidangDivisi($db_host, $db_user, $db_pass, $db_name);
    $bidangDivisi->open();

    $divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
    $divisi->open();

    $pengurus->getDetailPengurus($prevNIM);
    $bidangDivisi->getBidangDivisi();
    $divisi->getDivisi();

    // if user clicked submit btn
    if (isset($_POST['btn-submit'])) {
        // call update method
        $pengurus->updatePengurus($prevNIM, $_POST, $_FILES);
        header("location:index.php");
    }

    // fetch all data from pengurus
    list($nim, $nama, $semester, $image, $id_bidang) = $pengurus->getResult();

    // fetch all data from bidang divisi
    $dataDivisiBidang = null;
    while (list($id_bidang, $jabatan, $id_divisi) = $bidangDivisi->getResult()) {
        $divisi->getDetailDivisi($id_divisi);
        $namaDivisi = $divisi->getResult();

        // create input select option
        $dataDivisiBidang .= "
            <option value=". $id_bidang .">". $jabatan ." - ". $namaDivisi['nama_divisi'] ."</option>
        ";
    }

    // close db
    $pengurus->close();
    $bidangDivisi->close();
    $divisi->close();

    // apply to the template
    $tpl = new Template("templates/pengurus.html");
    $tpl->replace("DATA_BIDANG_DIVISI", $dataDivisiBidang);
    $title = "Edit Pengurus";
    $tpl->replace("DATA_TITLE", $title);
    $tpl->replace("DATA_NIM", $nim);
    $tpl->replace("DATA_NAMA", $nama);
    $tpl->replace("DATA_SEMESTER", $semester);
    $tpl->write();
}

?>