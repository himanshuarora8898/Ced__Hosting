<?php
require_once('../Dbcon.php');
require_once('../Product.php');
$obj = new DbCon();
$obj2 = new Product();
if(isset($_POST['submitt'])){
  print_r($_POST);
    $prod_cat = isset($_POST['prodcat'])?$_POST['prodcat']:'';
    $prod_name = isset($_POST['prodname'])?$_POST['prodname']:'';
    $pageurl = isset($_POST['pageurl'])?$_POST['pageurl']:'';
    $mprice = isset($_POST['monthlyprice'])?$_POST['monthlyprice']:'';
    $aprice = isset($_POST['annualprice'])?$_POST['annualprice']:'';
    $sku = isset($_POST['sku'])?$_POST['sku']:'';
    $webspace = isset($_POST['webspace'])?$_POST['webspace']:'';
    $band = isset($_POST['bandwidth'])?$_POST['bandwidth']:'';
    $fdomain = isset($_POST['freedomain'])?$_POST['freedomain']:'';
    $techsupport = isset($_POST['techsupport'])?$_POST['techsupport']:'';
    $mailbox = isset($_POST['mailbox'])?$_POST['mailbox']:'';
    $obj2->add_prod($prod_cat,$prod_name,$pageurl,$obj->conn);
    $description=array("Webspace"=>$webspace,
                "Bandwidth"=>$band,
                "FreeDomain"=>$fdomain,
                "Mailbox"=>$mailbox,
                "TechnologySupported"=>$techsupport);
    $Disc=json_encode($description);
    echo $Disc;
    $obj2->prod_discription($Disc,$mprice,$aprice,$sku,$obj->conn);
   
    
}


?>
<html>

<head>
  <meta charset="utf-8">
  <link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Admin Dashboard </title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
 
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" type="text/css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
</head>
<body>

<div class="container" style="margin-left:230px;"><?php include 'header.php';?></div>


<div class="container-fluid mt--6">
<div class="row">
<div class="col">
<div class="card">
<!-- Card header -->
<div class="container" style="width:60%;margin-left:290px;">
<form action="" method="POST" >
<h6 class="heading-small text-muted mb-4">Enter Product Details</h6>

<div class="pl-lg-4">
<div class="row">

<div class="col-lg-6">

<div class="form-group">
<label class="form-control-label" for="input-username">Select Product Category *</label>
<!-- <input type="text" id="input-username" class="form-control" placeholder="Username" value="lucky.jesse"> -->
<select name="select" id="select" class="form-control select" name="prodcat" required="">
<?php 
          
          require_once('../Product.php');
          require_once('../Dbcon.php');
          $obj= new DbCon();
          $obj2=new Product();
          $data=$obj2->cat_display($obj->conn);
         $a='<option value=""> Please Select </option>';
          foreach($data as $val){
            $a.=' <option value="'.$val['id'].'"> '.$val['prod_name'].'</option>';
          }
          $a.='</select>';
          echo $a;
          ?>
       
<p id="prodCategory"></p>

