<?php

class Pengurus extends DB {
    // get all records from tPengurus table
    function getPengurus() {
        // create the query
        $query = "SELECT * FROM tPengurus";

        // executing the query
        return $this->execute($query);
    }

    // get a spesific record in tPengurus table
    function getDetailPengurus($nim) {
        // create the query
        $query = "SELECT * FROM tPengurus WHERE nim = $nim";

        // executing the query
        return $this->execute($query);
    }

    // insert a record to tPengurus table
    function insertPengurus($data, $file) {
        // creating dir folder to store the image
        $targetDir = "./assets/images/";
        // fetch the image
        $image = $file['image']['name'];
        $tmpImage = $file['image']['tmp_name'];
        // creating target dir for image
        $fileTargetDir = $targetDir . $image;

        // if the image haven't exists in the dir
        if (!file_exists($fileTargetDir)) {
            // move the file to target dir for image
            $moveUploadedFile = move_uploaded_file($tmpImage, $fileTargetDir);
        }

        // fetch other data
        $nim = $data['nim'];
        $nama = $data['nama'];
        $semester = $data['semester'];
        $id_bidang = $data['bidangDivisi'];

        // create the query
        $query = "INSERT INTO tPengurus VALUES ('$nim', '$nama', '$semester', '$image', '$id_bidang')";
        
        // executing the query
        return $this->execute($query);
    }

    // update a record in tPengurus table
    function updatePengurus($prevNIM, $data, $file) {
        // creating dir folder to store the image
        $targetDir = "./assets/images/";
        // fetch the image
        $image = $file['image']['name'];
        $tmpImage = $file['image']['tmp_name'];
        // creating target dir for image
        $fileTargetDir = $targetDir . $image;

        // if the image haven't exists in the dir
        if (!file_exists($fileTargetDir)) {
            // move the file to target dir for image
            $moveUploadedFile = move_uploaded_file($tmpImage, $fileTargetDir);
        }

        // fetch other data
        $nim = $data['nim'];
        $nama = $data['nama'];
        $semester = $data['semester'];
        $id_bidang = $data['bidangDivisi'];
        
        // create the query
        $query = "UPDATE tPengurus SET nim='$nim', nama='$nama', semester='$semester', image='$image', id_bidang='$id_bidang' WHERE nim='$prevNIM'";

        // executing the query
        return $this->execute($query);
    }

    // delete a record in tPengurus table
    function deletePengurus($nim) {
        // create the query
        $query = "DELETE FROM tPengurus WHERE nim='$nim'";
        
        // executing the query
        return $this->execute($query);
    }
}

?>