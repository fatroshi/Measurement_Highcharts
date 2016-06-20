<?php
include_once "App/Database.php";
include_once "App/subject.php";
include_once "App/Graph.php";

/**
 * Created by PhpStorm.
 * User: Farhad
 * This class acts as the controller for the application.
 */

class Controller {

    private $database;
    //private $user;
    private $Subject;

    function __construct() {
        $this->database = new Database();                                       // Connect to the database
        //$this->user     = new User($this->database->getConnection());
        $this->Subject = new Subject($this->database->getConnection());
    }

    /**
     * Get logged in user
     */
    public function getUser(){
        $this->user->getUser();
    }

    /**
     * Add Subject to the database
     * @param $SubjectName
     * @return bool true if Subject was successfully added
     */
    public function addSubject($SubjectName){
        return $this->Subject->addSubject($SubjectName);
    }

    /**
     * Add page to database
     * @param $subject_id
     * @param $itemName
     * @param $info
     */
    public function addItem($subject_id,$itemName,$info){
        $this->Subject->addItem($subject_id,$itemName,$info);
    }


    /**
     * @param $page_id
     * @param $productName
     * @param $info
     * @param $link
     * @return bool
     */
    public function addProduct($page_id, $productName, $info, $link){
        return $this->Subject->addProduct($page_id,$productName,$info,$link);
    }

    /**
     * @param $product_id
     * @param $measurement
     */
    public function addMeasurement($product_id,$measurement){
        $this->Subject->addMeasurement($product_id,$measurement);
    }

    /**
     * Get item by item id
     * @param $id
     * @return mixed
     */
    public function getItem($id){
        return $this->Subject->getItem($id);
    }

    /**
     * Get all products by page id
     * @param $page_id
     * @return mixed
     */
    public function getPageProducts($page_id){
        return $this->Subject->getPageProducts($page_id);
    }

    public function getProductMeasurements($product_id){
        return $this->Subject->getProductMeasurements($product_id);
    }

    /**
     * Delete record by id
     * @param $id of the record
     * @param $table where the record is stored
     */
    public function delete($id, $table){
        $this->database->delete($id,$table);
    }

    /**
     * Redirect user to another page
     * @param $newURL
     */
    public function redirect($newURL){
        header("Location: " . $newURL);
        die();
    }

    /**
     * Get the last inserted record
     * @return mixed
     */
    public function insertId(){
        // Get last inserted id
        return $this->database->getConnection()->insert_id;
    }

    /**
     * Get all categories
     * @return array list of Categoery objects
     */
    public function allSubjects(){
        return $this->Subject->allSubjects();
    }

    /**
     * Get all items for the Subject
     * @param $SubjectId
     * @return array list of Item objects
     */
    public function getSubjectItems($SubjectId){
        return $this->Subject->allItems($SubjectId);
    }

    /**
     * Get all items
     * @return array list of Item objects
     */
    public function getAllItems(){
        return $this->Subject->getAllItems();
    }

    /**
     * @return string json encoded
     */
    public function getAllItemsJSON(){
        return $this->Subject->getAllItemsJSON();
    }

    public function getMeasurementsJSON($product_id){
        return $this->Subject->getMeasurementsJSON($product_id);
    }

    /**
     * Display data in an array
     * @param $array
     */
    public function var_dump($array){
        echo "<pre>";
        print_r($array); // or var_dump($data);
        echo "</pre>";
    }

    /**
     * Check if the user exists, and that the authentication returns true.
     * @param $username
     * @param $password
     * @return bool true if the user- password data is correct
     */
    public function login($username, $password){
        return $this->user->login($username,$password);
    }
}

?>