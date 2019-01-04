<?php



class Pagination
{
    private $_data;

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

    function fetchResult()
    {
        $resultsValues = $this->_data;
        return $resultsValues;
    }

    function setData($data)
    {
        $data = (int) $data;

        if($data > 0)
        {
            $this->_data = $data;
        }
    }

    function getData()
    {
        return $this->_data;
    }
}
