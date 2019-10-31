<?php
namespace Alexandr\Animator\Base;


class DBConnection
{
    private $server = 'localhost';
    private $db_name = '';
    private $username = '';
    private $pwd = '';

   public $connection;

   public function __construct()
   {
       $this->connection = $this->connect($this->server, $this->db_name,
           $this->username, $this->pwd);
   }

   public function getLastId(){
       return $this->connection->lastInsertId();
   }

    private function connect(
        $server, $db_name,
        $username, $pwd, array $opt=[]
   )
   {
       $connection = null;
       try {
          $connection =  new \PDO("mysql:host=$server;dbname=$db_name",
               $username, $pwd, $opt);
       } catch (\PDOException $exception){
           echo "Не подключиться  к  базе данных";
       }
       return $connection;
   }

   // неподготовленный запрос
    public function exec($sql_string){
//        if(!$this->connection->exec($sql_string)){
//            return "Exec Error";
//        }
        return $this->connection->exec($sql_string);
    }


    // неподготовленный запрос
    public function queryAll($sql_string){
        $statement = $this->connection->query($sql_string);
        if (!$statement) {
            return false; // либо сообщение
        }
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    // неподготовленный запрос
    public function query($sql_string){
        $statement = $this->connection->query($sql_string);
        if (!$statement) {
            return false; // либо сообщение
        }
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    // подготовленный запрос
    public function execute($sql_string, $params, $all=true){
        $statement = $this->connection->prepare($sql_string);
        $statement->execute($params);

        if (!$all) {
            return $statement->fetch(\PDO::FETCH_ASSOC);
        }
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}