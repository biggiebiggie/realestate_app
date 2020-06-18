<?php

require('functions.php');
session_start();

if($_SESSION) {
$userId = $_GET['id'];
$user = $_SESSION['$jUser'];

if($user->isAgent == 1) {
    $jData = getFileAsJson(__DIR__.'/agent/agents.json');
    
    unset( $jData->$userId );
    // echo json_encode( $jData , JSON_PRETTY_PRINT );
    saveJsonToFile($jData,__DIR__.'/agent/agents.json');
    session_destroy(); // MUST HAVE THIS ON THIS END POINT
    echo '{"status":1, "message":"agent deleted", "line":'.__LINE__.'}';

    header('Location: index.php');
    
} else if ($user->isAgent == 0) {
    $jData = getFileAsJson(__DIR__.'/user/users.json');

    unset( $jData->$userId );
    // echo json_encode( $jData , JSON_PRETTY_PRINT );
    saveJsonToFile($jData,__DIR__.'/user/users.json');
    session_destroy(); // MUST HAVE THIS ON THIS END POINT
    echo '{"status":1, "message":"agent deleted", "line":'.__LINE__.'}';

    header('Location: index.php');
}
}