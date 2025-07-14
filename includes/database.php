<?php 
  define("HOST",'localhost');
  define("USER_NAME",'root');
  define("PASSWORD",'');
  define('DB_NAME','better_buys');
  

  //class db start
  class Database{
    private $connection;

    // Constructions
    public function __construct(){
      $this->open_db_connection();
    }
    // Connect to DB
    public function open_db_connection(){
      $this->connection = mysqli_connect(HOST,USER_NAME,PASSWORD,DB_NAME);

      if(mysqli_connect_error()){
        die("Connection failed: ". mysqli_connect_error());

      }
    }
    // Executing sql query
    public function query($sql){
      $result = $this->connection->query($sql);
      
      if (!$result){
        die("Query fails :". $sql);
      }
      return $result;
    }
    // fetching list of data from sql
    public function fetch_array($result){
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc){
          $result_array[] = $row;
        }

        return $result_array;
      }
    }
    // fetching single of data from sql
    public function fetch_row($result){
      if($result->num_rows >0){
        return $result->fetch_assoc();
      }
    }
    // checks proper format of data
    public function escape_value($value){
      return $this->connection->real_escape_string($value);
    }
    // close the connection with sql
    public function close_connection(){
      return $this->connection->close();
    }
    // Last insert id
    public function last_insert_id(){
      return $this->connection->insert_id;
    }
  }

  $database = new Database();
?>
