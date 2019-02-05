<?php
namespace Blog\models;

/**
*
*/
class Post
{
    private $_errors = [];
    private $_id;
    private $_title;
    private $_content;
    private $_author;
    private $_dateCreation;
    private $_dateEdition;

    const AUTEUR_INVALIDE = 1;
    const TITRE_INVALIDE = 2;
    const CONTENU_INVALIDE = 3;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function isNew()
    {
        return empty($this->_id);
    }

    public function isValid()
    {
        return !(empty($this->_author) || empty($this->_title) || empty($this->_content));
    }

    //SETTERS

    public function setId($id)
    {
        $id = (int) $id;

        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setAuthor($author)
    {
        if (!is_string($author) || empty($author)) {
            $this->_errors[] = self::AUTEUR_INVALIDE;
        } else {
            $this->_author = $author;
        }
    }

    public function setTitle($title)
    {
        if (!is_string($title) || empty($title)) {
            $this->_errors[] = self::TITRE_INVALIDE;
        } else {
            $this->_title = $title;
        }
    }

    public function setContent($content)
    {
        if (!is_string($content) || empty($content)) {
            $this->_errors[] = self::CONTENU_INVALIDE;
        } else {
            $this->_content = $content;
        }
    }

    public function setCreationDate(DateTime $dateCreation)
    {
        $this->_dateCreation = $dateCreation;
    }

    public function setEditionDate(DateTime $dateEdition)
    {
        $this->_dateEdition = $dateEdition;
    }



    //GETTERS
    public function errors()
    {
        return $this->_errors;
    }

    public function id()
    {
        return $this->_id;
    }

    public function author()
    {
        return $this->_author;
    }

    public function title()
    {
        return $this->_title;
    }

    public function content()
    {
        return $this->_content;
    }

    public function dateCreation()
    {
        return $this->_dateCreation;
    }

    public function dateEdition()
    {
        return $this->_dateEdition;
    }
}
