<?php
echo "Hello, this is a test.";
var_dump($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form data
    // ...
}
else{
    echo "HIIIIIIIII";
}
?>
