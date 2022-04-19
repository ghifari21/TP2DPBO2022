<?php

class Divisi extends DB {
    // get all records from tDivisi table
    function getDivisi() {
        // create the query
        $query = "SELECT * FROM tDivisi";
        
        // executing the query
        return $this->execute($query);
    }

    // get all data from specific record in tDivisi
    function getDetailDivisi($id_divisi) {
        // create the query
        $query = "SELECT * FROM tDivisi WHERE id_divisi='$id_divisi'";

        // executing the query
        return $this->execute($query);
    }

    // insert a record to tDivisi table
    function insertDivisi($namaDivisi) {
        // create the query
        $query = "INSERT INTO tDivisi VALUES (null, '$namaDivisi')";
        
        // executing the query
        return $this->execute($query);
    }

    // update a record in tDivisi table
    function updateDivisi($id_divisi, $namaDivisi) {
        // create the query
        $query = "UPDATE tDivisi SET nama_divisi='$namaDivisi' WHERE id_divisi='$id_divisi'";
        
        // executing the query
        return $this->execute($query);
    }

    // delete a record in tDivisi record
    function deleteDivisi($id_divisi) {
        // create the query
        $query = "DELETE FROM tDivisi WHERE id_divisi='$id_divisi'";
        
        // executing the query
        return $this->execute($query);
    }

    // get how many pengurus
    function getCountPengurus($id_divisi) {
        // create the query
        $query = "SELECT COUNT(nim) AS countPengurus FROM tPengurus WHERE id_bidang IN (SELECT id_bidang FROM tBidangDivisi WHERE id_divisi='$id_divisi')";
        
        // executing query
        return $this->execute($query);
    }
}

?>