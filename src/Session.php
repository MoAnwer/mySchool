<?php

  class Session {

    public function __construct()  {
      session_start();
    }
    
    public function __get($name) {
      return $this->session[$name];
    }

    public function __set($name, $value) {
       $this->session[$name] = $value;
    }

    public static function get(string $value) : string {
      return $_SESSION[$value] ?? 'Unknown Key';
    }

    public static function set(string $key, mixed $value) : void {

      $_SESSION[$key] = $value;

    }

    public static function all() {

      return $_SESSION;

    }

    public static function has(string $key) : bool {

      if (isset($_SESSION[$key])) {

        return true;

      } else {

        return false;
        
      }
    }

    public static function forget(string $key) {

      unset($_SESSION[$key]);

    }

    public static function destroy() {

      unset($_SESSION);
      session_destroy();

    }

  }