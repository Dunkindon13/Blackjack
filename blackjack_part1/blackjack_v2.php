
<?php
require_once "balance_pdo.php";
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

    header("location: logout.php");
    exit;
}

echo "original balance: ".$_SESSION['balance'] = 100;
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $_SESSION['bet']=intval($_POST['bet']);
    echo "<br>";
    echo "bet amount: ".$_SESSION['bet'];
    echo "<br>";
    $_SESSION['restbalance'] = $_SESSION['balance']-$_SESSION['bet'];
    echo "new balance: ".$_SESSION['restbalance'];



}*/
error_reporting(0);
$object = new database();
$balance = $object->updateBalance($_SESSION["id"],intval($_POST['bet']));
//echo "<br/>".$balance."<br/>";
$bal = $object->getBalance($_SESSION["id"]);
echo "<br/>"."new balance: ".$bal;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blackjack Game</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="main.css">
</head>
<body>

<div class="game" contenteditable="false">
    <h3 contenteditable="false">Blackjack</h3>

        <form method="post" action="blackjack_v2.php">
        <input type="number" name="bet" placeholder="enter bet amount">
        <input type="submit" name="sumbit" value="submit">
    </form>

    <div class="game-body" contenteditable="false">
        <div class="game-options" contenteditable="false">
            <input type="button" id="btnStart" class="btn" value="Start" onclick="startblackjack()">
            <input type="button" class="btn" value="Hit Me" onclick="hitMe()">
            <input type="button" class="btn" value="Stay" onclick="stay()">
        </div>

        <div class="status" id="status" contenteditable="false"></div>

        <div id="deck" class="deck" contenteditable="false">
            <div id="deckcount" contenteditable="false">52</div>
        </div>

        <div class="deck" contenteditable="false">
        </div>
        <div id="players" class="players" contenteditable="false">
        </div>

        <div class="clear" contenteditable="false"></div>
    </div>
</div>
<script src="main.js" async defer></script>

<a href="logout.php" class="">Log out</a>

</body>
</html>
