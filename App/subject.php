<?php

/**
 * This class handles subjects and items in the database.
 */

include_once "App/Database.php";
class Subject extends Database{

    private $connection;

    /**
     * Subject constructor.
     * @param $connection connection to mysqli
     */
    function __construct($connection) {

        $this->connection = $connection;
    }

    /**
     * Creates a new unique Subject
     * @param $SubjectName is set as name
     * @return bool true if Subject was created
     */
    public function addSubject($SubjectName){

        if(!$this->SubjectExists($SubjectName)){

            $sql = "INSERT INTO subjects (SubjectName)VALUES ('{$SubjectName}')";
            if (mysqli_query($this->connection, $sql)) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->connection);
                return false;
            }
        }
    }

    /**
     * Check if the Subject exist in db, compares the name
     * @param $SubjectName
     * @return bool true if the Subject exists
     */
    public function SubjectExists($SubjectName){
        $sql = "SELECT * FROM subjects WHERE SubjectName='{$SubjectName}'";
        $result = $this->connection->query($sql) or die($this->connection->error);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Get alla subjects
     * @return array list containing Subject objects
     */
    public function allSubjects(){
        $subjects = array();
        $sql = "SELECT * FROM subjects";
        $result = $this->connection->query($sql) or die($this->connection->error);
        while($row = $result->fetch_assoc()) {
            $subjects[$row["id"]] = $row["SubjectName"];

        }
        return $subjects;
    }

    /**
     * Get all items by Subject id
     * @param $subject_id
     * @return array list of Item objects
     */
    public function allItems($subject_id){
        $items = array();
        $sql = "SELECT * FROM items WHERE subject_id={$subject_id}";
        $result = $this->connection->query($sql) or die($this->connection->error);
        while($row = $result->fetch_assoc()) {
            $items[]= array ($row["id"],$row['itemName'],$row['info'],$subject_id);

        }
        return $items;
    }

    public function getPageProducts($page_id){
        $items = array();
        $sql = "SELECT * FROM products WHERE page_id={$page_id}";
        $result = $this->connection->query($sql) or die($this->connection->error);
        while($row = $result->fetch_assoc()) {
            $items[]= array ($row["id"],$row['productName'],$row['info'], $row['link'],$row['published']);

        }
        return $items;
    }

    public function getProductMeasurements($product_id){
        $items = array();
        $sql = "SELECT * FROM measurements WHERE product_id={$product_id}";
        $result = $this->connection->query($sql) or die($this->connection->error);
        while($row = $result->fetch_assoc()) {
            $items[]= array ($row["id"],$row['product_id'],$row['measurement']);
        }
        return $items;
    }

    /**
     * Add a new item
     * @return bool true if the item was saved in db
     */
    public function addItem($subject_id,$itemName,$info){
        if(!$this->itemExists($itemName)){

            $sql = "INSERT INTO items (subject_id,itemName,info,published) VALUES ('{$subject_id}','{$itemName}','{$info}', CURRENT_TIMESTAMP )";
            if (mysqli_query($this->connection, $sql)) {
                echo "<span class='text-success'>New record created successfully</span>";
                return true;
            } else {
                echo "<span class='text-danger>" . "<hr> Error: " . $sql . "<br>" . mysqli_error($this->connection) . "</span>";
                return false;
            }
        }
    }


    /**
     * Add a new item
     * @return bool true if the item was saved in db
     */
    public function addProduct($page_id,$productName,$info,$link){
        $sql = "INSERT INTO products (page_id,productName,info,link,published) VALUES ('{$page_id}','{$productName}','{$info}','{$link}', CURRENT_TIMESTAMP )";
        if (mysqli_query($this->connection, $sql)) {
            echo "<span class='text-success'>New record created successfully</span>";
            return true;
        } else {
            echo "<span class='text-danger>" . "<hr> Error: " . $sql . "<br>" . mysqli_error($this->connection) . "</span>";
            return false;
        }
    }

    /**
     * Add a new item
     * @return bool true if the item was saved in db
     */
    public function addMeasurement($product_id,$measurement){
        $sql = "INSERT INTO measurements (product_id,measurement) VALUES ('{$product_id}','{$measurement}')";
        if (mysqli_query($this->connection, $sql)) {
            //echo "<span class='text-success'>New record created successfully</span>";
            return true;
        } else {
            //echo "<span class='text-danger>" . "<hr> Error: " . $sql . "<br>" . mysqli_error($this->connection) . "</span>";
            return false;
        }
    }


    /**
     * Get item by id
     * @param $id
     * @return mixed
     */
    public function getItem($id){
        $sql = "SELECT * FROM items WHERE id={$id}";
        $result = $this->connection->query($sql) or die($this->connection->error);
        $row = $result->fetch_assoc();
        return $row;
    }


    /**
     * Get product by id
     * @param $id
     * @return mixed
     */
    public function getProduct($id){
        $sql = "SELECT * FROM products WHERE id={$id}";
        $result = $this->connection->query($sql) or die($this->connection->error);
        $row = $result->fetch_assoc();
        return $row;
    }

    /**
     * Check if the item exists in database
     * @param $itemName name
     * @return bool true if it exists
     */
    public function itemExists($itemName){
        $sql = "SELECT * FROM items WHERE itemName='{$itemName}'";
        $result = $this->connection->query($sql) or die($this->connection->error);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Check if the product exists in database
     * @param $itemName name
     * @return bool true if it exists
     */
    public function productExists($itemName){
        $sql = "SELECT * FROM products WHERE productName='{$itemName}'";
        $result = $this->connection->query($sql) or die($this->connection->error);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Get all items
     * @return array list of all items
     */
    public function getAllItems(){
        $items = array();
        $sql = "SELECT * FROM subjects";
        $result = $this->connection->query($sql) or die($this->connection->error);
        while($row = $result->fetch_assoc()) {

            $sql = "SELECT * FROM items WHERE subject_id={$row['id']}";
            $itemResult = $this->connection->query($sql) or die($this->connection->error);
            while($item = $itemResult->fetch_assoc()) {
                $items[] = array($row['id'],$row['SubjectName'],$item['itemName'],$item['info'],$item['published']);
            }
        }
        return $items;
    }

    /**
     * Get all items in JSON data
     * @return string json encoded data
     */
    public function getAllItemsJSON(){

        $sql = "SELECT * FROM subjects";
        $result = $this->connection->query($sql) or die($this->connection->error);
        $items = array();
        while($row = $result->fetch_assoc()) {

            $sql = "SELECT * FROM items WHERE subject_id={$row['id']}";
            $itemResult = $this->connection->query($sql) or die($this->connection->error);
            while($item = $itemResult->fetch_assoc()) {
                $ar = array(
                    "subject_id" => $row['id'], "itemId" => $item['id'], "SubjectName" => $row['SubjectName'],
                    "imgName" => $item['imgName'],"itemName" => $item['itemName'], "uploadFolder" => "uploads",
                    "published" => $item['published']
                );
                array_push($items,$ar);
            }

        }
        return json_encode($items);
    }

    public function getMeasurementsJSON($product_id){
        $sql = "SELECT * FROM measurements WHERE product_id={$product_id}";
        $result = $this->connection->query($sql) or die($this->connection->error);

        $counter = 0;

        $ar = array();
        $newData = array();
        while($row = $result->fetch_assoc()) {

            if($counter == 0){
                // GET THE NAME
                $sql = "SELECT * FROM products WHERE id={$row['product_id']}";
                $sqlResult = $this->connection->query($sql) or die($this->connection->error);
                $name = $sqlResult->fetch_assoc();

                $ar = array("name" => $name['productName'], "data" => array());
            }else{
                if(floatval($row['measurement'] > 0)){
                    $ar["data"][] = floatval($row['measurement']);
                }
            }

            $counter++;

        }
        return json_encode($ar);
    }

}


?>