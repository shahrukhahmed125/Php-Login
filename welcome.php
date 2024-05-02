<?PHP

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: login.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - <?PHP echo $_SESSION['username']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>

<body>
    <?PHP
    require 'partials/_nav.php';
    ?>
    <!-- <h1 class="display-1">Welcome - <?PHP //echo $_SESSION['username']; ?></h1> -->
    <div class="container my-5">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcome - <?PHP echo $_SESSION['username']; ?></h4>
            <p>Aww yeah, you successfully logged in as <?PHP echo $_SESSION['username']; ?>. This is iSecure dashboard for you to run a bit your secure work here.</p>
            <hr>
            <p class="mb-0">Whenever you need to leave, make sure to logout the account.</p><br>
            <a href="/Login_System_PHP/logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</html>