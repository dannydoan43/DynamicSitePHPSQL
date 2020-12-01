<?PHP
include_once "delete.php";
include_once ".env.php";
echo "<div><a href='./index.php'> Back to Index</a></div>
<table style='width:50%'>
    <tr>
        <th>Course Number</th>
        <th>Course Name</th>
        <th>Description</th>
        <th>Final Grade</th>
        <th>Delete Course</th>
    </tr>";

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);
$currently_enrolled=1;
$identifier='';

if(!$con) {
    exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");
}
$query2 = "SELECT * FROM courses";
$result2 = mysqli_query($con,$query2);
if(!$result2)
    echo "<p>failed</p>";

while($row=mysqli_fetch_assoc($result2)) {
    if($row['enrolled'] == 'yes') {
        $enrolledarea='enrolled';
    } else {
        $enrolledarea='';
    }
    echo "<tr class='$enrolledarea'><td>$row[cnum]</td><td>$row[cname]</td><td>$row[description]</td><td>$row[fgrade]</td><td><a href=delete.php?ID={$row['id']}>Delete</a></td></tr>";
    $identifier=$row['cnum'];
}
echo "</table>";

$stmt = mysqli_stmt_init($con);
if(!$stmt)
    exit("<p class='error'>Failed to initialize statement</p>");

if(isset($_POST['addbutton'])) {
    $query1 = "INSERT INTO courses (cname,cnum,description,fgrade, enrolled) VALUES (?,?,?,?,?)";
    if(!mysqli_stmt_prepare($stmt,$query1))
        exit("<p class='error'>Failed to prepare statement</p>");
    mysqli_stmt_bind_param($stmt,"sssis", $courseName,$courseNum,$cDescription,$finalg,$enrolled);
    $courseNum=$_POST['course_num'];
    $courseName=$_POST['course_name'];
    $cDescription=$_POST['cDescription'];
    $finalg=$_POST['final_grade'];
    $enrolled=$_POST['enrollmentBox'];
    if(isset($_POST['enrollmentBox']))
        $enrolled=$_POST['enrollmentBox'];
    else
        $enrolled='no';
    if(mysqli_stmt_execute($stmt))
        echo("<p>Inserted $courseName</p>");
    else
        echo("<p class='error'>Failed to insert $courseName</p>");
    header('location:courses.php');
}
mysqli_stmt_close($stmt);
mysqli_close($con);

echo "<html lang='en-US'>
<head>
    <link href=assign3.css rel=stylesheet type=text/css />
    <title>
        Courses Page
    </title>
</head>
<body>
<hr>
<form action='courses.php' method ='POST'>
    <div>
        <label for='course_name'>Course Name</label>
        <input type='text'
               id='course_name' name='course_name'>
    </div>
    <br>
    <div>
        <label for='course_num'>Course Number</label>
        <input type='text'
               id='course_num' name='course_num'>
    </div>
    <br>
    <div>
        <label for='cDescription'>Description</label>
        <input type='text'
               id='cDescription' name='cDescription'>
    </div>
    <br>
    <div>
        <label for='final_grade'>Final Grade</label>
        <input type='text'
               id='final_grade' name='final_grade'>
    </div>
    <div>
    <br>
    Currently Enrolled?
    <br>
        <label for='enrollment_box'>YES</label>
        <input type='checkbox' value='yes' name='enrollmentBox'>
        <label style='padding-left:25px' for='enrollment_box2'>NO</label>
        <input type='checkbox' value='no' name='enrollNo'>
    </div>
    <br>
    <div>
        <input type='submit' value='Add Course' name='addbutton'>
    </div>
</form>
</body>
</html>";