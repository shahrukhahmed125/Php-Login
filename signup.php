<?PHP

$showAlert = false;
$showError = false;

// PASSWORD WITHOUT HASH

// if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {

//     include 'partials/_dbconnect.php';
    
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     $cpassword = $_POST['cpassword'];

//     // check wheather the username already exists or not
//     $existSql = "SELECT * FROM `users` WHERE username = '$username'";
//     $result = mysqli_query($conn, $existSql);
//     $numExistRow = mysqli_num_rows($result);

//     if($numExistRow > 0)
//     {
//         $showError = "Username already exists.";
//     }
//     else
//     {
//         if (($password == $cpassword)) {
//             $sql = "INSERT INTO `users`(`username`, `password`, `dt`) VALUES ('$username','$password',current_timestamp())";
//             $result = mysqli_query($conn, $sql);
//             if ($result) {
//                 $showAlert = true;
//                 // header("Location: welcome.php");
//             }
//         }
//         else
//         {
//             $showError = "Password do not match.";
//         }
//     }

// }

// PASSWORD WITH HASH

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    // $exists=false;

    // Check whether this username exists
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError = "Username Already Exists";
    }
    else{
        // $exists = false; 
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
            }
        }
        else{
            $showError = "Passwords do not match";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<style>
    .container {

        background-color: whitesmoke;
        border-radius: 30px;
        margin: auto;
        width: 40%;
        padding: 5%;
    }
</style>

<body>

    <?PHP
    require 'partials/_nav.php'; 

    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your account has been created.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if ($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> '.$showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>


    <div class="container my-5">
        <h1 class="display-5">
            Signup to our website
        </h1>
        <br>
        <form action="/Login_System_PHP/signup.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <div id="emailHelp" class="form-text">Make sure to enter the same password.</div>
            </div>
            <button type="submit" class="btn btn-success col-12">SignUp</button>
        </form>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</html>