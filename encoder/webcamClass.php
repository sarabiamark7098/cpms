<?php
include('../php/db_config.php');
class Webcam{

    public $db;
    public $name;
    public $position;
    
    public function __construct(){
        $this->db =  mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

            if(mysqli_connect_errno()) {
                die("Database connection failed: " . 
                    mysqli_connect_error() . 
                    " (" . mysqli_connect_errno() . ")"
                );
            }
    }
    
    //This function will create a new name for every image captured using the current data and time.
    public function getNameWithPath($id){
        $name = "../clientImages/".date('Ymd')."-{$id}.jpg";
        // echo "<script>console.log('.$name.')</script>";
        return $name;
    }
    
    //function will get the image data and save it to the provided path with the name and save it to the database
    public function showImage($id, $do){
        $file = file_put_contents($this->getNameWithPath($id), file_get_contents('php://input')); //mao nani tung nag convert sa file then butang sa folder path
        if(!$file){
            return "ERROR: Failed to write data to ". $this->getNameWithPath($id).", check permissions\n";
        }
        else
        {
            $this->saveImageToDatabase($this->getNameWithPath($id), $do, $id); // this line is for saveing image to database
            return $this->getNameWithPath($id);
        }
        
    }
    public function saveImageToDatabase($imageurl, $do, $id){
        $image=$imageurl;
        if($image){
            if($do==1){
                $query="UPDATE webcam SET image = '{$image}' where trans_id='{$id}'";
            }else{
                $query="INSERT INTO webcam (trans_id, image) values ( '{$id}', '{$image}')";
            }
            
            $result= mysqli_query($this->db, $query);
            if($result){
                return "Image saved to database";
            }
            else{
                return "Image not saved to database";
            }
        }
    }
    
    
}