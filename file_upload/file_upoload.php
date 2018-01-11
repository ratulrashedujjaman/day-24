<?php
$link = mysqli_connect('localhost', 'root', '' ,'image_upload');
echo '<pre>';
print_r($_POST);
//print_r($_FILES);

//echo $_FILES['image_file']['name'];
if (isset($_POST['btn'])){



    $fileName=$_FILES['image_file']['name'];
    $directory = 'images/';
    $imageURL = $directory.$_FILES['image_file'] ['name'];
    $fileType= pathinfo($_FILES['image_file']['name'],PATHINFO_EXTENSION);
    $check = getimagesize($_FILES['image_file']['tmp_name']);
    if ($check){
    if(file_exists($imageURL)){
        die('This file is already exist.Please select new file');
    } else {
        if($_FILES['image_file'] ['size']>50000000){
            die ('File size is too large!');
        } else {
            if($fileType != 'jpg' && $fileType != 'png'){
                die('Image type is not supported!!!');
            } else {
                move_uploaded_file($_FILES['image_file'] ['tmp_name'], $imageURL);
                $sql = "INSERT INTO images (image_file) VALUES ('$imageURL')";
                mysqli_query($link,$sql);
                echo 'Image upload & save successfully';
            }
        }
    }
    }
    else{
        die('Please chose a image file');
    }

}


//    move_uploaded_file($_FILES['image_file'] ['tmp_name'], $imageURL);
?>

<form action="" method="post" enctype="multipart/form-data" ;>
<table>
    <tr>
    <th>Select File</th>
    <td><input type="file" name="image_file"/></td>
    </tr>
    <tr>
        <th></th>
        <td><input type="submit" name="btn" value="SubmiT"</td>
 </tr>
</table>
</form>
<hr/>

<?php
$sql= "SELECT * FROM images";
$queryResult= mysqli_query($link,$sql);
?>

<table>
    <?php while ($image= mysqli_fetch_assoc($queryResult)) { ?>
    <tr>
        <td><img src="<?php echo $image['image_file']; ?>" alt="" height="100" width="=100"></td>
    </tr>
    <?php } ?>
</table>