</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label" for="input-email">Enter Product Name *</label>
<input type="text" id="prodname" name="prodname" class="form-control productname" placeholder="Enter Product Name" pattern="^[ A-Za-z0-9_@./#$&+-]*$" required>
<p id="prodname"></p>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label" for="input-first-name">Page URL </label>
<input type="text" id="input-first-name" name="pageurl" class="form-control" placeholder="Page URL">
</div>
</div>
</div>
</div>
<hr class="my-4" />
<!-- Address -->
<h6 class="heading-small text-muted mb-4">Product Description (Enter Product Description Below)</h6>
<div class="pl-lg-4">
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label" for="input-username">Enter Monthly Price *</label>
<input type="text" id="proprice" name="monthlyprice" class="form-control mpriceid" placeholder="ex: 23" required maxlength="15">
<p id="lablemprice"></p>
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label" for="input-email">Enter Annual Price *</label>
<input type="text" id="aprice" name="annualprice" class="form-control apriceid" placeholder="ex: 23" required maxlength="15">
<p id="lableaprice"></p>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label" for="input-first-name">SKU *</label>
<input type="text" id="prosku" name="sku" class="form-control skuid" placeholder="SKU" required>
<p id="lablesku"></p>
</div>
</div>
</div>
</div>
<hr class="my-4" />
<!-- Address -->
<h6 class="heading-small text-muted mb-4">Features</h6>
<div class="pl-lg-4">
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label" for="input-username">Web Space(in GB) *</label>
<input type="text" id="proweb" name="webspace" class="form-control webid" maxlength="5" placeholder="Web Space(in GB)" required >
<h6 class="heading-small text-muted mb-4">Enter 0.5 for 512 MB</h6>
<p id="lableweb"></p>
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label" for="input-email">Bandwidth (in GB) *</label>
<input type="text" id="proband" name="bandwidth" class="form-control bandid" maxlength="5" placeholder="Bandwidth (in GB)" required>
<h6 class="heading-small text-muted mb-4">Enter 0.5 for 512 MB</h6>
<p id="lableband"></p>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label" for="input-first-name">Free Domain *</label>
<input type="text" id="profree" name="freedomain" class="form-control domainid" placeholder="Free Domain" required>
<h6 class="heading-small text-muted mb-4">Enter 0 if no domain available in this service
</h6>
<p id="labledomain"></p>
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label" for="input-first-name">Language / Technology 
Support*</label>
<input type="text" id="prolang" name="techsupport" class="form-control prolang" placeholder="Language / Technology" required>
<h6 class="heading-small text-muted mb-4">Separate by (,) Ex: PHP, MySQL, MongoDB</h6>
<p id="prodlang"></p>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label" for="input-first-name">Mailbox *</label>
<input type="text" id="promail" name="mailbox" class="form-control promail" placeholder="Free Domain" required>
<h6 class="heading-small text-muted mb-4">Enter Number of mailbox will be provided, enter 0
if none</h6>
<p id="prodmail"></p>
</div>
</div>
</div>
<div class="text-center">
<input type="submit" name="submitt" onsubmit="act()"  id="submit" value="Add Product" class="btn btn-primary bntn">
</div>
</div>
</form>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
 


  <script>
 var count1=0;
 var count2=0;
 var count3=0;
 var count4=0;
 var count5=0;
 var count6=0;
 var count7=0;
 var count8=0;
 var count9=0;
 var count10=0;
 
 $('.bntn').attr('disabled', true);
    $(document).ready( function () {
    $('#myTable').DataTable();
} );


$(".select").focusout(function() {
    $categoryid = $(".select").val();
    if ($categoryid == "" || $categoryid == null) {
        $("#prodCategory").html("*Please Select Category");
        $("#prodCategory").show();
        $(this).css('border', 'solid 3px red');
    } else {
        $("#prodCategory").hide();
        $(this).css('border', 'solid 3px green');
        count1=1;
        act();
    }
})

