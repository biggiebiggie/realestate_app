<?php
session_start();
session_destroy();
header("Location: index.php");
echo '{"status":1, "message":"logged out"}';

