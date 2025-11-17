<?php
    class BlogModel extends Database {
        public function getAllBlogs(){
            $sql = "SELECT * FROM blogs";
            $result = $this->conn->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>