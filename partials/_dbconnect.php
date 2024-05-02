<?PHP
$server = "localhost";
$username = "root";
$password = "";
$database = "users";

$conn = mysqli_connect($server, $username, $password, $database);
if(!$conn)
{
//     echo "Connected successfully!";
// }
// else
// {
    die("Error! sorry you failed to connect ".mysqli_connect_error());
}


?>