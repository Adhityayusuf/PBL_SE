<?php
    class AboutModel extends Database{
        // public function getVisi(){
        //     $sql = "SELECT data->'visi' AS visi FROM about WHERE title = 'Profil Lab SE'";
        //     $result = $this->conn->prepare($sql);
        //     $result->execute();
        //     $row = $result->fetch(PDO::FETCH_ASSOC)['visi'];
        //     return $row ? json_decode($row, true) : null;
        // }

        public function getVisi(){
            $sql = "SELECT isi_konten FROM profile WHERE id_profile = 2";
            $result = $this->conn->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC)['isi_konten'];
            // return $row ? json_decode($row, true) : null;
        }
        // public function getMisi(){
        //     $sql = "SELECT data->'misi' AS misi FROM about WHERE title = 'Profil Lab SE'";
        //     $result = $this->conn->prepare($sql);
        //     $result->execute();
        //     $row = $result->fetch(PDO::FETCH_ASSOC)['misi'];
        //     return $row ? json_decode($row, true) : null;
        // }

        public function getMisi(){
            $sql = "SELECT isi_konten FROM profile WHERE id_profile = 3";
            $result = $this->conn->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC)['isi_konten'];
            // var_dump($row);
            // return $row ? json_decode($row, true) : null;
        }


        // public function updateVisi($visi){
        //     $sql = "UPDATE about SET data = jsonb_set(data, '{visi}', :visi) WHERE title = 'Profil Lab SE'";
        //     $result = $this->conn->prepare($sql);
        //     $result->execute(['visi' => json_encode($visi)]);
        // }
        // public function updateMisi($misi){
        //     $sql = "UPDATE about SET data = jsonb_set(data, '{misi}', :misi) WHERE title = 'Profil Lab SE'";
        //     $result = $this->conn->prepare($sql);
        //     $result->execute(['misi' => json_encode($misi)]);
        // }

    }
?>