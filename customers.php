<?php
error_reporting(0);

$serverName = "localhost";
$userName = "root";
$password = "Passw0rd";
$dbName = "sakila";

// Create connection
$conn = new mysqli($serverName, $userName, $password, $dbName);
// Check connection
if ($conn->connect_error) {
    printJSON($conn->connect_error, 1);
} else {
    getCustomers($conn);
}

function getCustomers($conn) {

    $sql = 'SELECT  customer_id AS CustomerID, first_name AS Name, last_name AS LastName, email AS Email FROM sakila.customer';

    $res = mysqli_query($conn,$sql);

    $result = array();

    while ($row = mysqli_fetch_array($res)) {
        array_push($result,
            array("CustomerID"=>$row[0],'Name'=>$row[1],'LastName'=>$row[2],'Email'=>$row[3]));
    }

    printJSON($result, 0);
}

function printJSON($result, $code) {
    echo json_encode(array(
        "code" => $code,
        "result" => $result)
    );
    exit(0);
}
