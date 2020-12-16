<?php
require_once ('Dbcon.php');
session_start();
class User
{
    public $name,$phone,$ques,$ans,$password,$email,$password2;

    function signup($name,$phone,$ques,$ans,$password,$email, $password2, $conn)
    {
        $_SESSION['signup']['email']=$email;
        $_SESSION['signup']['phone']=$phone;
        if ($password != $password2)
        {
            echo "<center><h2 style='color:white;font-size:20px;background-color:lightblue;'>Password doesn't match</h2></center>";
            return;
        }
        $sql1 = "SELECT * from tbl_user WHERE email='" . $email . "' 
    OR name='" . $name . "'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0)
        {
            echo "<center><h2 style='color:white;font-size:20px;background-color:lightblue;'>User already present</h2></center>";

        }
        else
        {
            $sql = "INSERT INTO tbl_user (email,name, mobile,is_admin, password, security_question,security_answer) 
            VALUES('$email' ,'$name','$phone',0, MD5('$password'), '$ques','$ans')";
       
            if ($conn->query($sql) === true)
            {
                
               header("Location:aftersignup.php");
            }
            else
            {
            	echo $conn->error;
                echo "DB Error";
            }

            $conn->close();
        }

    }
    function login($email, $password, $conn)
    {
        $count = 0;
        if ($count == 0)
        {
            $sql = "SELECT * FROM tbl_user WHERE 
            email='$email' and password= md5('$password')";
            // echo $sql;
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $_SESSION['userdata'] = array(
                        'email' => $row['email'],
                        'user_id' => $row['id'],
                        'name'=>$row['name'],
                        'phone'=>$row['mobile']
                    );
                

                if ($row['is_admin'] == '1')
                {
                    $_SESSION['admindata']=array(
                        'email' => $row['email']
                    );
                    header("Location:admin/dash.php");
                }
                if ($row['is_admin'] == '0')
                {
                    if ($row['active'] == '1')
                    {
                        header("Location: index.php");
                    }
                    else
                    {
                        echo "<center><p style='color:white;font-size:20px;background-color:lightblue;' >Your Request is under process you will be able to login once admin approves</p></center>";
                    }

                }
            }
            }
            else
            {
                echo "<center><p style='color:white;
                        background-color:lightblue;font-size:20px;' >Invalid username or password</p></center>";
            }
        }
        $conn->close();
    }


    function verify($inotp,$m,$ver,$conn)
    {
            if($ver=="mail")
            {
              
                $sql="UPDATE `tbl_user` SET `email_approved`='1' where `email`=$m";
            
              
                if($conn->query($sql)==true)
                {
                
                    echo "<script>alert('ayaaaa')</script>";
                    echo "<script>alert('Email verified successfully..!')</script>";
                    header("Location:login.php");
                }
            }
            elseif($ver=="phone")
            {
                echo "<script>alert('ayaaaa')</script>";

                $sql="UPDATE `tbl_user` SET `phone_approved`='1' where `email`=$m";
                if($conn->query($sql)===true)
                {
                    echo "<script>alert('Phone number verified successfully..!')</script>";
                    header("Location:login.php");
                }
            }
        
        }







}













