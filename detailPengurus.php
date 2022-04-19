<?php

include("conf.php");
include("includes/DB.class.php");
include("includes/BidangDivisi.class.php");
include("includes/Divisi.class.php");
include("includes/Pengurus.class.php");
include("includes/Template.class.php");

// if user clicked specific pengurus
if (isset($_GET['nim'])) {
    // open db
    $pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
    $pengurus->open();
    
    $bidangDivisi = new BidangDivisi($db_host, $db_user, $db_pass, $db_name);
    $bidangDivisi->open();
    
    $divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
    $divisi->open();
    
    // get all data from specific row
    $pengurus->getDetailPengurus($_GET['nim']);
    list($nim, $nama, $semester, $image, $id_bidang) = $pengurus->getResult();

    // get all data
    $bidangDivisi->getDetailBidangDivisi($id_bidang);
    $dataBidangDivisi = $bidangDivisi->getResult();

    $divisi->getDetailDivisi($dataBidangDivisi['id_divisi']);
    $dataDivisi = $divisi->getResult();

    // creating card to store detail of pengurus
    $data = null;
    $data .= "
         <div class='row justify-content-between'>
            <div class='col-md-4'>
              <div class='card bg-black'>
                <img class='m-auto' src='./assets/images/". $image ."' alt='". $nama ."' width='100%' />
              </div>
            </div>
            <div class='col-md-8'>
              <div class='card'>
                <div class='card-body'>
                  <table class='text-start'>
                    <tr>
                      <th scope='row' class='w-25'>NIM</th>
                      <td>: ". $nim ."</td>
                    </tr>
                    <tr>
                      <th scope='row'>Nama</th>
                      <td>: ". $nama ."</td>
                    </tr>
                    <tr>
                      <th scope='row'>Semester</th>
                      <td>: ". $semester ."</td>
                    </tr>
                    <tr>
                      <th scope='row'>Divisi</th>
                      <td>: ". $dataDivisi['nama_divisi'] ."</td>
                    </tr>
                    <tr>
                      <th scope='row'>Jabatan</th>
                      <td>: ". $dataBidangDivisi['jabatan'] ."</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
        </div>
        <div class='float-end'>
          <a href='updatePengurus.php?nim=". $nim ."' class='btn btn-primary'>Edit</a>
          <a href='deletePengurus.php?nim=". $nim ."' class='btn btn-danger ms-1'>Delete</a>
        </div>
    ";

    // close db
    $pengurus->close();
    $bidangDivisi->close();
    $divisi->close();

    // apply to the template
    $tpl = new Template("templates/detailPengurus.html");
    $tpl->replace("DATA_PENGURUS", $data);
    $tpl->write();
}

?>