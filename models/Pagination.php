<?php



class Pagination
{
    private $_page;
    private $_perPage;

    public function __construct($data)
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

    public function setPage($page)
    {
        $page = (int) $page;

        if($page > 0)
        {
          $this->_page = $page;
        }
    }

    public function setPerPage($perPage)
    {
        $perPage = (int) $perPage;

        if($page > 0)
        {
            $this->_perPage = $perPage;
        }
    }

    public function page()
    {
        return $page;
    }

    public function perPage()
    {
        return $perPage;
    }

}
