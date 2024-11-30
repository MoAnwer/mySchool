<?php


class User extends Model {
  
  /**
   * login process and set sessions with username and password.
   * @param string $username
   * @param string $password
   * @return void
  */

  public function login(string $username, string $password, $redirect = true) {

    $db = $this->connection;

    $sql   = $db->prepare("SELECT * FROM users WHERE username = ?");

    $stmt  = $sql->execute([$username]);

    $data  = $sql->fetch(PDO::FETCH_OBJ);

      // Check if the user data is exist
      if (!$data) {

        return "<span class='alert alert-danger m-2'>" . 
                  'لايوجد حساب بهذا الإسم' . 
                "</span>" ;
             
      } 
      // verify password
      else if (password_verify($password, $data->password)) {
        
        Session::set('username', $data->username);
        Session::set('isLogged', password_hash('logToken', 1));


        $setting = DB::connection()->query('SELECT * FROM settings', 5)->fetch();

        Session::set('settings', $setting);
        Session::set('app', $setting->appName);

        if ($redirect) {
        
          // Is admin
          if($data->role === "superadmin") {

            Session::set('superadmin', 'yes'); 

            header("location: admin/dashboard");
            exit();

          } else if ($data->role === "admin") {

            Session::set('admin', 'yes');

            header("location: admin/reports");
            exit();
            
          } else {

            Session::set('user', 'yes');
            header('location: student-data');
            exit();

          }        
        }
            
      } 
      // incorrect password
      else {

        return "<span class='alert alert-danger m-2'>" . 
             'كلمة السر غير صحيحة ' . 
             "</span>" ;
      }       
  }

  public static function authCheck() {

    return Session::has('isLogged') && (Session::has('admin') || Session::has('superadmin'));

  }

  public static function isSuperAdmin() {
    
    return Session::has('superadmin');

  }

  public function getAdmins() {
    
    return $this->connection->query("SELECT * FROM users WHERE role = 'admin' ", 5)->fetchAll();

  }

}