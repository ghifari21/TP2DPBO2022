<?php

include("conf.php");
include("includes/DB.class.php");
include("includes/BidangDivisi.class.php");
include("includes/Divisi.class.php");
include("includes/Template.class.php");

// create object tables and open the db
$bidangDivisi = new BidangDivisi($db_host, $db_user, $db_pass, $db_name);
$bidangDivisi->open();

$divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$divisi->open();

$dataNavbar = null;
$dataHeader = null;
$dataContent = null;
$dataForm = null;
$dataInputDivisi = null;
$title = "Bidang Divisi";

// get all records from tDivisi and create select option input
$divisi->getDivisi();
while (list($id_divisi, $nama_divisi) = $divisi->getResult()) {
    $dataInputDivisi .= "
        <option value='". $id_divisi ."'>". $nama_divisi ."</option>
    ";
}

// add bidangDivisi
if (!isset($_GET['id_update'], $_GET['id_delete'])) {
    // create form
    $inputTitle = "Tambah Bidang Divisi";
    $dataForm = "
            <div class='mb-3'>
              <label for='jabatan' class='form-label'>Jabatan</label>
              <input type='text' class='form-control' id='jabatan' name='jabatan' placeholder='Masukan Jabatan...' required />
            </div>
            <div class='mb-3'>
              <label for='id_divisi' class='form-label'>Divisi</label>
              <select class='form-select' aria-label='Divisi' id='id_divisi' name='id_divisi' required>
                <option selected disabled>Open this select menu</option>
                DATA_INPUT_DIVISI
              </select>
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-primary' name='btn-submit' id='btn-submit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    // if user clicked submit btn
    if (isset($_POST['btn-submit'])) {
        // fetch all data
        $jabatan = $_POST['jabatan'];
        $id_divisi = $_POST['id_divisi'];
        // call insert method
        $bidangDivisi->insertBidangDivisi($jabatan, $id_divisi);
        header("location: bidangDivisi.php");
    }
}

// if user clicked edit btn
if (isset($_GET['id_update'])) {
    // get all the needed data
    $id_update = $_GET['id_update'];
    $bidangDivisi->getDetailBidangDivisi($id_update);
    list($id_bidang, $jabatan, $id_divisi) = $bidangDivisi->getResult();

    // create form
    $inputTitle = "Edit Bidang Divisi";
    $dataForm = "
            <div class='mb-3'>
              <input type='hidden' class='form-control' id='id_bidang' name='id_bidang' value='". $id_bidang ."' />
              <label for='jabatan' class='form-label'>Jabatan</label>
              <input type='text' class='form-control' id='jabatan' name='jabatan' value='". $jabatan ."' placeholder='Masukan Jabatan...' required />
            </div>
            <div class='mb-3'>
              <label for='id_divisi' class='form-label'>Divisi</label>
              <select class='form-select' aria-label='Divisi' id='id_divisi' name='id_divisi' required>
                <option selected disabled>Open this select menu</option>
                DATA_INPUT_DIVISI
              </select>
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-primary' name='btn-edit' id='btn-edit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    // if user clicked submit edit btn
    if (isset($_POST['btn-edit'])) {
        // fetch all data
        $id_bidang = $_POST['id_bidang'];
        $jabatan = $_POST['jabatan'];
        $id_divisi = $_POST['id_divisi'];
        // call update method
        $bidangDivisi->updateBidangDivisi($id_bidang, $jabatan, $id_divisi);
        header("location: bidangDivisi.php");
    }
}

// if user clicked delete btn
if (isset($_GET['id_delete'])) {
    // fetch the pk
    $id_bidang = $_GET['id_delete'];
    // call delete method
    $bidangDivisi->deleteBidangDivisi($id_bidang);
    header("location: bidangDivisi.php");
}

// create navbar
$dataNavbar .= "
            <li class='nav-item'>
                <a class='nav-link active' href='bidangDivisi.php'>Bidang Divisi</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='divisi.php'>Divisi</a>
            </li>
";

// create header table
$dataHeader .= "
            <th scope='col'>No</th>
            <th scope='col'>Jabatan</th>
            <th scope='col'>Nama Divisi</th>
            <th scope='col'>Action</th>
";

// get all bidangDivisi records and creating table row
$bidangDivisi->getBidangDivisi();
$no = 1;
while (list($id_bidang, $jabatan, $id_divisi) = $bidangDivisi->getResult()) {
    $divisi->getDetailDivisi($id_divisi);
    $dataDivisi = $divisi->getResult();
    $dataContent .= "
        <tr>
            <th scope='row'>". $no ."</th>
            <td>". $jabatan ."</td>
            <td>". $dataDivisi['nama_divisi'] ."</td>
            <td>
                <a href='bidangDivisi.php?id_update=". $id_bidang ."' class='btn btn-primary me-1' name='btn-edit' id='btn-edit'>Edit</a>
                <a href='bidangDivisi.php?id_delete=". $id_bidang ."' class='btn btn-danger' name='btn-delete' id='btn-delete'>Delete</a>
            </td>
        </tr>
    ";
    $no++;
}

// close db
$bidangDivisi->close();
$divisi->close();

// apply to template
$tpl = new Template("templates/table.html");
$tpl->replace("DATA_NAVBAR", $dataNavbar);
$tpl->replace("DATA_TITLE", $title);
$tpl->replace("DATA_INPUT_TITLE", $inputTitle);
$tpl->replace("DATA_INPUT_FORM", $dataForm);
$tpl->replace("DATA_INPUT_DIVISI", $dataInputDivisi);
$tpl->replace("DATA_HEADER", $dataHeader);
$tpl->replace("DATA_CONTENT", $dataContent);
$tpl->write();

?>