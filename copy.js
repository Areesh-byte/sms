/*<?php
$server="localhost";
$username="root";
$password="";
$database="areesh";
$port=3307;
$con= mysqli_connect($server,$username,$password,$database,$port);
if(!$con){
    die("connection to this database failed due to" .
    mysqli_connect_error());
}
//echo "success connecting to the db";
$username=$_POST['username'];
$password=$_POST['password'];
$sql="INSERT INTO admin('username','password')VALUES('$username','$password');";
echo $sql;
?>*/
function firstPage(){
    document.getElementById("d2").style.display="none";
    document.getElementById("d1").style.display="block";
    document.getElementById("d3").style.display="none";
    document.getElementById("d4").style.display="none";
}
function SignUp(){
    document.getElementById("d1").style.display="none";
    document.getElementById("d2").style.display="block";
    document.getElementById("d3").style.display="none";
    document.getElementById("d4").style.display="none";
}
function addStudent(){
  document.getElementById("d2").style.display="none";
    document.getElementById("d1").style.display="none";  
    document.getElementById("d3").style.display="block";
    document.getElementById("d4").style.display="none";
}
function assignTask(){
   document.getElementById("d2").style.display="none";
    document.getElementById("d1").style.display="none";  
    document.getElementById("d3").style.display="none"; 
    document.getElementById("d4").style.display="block";
}
function Back(){
    document.getElementById("d3").style.display="none";
    document.getElementById("d4").style.display="none";
    document.getElementById("d2").style.display="block";
}
<?php
$con = mysqli_connect("localhost","root","","areesh",3307);

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO admin(username,password) VALUES('$username','$password')";
    mysqli_query($con,$sql);
    
}?>


<?php
$con = mysqli_connect("localhost","root","","areesh",3307);

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con,$sql);

    if(mysqli_num_rows($result) > 0){
        echo "<script>SignUp();</script>"; // show dashboard
    }else{
        echo "<script>alert('Invalid login');</script>";
    }
}
?>

<button id="b1" type="button" onclick="SignUp()">Sign up</button>