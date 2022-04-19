<?php

include("conf.php");
include("includes/DB.class.php");
include("includes/Pengurus.class.php");

// if user clicked delete btn
if (isset($_GET['nim'])) {
    // fetch the pk
    $nim = $_GET['nim'];
    
    // open the db
    $pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
    $pengurus->open();
    $pengurus->getDetailPengurus($nim);
    $data = $pengurus->getResult();

    // deleting image from target dir
    $targetDir = "./assets/images/";
    $fileTargetDir = $targetDir . $data['image'];
    unlink($fileTargetDir);

    // call delete method
    $pengurus->deletePengurus($nim);
    header("location: index.php");
}

?>