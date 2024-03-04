<?php
class Connect
{
    protected $dbh;

    protected function connection() 
    {
        try {
            $conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=avcontrol", "root","");
            return $conectar;
        }catch (Exception $e){
            print("errorbd:". $e->getMessage() ."<br>");
            die();
        }

    }

    public function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");  
    }

    public static function route()
    {
        return "http://localhost/AVCONTROL";
    }
}

?>
