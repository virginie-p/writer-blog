<?php

namespace App;

class Autoloader
{

  /**
   * Enregistre notre autoloader
   */
  static function register(){
      spl_autoload_register(array(__CLASS__, 'autoload'));
  }

  /**
   * Inclue le fichier correspondant à notre classe
   * @param $class string Le nom de la classe à charger
   */
  static function autoload($class){
      if (strpos($class, __NAMESPACE__ . '\\') === 0){
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
        require(__DIR__ . '\\' . $class . '.php');
      }
  }

}