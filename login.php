<?PHP

$login = false;
$showError = false;

// PASSWORD WITHOUT HASH

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     include 'partials/_dbconnect.php';
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
//     $result = mysqli_query($conn, $sql);

//     $num = mysqli_num_rows($result);
//     if ($num == 1) {
//         $login = true;
        
//         session_start();
//         $_SESSION['loggedin'] = true;
//         $_SESSION['username'] = $username;
//         header("Location: welcome.php");
//     }
//     else
//     {
//         $showError = true;
//     }
// }

// PASSWORD WITH HASH

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    
     
    // $sql = "Select * from users where username='$username' AND password='$password'";
    $sql = "Select * from users where username='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        while($row=mysqli_fetch_assoc($result)){
            if (password_verify($password, $row['password'])){ 
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("location: welcome.php");
            } 
            else{
                $showError = "Invalid Credentials";
            }
        }
        
    } 
    else{
        $showError = "Invalid Credentials";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

    if ($login) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You are logged in.
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
            Login to our website
        </h1>
        <br>
        <form action="/Login_System_PHP/login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-success col-12">Login</button>
        </form>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</html>