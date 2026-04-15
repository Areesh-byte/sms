<?php
session_start();
$con=mysqli_connect("localhost","root","","areesh",3307);

$showDashboard=false;
if(isset($_SESSION['admin'])){
$showDashboard=true;
}
if(isset($_POST['logout'])){
session_destroy();
header("Location:index.php");
exit();
}


/* NEW USER REGISTRATION */

if(isset($_POST['newuser'])){

$username=$_POST['username'];
$password=$_POST['password'];

$check=mysqli_query($con,"SELECT * FROM admin WHERE username='$username'");

if(mysqli_num_rows($check)==0){

mysqli_query($con,"INSERT INTO admin(username,password)
VALUES('$username','$password')");

echo "<script>alert('User created successfully');</script>";

}else{

echo "<script>alert('User already exists');</script>";

}

}

/* EXISTING USER LOGIN */

if(isset($_POST['login'])){

$username=$_POST['username'];
$password=$_POST['password'];

$login=mysqli_query($con,"SELECT * FROM admin 
WHERE username='$username' AND password='$password'");

if(mysqli_num_rows($login)>0){

$_SESSION['admin']=$username;
$showDashboard=true;

}else{

echo "<script>alert('Invalid username or password');</script>";

}
}
if(isset($_POST['addstudent'])){

$name=$_POST['name'];
$email=$_POST['email'];
$class=$_POST['class'];
$age=$_POST['age'];

if($name!="" && $email!="" && $class!="" && $age!=""){

$check=mysqli_query($con,"SELECT * FROM student 
WHERE name='$name' AND email='$email'");

if(mysqli_num_rows($check)==0){

$sql="INSERT INTO student(name,email,class,age)
VALUES('$name','$email','$class','$age')";

mysqli_query($con,$sql);

echo "<script>alert('Student added successfully');</script>";

}else{

echo "<script>alert('Student already exists');</script>";

}

}else{

echo "<script>alert('Please fill all fields');</script>";

}

}
if(isset($_POST['assigntask'])){

$student_id=$_POST['student_id'];
$title=$_POST['title'];
$description=$_POST['description'];
$status=$_POST['status'];

if($student_id!="" && $title!="" && $description!="" && $status!=""){

$sql="INSERT INTO task(student_id,title,description,status)
VALUES('$student_id','$title','$description','$status')";

mysqli_query($con,$sql);

echo "<script>alert('Task assigned successfully');</script>";

}else{

echo "<script>alert('Please fill all fields');</script>";

}

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <link rel="stylesheet" href="Gridaan.css">
    <script src="Gridaan.js"></script>
</head>
<body>
   <form id="d1"  action="index.php" method="post" style="<?php if($showDashboard) echo 'display:none'; ?>" >
   <div id="d11">Admin login</div>
   <div id="d12"><div id="d121">Username:</div><div id="d122"><input id="i1" type="text" name="username"></div></div>
   <div id="d13"><div id="d131">Password:</div><div id="d132"><input id="i2" type="password" name="password"></div></div>
   <div id="d14"><button id="b1" type="submit" name="newuser">New us</button><button id="b1" type="submit" name="login">Existing user</button></div>
   </form>
   <div id="d2" style="<?php if(!$showDashboard) echo 'display:none'; ?>" img src="jb.jpg">
   <div id="d21"><div id="d211">STUDENT MANAGEMENT SYSTEM</div></div>
   <div id="d22">
   <div id="d221"><button CLASS="b3" type="button" onclick="studentList()">Student List</button></div>
   <div id="d222"><button class="b3" onclick="addStudent()">Add Student</button></div>
   <div id="d223"><button class="b3" type="button" onclick="assignTask()">Assign Task</button></div>
   <div id="d224"><button class="b3" type="button" onclick="List()">CheckStatus</button></div>
   </div>
   <div id="d23"><form  method="post" ><button class="b3" type="submit" name="logout">logout</button></form></div>
   </div> 
   
   <form id="d3" method="post" style="display:none;">
   <div id="d31"><div style="margin-top: 5%;">Add Student Details</div></div>
   <div id="d32">
   <div id="d321"><div class="d3211">Name:</div><div  ><input class="d3212" type="text" name="name"></div></div>
   <div id="d322"><div class="d3211">Email:</div><div ><input class="d3212" type="text" name="email"></div></div>
   <div id="d323"><div class="d3211">Class:</div><div ><input class="d3212" type="text" name="class"></div></div>
   <div id="d324"><div class="d3211">Age:</div><div ><input class="d3212" type="text" name="age"></div></div>
   </div>
   <div id="d33"><button id="b4" type="submit" name="addstudent">Submit</button><button id="b4" onclick="Back()">Back</button></div>
   </form>
   <form id="d4" method="post" style="display:none;">
   <div id="d31"><div style="margin-top: 5%;">Assign Task</div></div>
   <div id="d32">
   <div id="d321"><div class="d3211">Student_id:</div><div ><input class="d3212" type="text" name="student_id"></div></div>
   <div id="d322"><div class="d3211">Title:</div><div ><input class="d3212" type="text" name="title"></div></div>
   <div id="d323"><div class="d3211">Description:</div><div ><input class="d3212" type="text" name="description"></div></div>
   <div id="d324"><div class="d3211">Status:</div><div ><input class="d3212" type="text" name="status"></div></div>
   </div>
   <div id="d33"><button id="b4" type="submit" name="assigntask">Submit</button><button id="b4" onclick="Back()">Back</button></div>
</form>

   <div id="d5" style="display:none;"> 
   <div id="d51">
<div style="height:30%; padding-top:3%;">Student List</div>
</div>

<div id="d52">

<table style="border:1; color:white; font-size:25px;" width="100%">
<tr>
<th class="t1">ID</th>
<th class="t1">Name</th>
<th class="t1">Email</th>
<th class="t1">Class</th>
<th class="t1">Age</th>
</tr>

<?php
$result = mysqli_query($con,"SELECT * FROM student");

while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td class="t1"><?php echo $row['id']; ?></td>
<td class="t1"><?php echo $row['name']; ?></td>
<td class="t1"><?php echo $row['email']; ?></td>
<td class="t1"><?php echo $row['class']; ?></td>
<td class="t1"><?php echo $row['age']; ?></td>
</tr>

<?php } ?>

</table>
</div>
<div id="d33">
<button id="b4" onclick="Back()">Back</button>
</div>
</div>
</div>

<div id="d6" style="display:none;"> 
   <div id="d51">
<div style="height:30%; padding-top:3%;">Student List</div>
</div>

<div id="d52">

<table style="border:1; color:white; font-size:25px;" width="100%">
<tr>
<th class="t1">ID</th>
<th class="t1">student_id</th>
<th class="t1">Title</Title></th>
<th class="t1">Description</th>
<th class="t1">Status</th>
</tr>

<?php
$result = mysqli_query($con,"SELECT * FROM task");

while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td class="t1"><?php echo $row['id']; ?></td>
<td class="t1"><?php echo $row['student_id']; ?></td>
<td class="t1"><?php echo $row['title']; ?></td>
<td class="t1"><?php echo $row['description']; ?></td>
<td class="t1"><?php echo $row['status']; ?></td>
</tr>

<?php } ?>

</table>
</div>
<div id="d33">
<button id="b4" onclick="Back()">Back</button>
</div>
</div>
</div>
<script src="Gridaan.js"></script>  
</body>
</html>