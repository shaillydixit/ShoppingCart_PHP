<?php
session_start();
$sql=mysqli_connect("localhost", "root", "", "shopping");
if(isset($_POST["addcart"])){
    if(isset($_SESSION["shoppingcart"])){
        $itemarrayid= array_column($_SESSION["shoppingcart"],"itemid");
        if(!in_array($_GET["id"], $itemarrayid)){
            $count = count($_SESSION["shoppingcart"]);
            $itemarray=array(
                'itemid'=>$_GET["id"],
                'itemname'=>$_POST["iname"],
                'itemprice'=>$_POST["iprice"],
                'itemquantity'=>$_POST["quantity"],
            );
            $_SESSION["shoppingcart"][$count]=$itemarray;
        }else{
            echo '<script>alert("item already added")</script>';
        }
    }else{
        $itemarray = array(
            'itemid'=>$_GET["id"],
            'itemname'=>$_POST["iname"],
            'itemprice'=>$_POST["iprice"],
            'itemquantity'=>$_POST["quantity"],
        );
        $_SESSION["shoppingcart"][0]=$itemarray;
    }
}if(isset($_GET["action"])){
    if($_GET["action"]=="delete"){
        foreach($_SESSION["shoppingcart"] as $keys => $values){
            if($values["itemid"]=$_GET["id"]){
                unset($_SESSION["shoppingcary"] [$key]);
                echo '<script>alert("item removed")</script>';
                echo '<script>window.location="index.php"</script>';

            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   </head>
<body>

</body>
</html>