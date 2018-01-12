<?php
error_reporting(0);

require_once ("DB.class.php");

$conn = Db::getInstance();

$sql = "SELECT  customer_id AS CustomerID, first_name AS Name, last_name AS LastName, email AS Email FROM sakila.customer";
$res = $conn->ejecutar($sql);

if (mysqli_connect_errno()) {
    printJSON(array("msg"=>mysqli_connect_error()), 1);
} else {
    printJSON(getCustomers($conn, $res),0 );
}


/**
 * @param DB $conn
 * @param mysqli_result $sql
 * @return array
 */
function getCustomers(DB $conn, mysqli_result $sql) {
    $result = array();

    while ($row = $conn->obtener_fila($sql, 0)) {
        array_push($result, array("CustomerID"=>$row[0],'Name'=>$row[1],'LastName'=>$row[2],'Email'=>$row[3]));
    }

    return $result;
}

/**
 * @param array $res
 * @param int $code
 */
function printJSON(array $res, int $code) {
    echo json_encode(array(
            "code" => $code,
            "result" => $res)
    );
    exit(0);
}
