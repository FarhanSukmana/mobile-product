<?php 

  $ds = DIRECTORY_SEPARATOR;
  $base_dir = realpath(dirname(__FILE__). $ds . '..') . $ds;

  require_once("{$base_dir}includes{$ds}Database.php");

  class Seller{
    private $table ='sellers';

    public $id;
    public $name;
    public $password;
    public $image;
    public $address;
    public $descriptions;

    // Constructor
    public function __construct(){
      
    }
    
    // Validating if params existing or not
    public function validate_params($value){
      // if(!empty($value)){
      //   return true;
      // }
      // else{
      //   return false;
      // }
      return(!empty($value)); 
    }

    // Saving new data in our database
    public function register_seller(){
      global $database;

      $this->name =trim(htmlspecialchars(strip_tags($this->name)));
      $this->password =trim(htmlspecialchars(strip_tags($this->password)));
      $this->image =trim(htmlspecialchars(strip_tags($this->image)));
      $this->address =trim(htmlspecialchars(strip_tags($this->address)));
      $this->descriptions =trim(htmlspecialchars(strip_tags($this->descriptions)));

      $sql = "INSERT INTO $this->table(name, password, image, address, descriptions) VALUES(
        '" .$database->escape_value($this->name). "',
        '" .$database->escape_value($this->password). "',
        '" .$database->escape_value($this->image). "',
        '" .$database->escape_value($this->address). "',
        '" .$database->escape_value($this->descriptions). "'
      )";

      $seller_saved = $database->query(@$sql);

      if($seller_saved) return $database->last_insert_id();
      else return false;

    }
  }


  $seller = new Seller()
?> 