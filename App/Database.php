<?php

/**
 * Class Database
 * Connects to the database
 */

class Database
{
    // Database
    private $servername     = "localhost";
    private $username       = "root";
    private $password       = "";
    private $dbname         = "delay";
    private $connection     = null;

    function __construct() {
        $this->connect();
    }

    public function connect(){
        // Create connection
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Hm... Connection failed: " . $conn->connect_error);
        }
        //echo "Connected successfully";
        $this->connection = $conn;
    }

    /**
     * Delete record by id
     * @param $id of the record
     * @param $table in database
     * @return bool true if it was deleted
     */
    public function delete($id,$table){
        // sql to delete a record
        $sql = "DELETE FROM {$table} WHERE id={$id} ";

        if ($this->connection->query($sql) === TRUE) {
            //echo "Record deleted successfully";
            return true;
        } else {
            //echo "Error deleting record: " . $this->connection->error;
            return false;
        }
    }

    /**
     * Returns the connection to the database
     * @return null
     */
    public function getConnection(){
        return $this->connection;
    }
}

?>