$(".productname").focusout(function() {
    $pname = $(".productname").val();
    var ans1 = $pname.replace(/ /g, '');
    var ans2 = Number(ans1);
    if ($pname == "" || $pname == null) {
        $("#prodname").html("*Enter Product Name");
        $("#prodname").show();
        $(this).css('border', 'solid 3px red');
    } else if(!$pname.match(/^([a-zA-Z]+\s+[a-zA-Z])*[(a-zA-Z)]*(-[0-9]+(?!-)+)*$/)){
        $("#prodname").html("*Product Name can be alpha-numeric/only alphabetic and one space between words allowed");
        $("#prodname").show();
        $(this).css('border', 'solid 3px red');
    } else if (Number.isInteger(ans2)) {
        $("#prodname").html("*Product Name can be alpha-numeric/only alphabetic and one space between words allowed");
        $("#prodname").show();
        $(this).css('border', 'solid 3px red');
    } else {
        
        $(this).css('border', 'solid 3px green');
        count2=1;
        act();
    }
})
// $('.mpriceid').attr('maxlength', 15);
// $('.apriceid').attr('maxlength', 15);
$(".mpriceid").keyup(function() {
    $mprice = $(".mpriceid").val();
    if($mprice.length>15){
        $('.mpriceid').attr('maxlength', 15);
        $("#lablemprice").html("*Price can be only integer of 15 digit");
        $("#lablemprice").show(); 
        $(this).css('border', 'solid 3px red');
    }

})
$(".apriceid").keyup(function() {
    $aprice = $(".apriceid").val();
    if($aprice.length>15){
        $('.mpriceid').attr('maxlength', 15);
        $("#lableaprice").html("*Price can be only integer of 15 digit");
        $("#lableaprice").show();
        $(this).css('border', 'solid 3px red');
    }

})
$(".mpriceid ").focusout(function() {

    $mprice = $(".mpriceid").val();
    $first = $mprice.substr(0, 1);
    $second = $mprice.substr(1, 1);
    if ($mprice == "" || $mprice == 0) {
        $("#lablemprice").html("*Enter Monthly Price");
        $("#lablemprice").show();
        $(this).css('border', 'solid 3px red');
    } else if (!$mprice.match(/^[0-9]\d*(\.\d+)?$/)) {
        $("#lablemprice").html("*Price can be only integer and only one dot(.) allowed");
        $("#lablemprice").show();
        $(this).css('border', 'solid 3px red');
    } else if ($first == 0 && $second == 0) {
        $("#lablemprice").html("*In starting you cant have two zero");
        $("#lablemprice").show();
        $(this).css('border', 'solid 3px red');
    }   else {
        $("#lablemprice").hide();
        $(this).css('border', 'solid 3px green');
        count3=1;
        act();
    }
})


