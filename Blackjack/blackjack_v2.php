
<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

    header("location: logout.php");
    exit;
}
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
            Balance:<div contenteditable="false">100</div>
        </div>
        <div id="players" class="players" contenteditable="false">
        </div>

        <div class="clear" contenteditable="false"></div>
    </div>
</div>
<script src="main.js" async defer></script>

<a href="logout.php" class="">Log out</a>
</form>
</body>
</html>
