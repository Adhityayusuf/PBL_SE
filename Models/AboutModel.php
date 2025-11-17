<?php
    class AboutModel extends Database{
        public function getVisi(){
            $sql = "SELECT data->'visi' AS visi FROM about WHERE title = 'Profil Lab SE'";
            $result = $this->conn->prepare($sql);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC)['visi'];
            return $row ? json_decode($row, true) : null;
        }
        public function getMisi(){
            $sql = "SELECT data->'misi' AS misi FROM about WHERE title = 'Profil Lab SE'";
            $result = $this->conn->prepare($sql);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC)['misi'];
            return $row ? json_decode($row, true) : null;
        }
        public function getTentang(){
            $sql = "SELECT data->'tentang' AS tentang FROM about WHERE title = 'Profil Lab SE'";
            $result = $this->conn->prepare($sql);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC)['tentang'];
            return $row ? json_decode($row, true) : null;
        }

    }
?>