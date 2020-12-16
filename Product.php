<?php
session_start();
class Product
{
    public $prodname,$prodlink;
    function newcategory($prodname,$prodlink,$conn)
    {
        $sql = "INSERT into tbl_product (`prod_parent_id`,`prod_name`,`html`,`prod_available`,`prod_launch_date`) 
        VALUES(1,'$prodname','$prodlink',1,CURRENT_TIMESTAMP())";
        if($conn->query($sql) === true)
        {
            echo "<script>alert('New Category Added Successfully')</script>";
        }

    }

    function cat_display($conn){
        $data=array();
        $sql="SELECT * from tbl_product WHERE `prod_parent_id`='1'";
        $result=$conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row= $result->fetch_assoc()) {
                array_push($data,$row) ;
            }
            return $data;
        }
    }
    
    function cat_delete($get,$conn){
        $sql="DELETE from `tbl_product` where id=$get";
        if($conn->query($sql) === true){
            header("Location:category.php");
        }
    }
    
    function cat_edit($eid,$updatedname,$prodhtml,$avail,$conn){
        echo "<script>alert('you entered this function')</script>";
        $sql="UPDATE `tbl_product` SET `prod_name`='$updatedname',`html`='$prodhtml',`prod_available`='$avail' where `id`='$eid' ";

        if($conn->query($sql) === true){
            
            header("Location:category.php");
        }
       
    }

   function add_prod($prodcat,$prodname,$pageurl,$conn){
       $sql="INSERT into tbl_product(`prod_parent_id`,`prod_name`,`html`,`prod_available`,`prod_launch_date`)
       VALUES('$prodcat','$prodname','$pageurl',1,CURRENT_TIMESTAMP())";
       $result=$conn->query($sql);
       $_SESSION['lastid']=$conn->insert_id;
       echo $conn->error;

   }   

   function prod_discription($disc,$mprice,$aprice,$sku,$conn){
       $sql="INSERT into tbl_product_description(`prod_id`,`description`,`mon_price`,`annual_price`,`sku`)
       VALUES('".$_SESSION['lastid']."','$disc','$mprice','$aprice','$sku')";
       if($conn->query($sql) === true){
           echo "<script>alert('New Product added successfully')</script>";
           header("Location:addproduct.php");
       }
       else{
        echo $conn->error;
       }
       
   }

    function prod_list($conn){
        $arry=array();
        $sql="SELECT * FROM tbl_product
        INNER JOIN tbl_product_description ON tbl_product.id = tbl_product_description.prod_id";
        $result=$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row= $result->fetch_assoc()) {
                array_push($arry,$row) ;
            }
            return $arry;
        }
    }


    function prod_name($checkid,$conn){
        $sql="SELECT * from tbl_product Where `id`='".$checkid."'";
        $arry=array();
        $result=$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row= $result->fetch_assoc()) {
                array_push($arry,$row) ;
            }
            return $arry;
    }
    }
    
    function cat_list($conn){
        $arry=array();
        $sql="SELECT * from tbl_product Where `prod_parent_id`='1' AND `prod_parent_id`!='0'";
        $result=$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row= $result->fetch_assoc()) {
                array_push($arry,$row) ;
            }
            return $arry;
        }
    
    }

    function prod_delete($get,$conn){
        $sql = "DELETE from tbl_product where `id`=$get";
        $result = $conn->query($sql);
        $sql1 = "DELETE from tbl_product_description where `prod_id`=$get";
        if($conn->query($sql1) === true){
            header("Location:viewproduct.php");
        }

    }

    function update_prod($id,$parentid,$parent,$name,$url,$avb,$conn){
        $sql="UPDATE `tbl_product` set  `prod_parent_id`='$parentid', `prod_name`='$name',
        `html`='$url', `prod_available`='$avb'  where `id`='$id' ";
     
        $result=$conn->query($sql);
    }

    function update_desc($id,$Desc,$mprice,$aprice,$sku,$conn){
        $sql = "UPDATE tbl_product_description set `description`='$Desc', 
        `mon_price`='$mprice', `annual_price`='$aprice',`sku`='$sku' where `prod_id`='$id' ";
        if($conn->query($sql) === true){
            echo "<script> alert('Product details updated successfully')</script>";
            header("Location:viewproduct.php");
        }
        else{
            echo $conn->error;
        }
    }


    function cat_dyn($get,$conn){
        $sql="SELECT * FROM `tbl_product` Where `id`='".$get."'";
        $result=$conn->query($sql);
        $arry=array();
        if ($result->num_rows > 0) {
        while ($row= $result->fetch_assoc()) {
        array_push($arry,$row) ;
        }
        return $arry;
        }
        
        }






    


}
?>