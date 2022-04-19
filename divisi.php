<?php

include("conf.php");
include("includes/DB.class.php");
include("includes/Divisi.class.php");
include("includes/Template.class.php");

// open db
$divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$divisi->open();

$dataNavbar = null;
$dataHeader = null;
$dataContent = null;
$dataForm = null;
$title = "Divisi";

// add divisi
if (!isset($_GET['id_update'], $_GET['id_delete'])) {
    // creating form
    $inputTitle = "Tambah Divisi";
    $dataForm = "
            <div class='mb-3'>
              <label for='nama_divisi' class='form-label'>Nama Divisi</label>
              <input type='text' class='form-control' id='nama_divisi' name='nama_divisi' placeholder='Masukan Nama Divisi...' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-primary' name='btn-submit' id='btn-submit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    // if user clicked submit btn
    if (isset($_POST['btn-submit'])) {
        // fetch all data
        $nama_divisi = $_POST['nama_divisi'];

        // call insert method
        $divisi->insertDivisi($nama_divisi);
        header("location: divisi.php");
    }
}

// if user clicked edit btn
if (isset($_GET['id_update'])) {
    // fetch the pk
    $id_update = $_GET['id_update'];

    // get all data from the record
    $divisi->getDetailDivisi($id_update);
    list($id_divisi, $nama_divisi) = $divisi->getResult();

    // creating form
    $inputTitle = "Edit Divisi";
    $dataForm = "
            <div class='mb-3'>
              <input type='hidden' class='form-control' id='id_divisi' name='id_divisi' value='". $id_divisi ."' />
              <label for='nama_divisi' class='form-label'>Nama Divisi</label>
              <input type='text' class='form-control' id='nama_divisi' name='nama_divisi' value='". $nama_divisi ."' placeholder='Masukan Nama Divisi...' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-primary' name='btn-edit' id='btn-edit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    // if user clicked submit edit btn
    if (isset($_POST['btn-edit'])) {
        // fetch all data
        $id_divisi = $_POST['id_divisi'];
        $nama_divisi = $_POST['nama_divisi'];

        // call update method
        $divisi->updateDivisi($id_divisi, $nama_divisi);
        header("location: divisi.php");
    }
}

// if user clicked delete btn
if (isset($_GET['id_delete'])) {
    // fetch the pk
    $id_divisi = $_GET['id_delete'];

    // call delete method
    $divisi->deleteDivisi($id_divisi);
    header("location: divisi.php");
}

// create navbar
$dataNavbar .= "
            <li class='nav-item'>
                <a class='nav-link' href='bidangDivisi.php'>Bidang Divisi</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link active' href='divisi.php'>Divisi</a>
            </li>
";

// create table header
$dataHeader .= "
            <th scope='col'>No</th>
            <th scope='col'>Nama Divisi</th>
            <th scope='col'>Banyak Pengurus</th>
            <th scope='col'>Action</th>
";

// open db
$tmpDivisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$tmpDivisi->open();
$divisi->getDivisi();
$no = 1;
// fetch all records
while (list($id_divisi, $nama_divisi) = $divisi->getResult()) {
    $tmpDivisi->getCountPengurus($id_divisi);
    $countPengurus = $tmpDivisi->getResult();
    // create table row
    $dataContent .= "
        <tr>
            <th scope='row'>". $no ."</th>
            <td>". $nama_divisi ."</td>
            <td>". $countPengurus['countPengurus'] ."</td>
            <td>
                <a href='divisi.php?id_update=". $id_divisi ."' class='btn btn-primary me-1' name='btn-edit' id='btn-edit'>Edit</a>
                <a href='divisi.php?id_delete=". $id_divisi ."' class='btn btn-danger' name='btn-delete' id='btn-delete'>Delete</a>
            </td>
        </tr>
    ";
    $no++;
}

// close db
$divisi->close();
$tmpDivisi->close();

// apply to the template
$tpl = new Template("templates/table.html");
$tpl->replace("DATA_NAVBAR", $dataNavbar);
$tpl->replace("DATA_TITLE", $title);
$tpl->replace("DATA_INPUT_TITLE", $inputTitle);
$tpl->replace("DATA_INPUT_FORM", $dataForm);
$tpl->replace("DATA_HEADER", $dataHeader);
$tpl->replace("DATA_CONTENT", $dataContent);
$tpl->write();

?>