$(".apriceid").focusout(function() {
    $aprice = $(".apriceid").val();
    $first = $aprice.substr(0, 1);
    $second = $aprice.substr(1, 1);
    if ($aprice == "" || $aprice == 0) {
        $("#lableaprice").html("*Enter annual Price");
        $("#lableaprice").show();
        $(this).css('border', 'solid 3px red');
    } else if (!$aprice.match(/^[0-9]\d*(\.\d+)?$/)) {
        $("#lableaprice").html("*Price can be only integer and only one dot(.) allowed");
        $("#lableaprice").show();
        $(this).css('border', 'solid 3px red');
    } else if ($first == 0 && $second == 0) {
        $("#lableaprice").html("*In starting you cant have two zero");
        $("#lableaprice").show();
        $(this).css('border', 'solid 3px red');
    } else {
        $("#lableaprice").hide();
        $(this).css('border', 'solid 3px green');
        count4=1;
        act();
    }
})
$(".skuid").focusout(function() {
    $prosku = $(".skuid").val();
    if ($prosku == "") {
        $("#lablesku").html("*Select sku");
        $("#lablesku").show();
       $(this).css('border', 'solid 3px red');
    }  
    else if(!$prosku.match(/^[a-zA-z0-9]+[a-zA-Z0-9#-]+$/))
    {
        $("#lablesku").html("*Select Valid sku");
        $("#lablesku").show();
        $(this).css('border', 'solid 3px red'); 
    }
  
       else {
        $("#lablesku").hide();
        $(this).css('border', 'solid 3px green');
        count5=1;
        act();
    }



});


$(".webid").focusout(function() {
    $web = $(".webid").val();
    $first = $web.substr(0, 1);
    $second = $web.substr(1, 1);
    if ($web == "" || $web == 0) {
        $("#lableweb").html("*Enter web space.");
        $("#lableweb").show();
        $(this).css('border', 'solid 3px red');
    } else if (!$web.match(/^[0-9]\d*(\.\d+)?$/)) {
        $("#lableweb").html("*Web Space can be only integer and only one dot(.) allowed");
        $("#lableweb").show();
        $(this).css('border', 'solid 3px red');
    } else if ($first == 0 && $second == 0) {
        $("#lableweb").html("*In starting you cant have two zero");
        $("#lableweb").show();
        $(this).css('border', 'solid 3px red');
    } else {
        $("#lableweb").hide();
        $(this).css('border', 'solid 3px green');
        count6=1;
        act();
    }
})

$(".bandid").focusout(function() {
    $band = $(".bandid").val();
    $first = $band.substr(0, 1);
    $second = $band.substr(1, 1);
    if ($band == "" || $band == 0) {
        $("#lableband").html("*Enter  bandwidth.");
        $("#lableband").show();
        $(this).css('border', 'solid 3px red');
    } else if (!$band.match(/^[0-9]\d*(\.\d+)?$/)) {
        $("#lableband").html("*Bandwidth can be only integer and only one dot(.) allowed");
        $("#lableband").show();
        $(this).css('border', 'solid 3px red');
    } else if ($first == 0 && $second == 0) {
        $("#lableband").html("*In starting you cant have two zero");
        $("#lableband").show();
        $(this).css('border', 'solid 3px red');
    } else {
        $("#lableband").hide();
        $(this).css('border', 'solid 3px green');
        count7=1;
        act();
    }
})



$(".domainid").focusout(function() {
    $domain = $(".domainid").val();
     $first = $domain.substr(0, 1);
     if($first.match(/^[a-zA-Z]+$/))
{
$pattern=/^[a-zA-Z]+$/;
}
else if($first.match(/^[0-9]+$/))
{
$pattern=/^[0-9]+$/;
}
    if ($domain == "" || $domain == null) {
        $("#labledomain").html("*Enter  No of domain.");
        $("#labledomain").show();
        $(this).css('border', 'solid 3px red');
    } else if (!$domain.match($pattern)) {
        $("#labledomain").html("*Domain can be only Numeric and dot(.) not allowed");
        $("#labledomain").show();
        $(this).css('border', 'solid 3px red');
    } else {
        $("#labledomain").hide();
        $(this).css('border', 'solid 3px green');
        count8=1;
         act();
    }
})
$(".prolang").focusout(function() {
    $prolang = $(".prolang").val();
    if ($prolang == "") {
        $("#prodlang").html("*Select lang Space in G.B");
        $("#prodlang").show();
        $(this).css('border', 'solid 3px red');
    }  
    else if(!$prolang.match(/^([a-zA-Z0-9]+(,[a-zA-z0-9]+))+$/))
    {
        $("#prodlang").html("*Select Valid language");
        $("#prodlang").show();
       $(this).css('border', 'solid 3px red'); 

       if($prolang.match(/^[a-zA-Z0-9]+$/)){
        $("#prodlang").hide();
        $(this).css('border', 'solid 3px green');
        count9=1;
         act();
       }
    }
    else if($prolang<.5)
    {
        $("#prodlang").html("*Select Valid language");
        $("#prodlang").show();
         $(this).css('border', 'solid 3px red'); 
    }
    else {
        $("#prodlang").hide();
        $(this).css('border', 'solid 3px green');
        count9=1;
         act();
    }

});



$(".promail").focusout(function() {
    $promail = $(".promail").val();
    $first = $promail.substr(0, 1);
if($first.match(/^[a-zA-Z]+$/))
{
$pattern=/^[a-zA-Z]+$/;
}
else if($first.match(/^[0-9]+$/))
{
$pattern=/^[0-9]+$/;
}

    if ($promail == "") {
        $("#prodmail").html("*Select Mail");
        $("#prodmail").show();
       $(this).css('border', 'solid 3px red');
    }  
    else if(!$promail.match($pattern))
    {
        $("#prodmail").html("*Select Valid Mail box");
        $("#prodmail").show();
       $(this).css('border', 'solid 3px red'); 
    }
   else {
        $("#prodmail").hide();
        $(this).css('border', 'solid 3px green');
        count10=1;
         act();
    }



});

function act(){
    var count=count1+count2+count3+count4+count5+count6+count7+count8+count9+count10;
    console.log(count);
    if(count==10){
    $('.bntn').attr('disabled', false);
}
}



$('.mpriceid').attr('maxlength', 15);
  </script>
</body>

</html>