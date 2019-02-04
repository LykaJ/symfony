<?php
namespace Blog\models;

class Comment
{
  private $_id,
          $_author,
          $_content,
          $_date;

  public function __construct(array $data)
  {
    $this->hydrate($data);
  }

  public function hydrate(array $data)
  {
    foreach ($data as $key => $value)
    {
      $method = 'set'.ucfirst($key);

      if(method_exists($this, $method))
      {
        $this->$method($value);
      }
    }
  }

  //SETTERS

  public function setId($id)
  {
    $id = (int) $id;

    if($id > 0)
    {
      $this->_id=$id;
    }
  }
}
