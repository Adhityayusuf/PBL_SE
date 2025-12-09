<?php

require_once __DIR__ . '/../Models/ProfileModel.php';

class HomeController
{
    private $profileModel;

    public function __construct()
    {
        $this->profileModel = new ProfileModel();
    }

    public function index()
    {

        $about_lab = $this->profileModel->getTentangLab();
        $achivement = $this->profileModel->getPrestasi();
        $roadmaps = $this->profileModel->getRoadmaps();
        $personil = $this->profileModel->getPersonil();
        $artikel = $this->profileModel->getArtikel(3);
        $scopes = $this->profileModel->getScopes();
        $customCSS = @file_get_contents(__DIR__ . '/../Views/assets/css/home.css');

        include_once __DIR__ . '/../Views/home.php';
    }
}
