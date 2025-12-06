<?php
    include_once __DIR__ . '/../Core/Database.php';
    include_once __DIR__ . '/../Models/RecruitmentModel.php';

    class RecruitmentController{
        private $recruitmentModel;
        public function __construct(){
            $this->recruitmentModel = new RecruitmentModel();
        }

        public function index(){
            $recruitmentList = $this->recruitmentModel->getAllMahasiswa();
            include_once __DIR__ . '/../Views/recruitment.php';
        }

        public function addMahasiswa(){
            if(isset($_POST['submit'])){
                $nama = $_POST['nama'];
                $nim = $_POST['nim'];
                $prodi = $_POST['prodi'];
                $angkatan = $_POST['angkatan'];
                $minat = $_POST['minat'];

                $this->recruitmentModel->addMahasiswa($nama, $nim, $prodi, $angkatan);
                header("Location: index.php?action=recruitment");
            }
        }

    }

?>