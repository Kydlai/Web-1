<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="design.css">
</head>
<body body background="https://st2.depositphotos.com/3649705/5390/v/450/depositphotos_53908951-stock-illustration-wave-line-flag-of-russia.jpg">
    <?php
        session_start();
        $t = $_SESSION['t'];
        if($t == !0)
            include "index.html";
    ?>
    <table>
        <?php
            echo $_SESSION["table"];
        ?>
    </table>
</body>
</html>