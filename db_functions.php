<?php
 function connectToDB() {
    return mysqli_connect('localhost', 'root', '', 'InstaCloneDB');
}
?>