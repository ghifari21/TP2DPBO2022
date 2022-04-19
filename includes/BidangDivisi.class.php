<?php

class BidangDivisi extends DB {
    // get all records from tBidangDivisi table
    function getBidangDivisi() {
        // create the query
        $query = "SELECT * FROM tBidangDivisi";

        // executing the query
        return $this->execute($query);
    }

    // get all data from specific record in tBidangDivisi table
    function getDetailBidangDivisi($id_bidang) {
        // create the query
        $query = "SELECT * FROM tBidangDivisi WHERE id_bidang='$id_bidang'";
        
        // executing the query
        return $this->execute($query);
    }

    // insert a record to tBidangDivisi table
    function insertBidangDivisi($jabatan, $id_divisi) {
        // create the query
        $query = "INSERT INTO tBidangDivisi VALUES (null, '$jabatan', '$id_divisi')";
        
        // executing the query
        return $this->execute($query);
    }

    // update a record in tBidangDivisi table
    function updateBidangDivisi($id_bidang, $jabatan, $id_divisi) {
        // create the query
        $query = "UPDATE tBidangDivisi SET jabatan='$jabatan', id_divisi='$id_divisi' WHERE id_bidang='$id_bidang'";

        // executing the query
        return $this->execute($query);
    }

    // delete a record in tBidangDivisi table
    function deleteBidangDivisi($id_bidang) {
        // create the query
        $query = "DELETE FROM tBidangDivisi WHERE id_bidang='$id_bidang'";

        // executing the query
        return $this->execute($query);
    }
}

?>