<?PHP
include_once ".env.php";
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);
if(!$con) {
    exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");
}
if(isset($_GET['ID'])) {
    $courseID=$_GET['ID'];
    $query="DELETE FROM `courses2` WHERE `id` = $courseID";
    $result=mysqli_query($con,$query);
    if(!result)
        echo "<p>failed</p>";
    else
        header('location:courses.php');
}