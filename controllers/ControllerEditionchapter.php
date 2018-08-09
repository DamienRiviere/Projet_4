<?php
session_start();

require_once('views/View.php');

class ControllerEditionchapter {

    private $_view;
    private $_chapterManager;

    protected $id;

    /**
     * Constructeur ou l'on controle qu'il n'y est pas plusieurs paramètre dans l'URL 
     * et on affiche une exception si c'est le cas
     * sinon on lance la fonction editionChapter
     *
     * @param [type] $url
     */
    public function __construct($url)
    {
        if(isset($url) && count($url) > 1)
        {
            throw new Exception('Page introuvable');
        }
        else if(isset($_GET['deletechapter']))
        {
            $this->id = $_GET['id'];
            $this->deleteChapter($this->id);
        }
        else
        {
            $this->editionChapter();
        }
    }

    /**
     * Fonction qui génère la vue et affiche les données des chapitres
     *
     */
    public function editionChapter()
    {
        $this->_chapterManager = new ChapterManager;
        $chapters = $this->_chapterManager->getChapters();

        $this->_view = new View('Editionchapter');
        $this->_view->generate(array("chapters" => $chapters));
    }

    /**
     * Fonction pour supprimer un chapitre
     *
     * @param [type] $id
     */
    public function deleteChapter($id)
    {
        $this->_chapterManager = new ChapterManager;
        $deleteChapter = $this->_chapterManager->deleteChapter($id);
        header('Location: editionchapter');   
    }

}