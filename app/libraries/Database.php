<?php 

/**
 * PDO DB class that connects to database,
 * Create prepared statements and bind values,
 * Return rows and results.
 */

class Database{
    private $host = DB_HOST;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME;

    private $db_handler;
    private $statement;
    private $error;

    
    public function __construct()
    {
        // Set data source name(dsn)
        $dsn = 'mysql:host='.$this->host.'; dbname='.$this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true, // checks if there's an existing connection to the database
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        // now create a PDO instance
        try {
            $this->db_handler = new PDO($dsn, $this->username, $this->password, $options);  
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

    }

    // this function takes care of our query with prepared statement
    public function query($sql){
        $this->statement = $this->db_handler->prepare($sql);
    }
    

    // bind values
    public function bind($parameter, $value, $type = null){
        if(is_null($type)){
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                
                default:
                    $type = PDO::PARAM_STR;
            }
        }


        $this->statement->bindValue($parameter, $value, $type);
        
    }

    // execute prepared statement
    public function execute(){
        return $this->stateme->execute();
    }

    // fetch results as objects
    public function resultSet(){
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

     // fetch single record as object
     public function single(){
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

     // get row count (number of rows per query)
     public function num_rows(){
        $this->execute();
        return $this->statement->row_count(PDO::FETCH_OBJ);
    }

}

?>