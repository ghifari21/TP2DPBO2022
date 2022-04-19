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

$pengurus->getPengurus();
$data = null;

// fetch all pengurus records
while (list($nim, $nama, $semester, $image, $id_bidang) = $pengurus->getResult()) {
    $bidangDivisi->getDetailBidangDivisi($id_bidang);
    $dataBidangDivisi = $bidangDivisi->getResult();

    $divisi->getDetailDivisi($dataBidangDivisi['id_divisi']);
    $dataDivisi = $divisi->getResult();

    // create card to store detail of pengurus
    $data .= "
        <div class='col-md-3 mb-4 d-flex justify-content-center'>
          <div class='card shadow w-75'>
            <a href='detailPengurus.php?nim=". $nim ."'>
              <img src='./assets/images/". $image ."' class='card-img-top' alt='". $nama ."' />
              <div class='card-body bg-light'>
                <p class='card-text fw-bold my-0'>". $nama ."</p>
                <p class='card-text my-2' style='font-size: 1em; color: rgb(20, 51, 79);'>". $dataDivisi['nama_divisi'] ."</p>
                <p class='card-text my-0' style='font-size: 1em; color: rgb(43, 20, 145);'>". $dataBidangDivisi['jabatan'] ."</p>
              </div>
            </a>
          </div>
        </div>
    ";
}

// close db
$pengurus->close();
$bidangDivisi->close();
$divisi->close();

// apply to the template
$tpl = new Template("templates/index.html");
$tpl->replace("DATA_TABLE", $data);
$tpl->write();

?>