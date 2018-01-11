<?php

namespace App\classes;
use App\classes\Database;

class Blog
{
    public function addBlog($data){
        $sql="INSERT INTO `blog`(`category_name`, `blog_title`, `short_description`, `long_description`, `blog_image`, `status`) VALUES ('$data[category_name]','$data[blog_title]','$data[short_description]','$data[long_description]','$data[blog_image]','$data[status]')";
        if(mysqli_query(Database::dbConnection(),$sql)){
            $message="Insert Successfully";
            return $message;

        }else{
            die("Query problem".mysqli_error(Database::dbConnection()));
        }
    }
    public function viewBlogInfo(){
        $sql="SELECT * FROM `blog`";
        if(mysqli_query(Database::dbConnection(),$sql)){
            $queryResult=mysqli_query(Database::dbConnection(),$sql);
            return $queryResult;
        }else{
            die("Query Problem".mysqli_error(Database::dbConnection()));
        }
    }
    public function getBlogInfo($id){
        $sql="SELECT * FROM blog WHERE id=$id";
        if(mysqli_query(Database::dbConnection(),$sql)){
            $result=mysqli_query(Database::dbConnection(),$sql);
            return $result;
        }
        else{die('Query problem. '.mysqli_error(Database::dbConnection()));
        }
    }


    public function deleteBlogInfo($id){
        $sql="DELETE FROM blog WHERE id=$id";
        if(mysqli_query(Database::dbConnection(),$sql)){
            $message="Delete Successfully";
            return $message;

        }else{
            die("Query problem".mysqli_error(Database::dbConnection()));
        }
    }
    public function getAllPublishedCategoryInfo(){
        $sql= "SELECT * FROM category WHERE  status=1";
        if (mysqli_query(Database::dbConnection(),$sql)){
            $queryResult = mysqli_query(Database::dbConnection(),$sql);
            return $queryResult;
        }else{
            die('Query Problem');
        }
    }
}