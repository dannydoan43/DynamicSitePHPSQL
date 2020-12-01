<?PHP
include_once ".env.php";
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);
if(!$con) {
    exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");
}
$stmt = mysqli_stmt_init($con);
if(!$stmt)
    exit("<p class='error'>Failed to initialize statement</p>");

if(isset($_GET['ID'])) {
    $query="DELETE FROM `courses` WHERE `id` = ?";
    if(!mysqli_stmt_prepare($stmt,$query))
        exit("<p class='error'>Failed to prepare statement</p>");
    mysqli_stmt_bind_param($stmt,"i", $courseID);
    $courseID=$_GET['ID'];
    if(mysqli_stmt_execute($stmt))
        echo("<p>Deleted $courseID</p>");;
    if(!result)
        echo "<p>failed to delete</p>";
    else
        header('location:courses.php');
}