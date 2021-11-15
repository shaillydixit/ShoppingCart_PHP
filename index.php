<?php
session_start();
$sql=mysqli_connect("localhost", "root", "", "shopping");
if(isset($_POST["addcart"])){
    if(isset($_SESSION["shoppingcart"])){
        $item_array_id= array_column($_SESSION["shoppingcart"],"itemid");
        if(!in_array($_GET["id"], $item_array_id)){
            $count = count($_SESSION["shoppingcart"]);
            $item_array=array(
                'itemid'=>$_GET["id"],
                'itemname'=>$_POST["iname"],
                'itemprice'=>$_POST["iprice"],
                'itemquantity'=>$_POST["quantity"],
            );
            $_SESSION["shoppingcart"][$count]=$item_array;
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
        $_SESSION["shoppingcart"][0]=$item_array;
    }
}
if(isset($_GET["action"])){
    if($_GET["action"]=="delete"){
        foreach($_SESSION["shoppingcart"] as $keys => $values){
            if($values["itemid"]== $_GET["id"]){
                unset($_SESSION["shoppingcart"] [$key]);
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.css"></script>

</head>
<body>
    <div class="container">
        <h2 align="center">Shopping Cart in PHP</h2>
        <?php
            $query = "SELECT * FROM tbl_product ORDER BY id ASC";
            $result = mysqli_query($sql, $query);
            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_array($result))
                
                {

  
        ?>
        <div class="col-md-4">
            <form method="post" action="index.php?action=add&id=" <?php echo $row["id"];?>>
                <div style="border: 3px solid blue;background-color:lightgreen;border-radius:5px;padding:16px;"
                 align="center" 
                 <img src="images/<?php echo $row["image"];?>" class="img-responsive"> <br> 
                 <h3 class="text-info"><?php echo $row["name"];?></h3>
                 <h3 class="text-danger"><?php echo $row["price"];?></h3>
                    <input type="text" name="quantity" value="1" class="form-control">
                    <input type="hidden" name="iname" value="<?php echo $row['name'];?>">
                    <input type="hidden" name="iprice" value="<?php echo $row['price'];?>">
                    <input type="submit" name="addtocart" style="margin-top: 5px;" class="btn btn-success" value="Add To Cart">
                    </div>
                </form>
        </div>
        <?php
        }}?>
        <div style="clear:both"></div><br>
        <h2>Order Details</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Item Name</th>
                    <th width="10%">Quantity</th>
                    <th width="20%">Price</th>
                    <th width="15%">Total Price</th>
                    <th width="15%">Action</th>
                </tr>
<?php
    if(!empty($_SESSION["shoppingcart"])){
        $total=0;
        foreach($_SESSION["shoppingcart"] as $keys => $values){
            ?> <tr>
                <td><?php echo $values["itemname"];?></td>
                <td><?php echo $values["itemquantity"];?></td>
                <td><?php echo $values["itemprice"];?></td>
                <td><?php echo number_format($values["itemquantity"] * $values["itemprice"], 2);?></td>
                <td><a href="index.php?action=delete&id=<?php echo $values["itemid"];?>">
            <span class="text-danger">Remove</span>
            </a></td>

            </tr>
            <?php
$total = $total+($values["itemquantity"]*$values["itemprice"]);
        }?>
        <tr>
        <td colspan="3" align="right"> Total</td>
        <td align="right">$<?php echo number_format($total,2);?></td>
        </tr>
        <?php
}
?>
            </table>
        </div>
    </div>
</body>
</html>