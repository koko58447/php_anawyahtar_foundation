<?php 

session_start();

$con=new mysqli("localhost","root","root","anh");
//$con=new mysqli("107.6.158.222","kyawmtun_admin","kyoungunity007","kyawmtun_anh");
mysqli_set_charset($con,"utf8");

date_default_timezone_set("Asia/Rangoon");

define('root',__DIR__.'/');

define('roothtml','http://localhost/anh/');

//define('roothtml','https://kyoungunity.com/anh/');

define('curlink',basename($_SERVER['SCRIPT_NAME']));


function GetString($sql)
{

    global $con;
    $str="";   
    $result=mysqli_query($con,$sql) or die("Query Fail");
    if(mysqli_num_rows($result)>0){

        $row = mysqli_fetch_array($result);
       $str= $row[0];
    }

    return $str;

}

function load_student()
{
    global $con;
    $sql="select * from tblstudent";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Student_Name"]}</option>";
    }
    return $out;
}

function load_teacher()
{
    global $con;
    $sql="select * from tblteacher";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Name"]}</option>";
    }
    return $out;
}


function load_donater()
{
    global $con;
    $sql="select * from tbldonater";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Name"]}</option>";
    }
    return $out;
}

function load_category()
{
    global $con;
    $sql="select * from tblcategory";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Name"]}</option>";
    }
    return $out;
}



function save_log($des)
{
    global $con;
    $dt=date("Y-m-d H:i:s");
    $userid=$_SESSION['userid'];
    $sql="insert into tbllog (Description,UserID,Date) values ('{$des}'
    ,$userid,'{$dt}')";
    mysqli_query($con,$sql);   
}

function toMyanmar($number)
{
        $array = [
            '0' => '၀',
            '1' => '၁',
            '2' => '၂',
            '3' => '၃',
            '4' => '၄',
            '5' => '၅',
            '6' => '၆',
            '7' => '၇',
            '8' => '၈',
            '9' => '၉',
        ];
        return strtr($number, $array);
}


function toEnglish($number)
{
        $array = [
            '၀' => '0',
            '၁' => '1',
            '၂' => '2',
            '၃' => '3',
            '၄' => '4',
            '၅' => '5',
            '၆' => '6',
            '၇' => '7',
            '၈' => '8',
            '၉' => '9',
        ];
        return strtr($number, $array);
}

function mmDate($date)
{
    $date = date_create($date);
    $date = date_format($date,"d-m-Y");
    return toMyanmar($date);
}

function enDate($date)
{
    $date = date_create($date);
    $date = date_format($date,"d-m-Y");
    return $date;
}

function getTotalYear($date) {
    return date_diff(date_create($date), date_create('now'))->y;
}

function pretty_filesize($file) {
    $size=filesize($file);
    if($size<1024){$size=$size." Bytes";}
    elseif(($size<1048576)&&($size>1023)){$size=round($size/1024, 1)." KB";}
    elseif(($size<1073741824)&&($size>1048575)){$size=round($size/1048576, 1)." MB";}
    else{$size=round($size/1073741824, 1)." GB";}
    return $size;
}




?>