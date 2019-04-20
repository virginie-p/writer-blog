<?php

namespace App\entity;

class Entity {
    /**
     * Class constructor which assign values that have been passed in parameters to matching attributes 
     *
     * @param array $donnees The values to allocate
     * @return void
     */
    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    /**
     * Method that allocates specified valued to the matching attributes
     *
     * @param array $donnees The values to allocate
     * @return void
     */
    public function hydrate($data)
    {
      foreach ($data as $key => $value)
      {
        $explodedProperty = explode("_", $key);
        
        for ($i = 0 ; count($explodedProperty) > $i; $i++) {
            $explodedProperty[$i] = ucfirst($explodedProperty[$i]);
        }

        $camelCaseProperty = implode('', $explodedProperty);

        $method = 'set'. $camelCaseProperty;
        
        if (method_exists($this, $method))
        {
          $this->$method($value);
        }
      }
    }
}