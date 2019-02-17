
<?php
require_once "balance_pdo.php";
session_start();
if (! isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: logout.php");
    exit();
}
echo "original balance: " . $_SESSION['balance'] = 100;

error_reporting(0);
$object = new database();
$balance = $object->updateBalance($_SESSION["id"], intval($_POST['bet']));
// echo "<br/>".$balance."<br/>";
$bal = $object->getBalance($_SESSION["id"]);
echo "<br/>" . "new balance: " . $bal;
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Blackjack Game</title>
<meta name="description" content="">
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
	integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
	crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="main.css">
</head>
<body>

	<div class="game" contenteditable="false">
		<h3 contenteditable="false">Blackjack</h3>

		<form method="post" action="blackjack_V3.php">
			<input type="number" name="bet" placeholder="enter bet amount"> <input
				type="submit" name="submit" value="submit">
		</form>

		<div class="game-body" contenteditable="false">
			<div class="game-options" contenteditable="false">
				<input type="button" id="btnStart" class="btn" value="Start"
					onclick="startblackjack()"> <input type="button" class="btn"
					value="Hit Me" onclick="hitMe()"> <input type="button" class="btn"
					value="Stay" onclick="stay()">
			</div>

			<div class="status" id="status" contenteditable="false"></div>

			<div id="deck" class="deck" contenteditable="false">
				<div id="deckcount" contenteditable="false">52</div>
			</div>

			<div class="deck" contenteditable="false"></div>
			<div id="players" class="players" contenteditable="false"></div>
			<div id="balance" class="balance" contenteditable="false">
				Balance:
				<div id="amountLeft" contenteditable="false">100</div>
			</div>
			<input id="betNum" type="number" placeholder="Bet Amount" size=10>

			<div id="cardCount" class="cardCount" contenteditable="false">
				Current Card Count:
				<div id="currentCount" contenteditable="false">0</div>
			</div>

			<input id="numPlayers" name="playerNum" type="number"
				placeholder="Number of Players" min="1" size=20>

			<div id="dealer" class="dealer"></div>
			<div id="players" class="players"></div>

			<span id="message" style="color: #600; font-weight: bold"></span>

			<div class="clear" contenteditable="false"></div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
		integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
		crossorigin="anonymous"></script>
	<script
		src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
		integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
		crossorigin="anonymous"></script>
	<script src="main.js" async defer></script>

	<a href="logout.php" class="">Log out</a>

</body>
</html>