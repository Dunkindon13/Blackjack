<form name="form1" method="post">
	<input type="submit" name="start" value="Start">
</form>

<?php
session_start();

// ********** GIVE A CARD (to player or dealer) ********************
function giveCard($gets)
{
    while (true) {
        $n = rand(0, 51 * $_SESSION['decks']);
        if ($_SESSION['deck'][$n] != "*") {
            array_push($_SESSION[$gets], $_SESSION['deck'][$n]);
            $_SESSION['deck'][$n] = "*";
            break;
        }
    }
}

// ************ CLICKING THE START BUTTON - choose number of decks and games ********//
if (isset($_POST['start'])) {
    ?>
<form name="startForm" method="post">
	Number of Decks <input type="text" name="decks"><br> Number of Games <input
		type="text" name="games"><br> <input type="submit" name="play"
		value="Play">
</form>
<?php
}

// CLICKING the PLAY button - make the initial settings of the game
if (isset($_POST['play'])) {
    $_SESSION['list'] = [];
    $_SESSION['decks'] = $_POST['decks'];
    $_SESSION['games'] = $_POST['games'];

    // initializing the games
    for ($i = 1; $i <= $_SESSION['games']; $i ++) {
        $game = "game" . $i;
        $_SESSION['list'][$i - 1] = $game; // populating the list of games
        $_SESSION[$game] = [];
    }
    $_SESSION['dealer'] = []; // initiating the dealer

    // the deck
    $a = [
        "A",
        "A",
        "A",
        "A",
        2,
        2,
        2,
        2,
        3,
        3,
        3,
        3,
        4,
        4,
        4,
        4,
        5,
        5,
        5,
        5,
        6,
        6,
        6,
        6,
        7,
        7,
        7,
        7,
        8,
        8,
        8,
        8,
        9,
        9,
        9,
        9,
        10,
        10,
        10,
        10,
        "J",
        "J",
        "J",
        "J",
        "Q",
        "Q",
        "Q",
        "Q",
        "K",
        "K",
        "K",
        "K"
    ]; // a single deck
    $b = [];
    for ($i = 1; $i <= $_SESSION['decks']; $i ++) {
        $b = array_merge($b, $a);
    }
    $_SESSION['deck'] = $b; // initializing the total number of decks

    // MAKE THE INITIAL DISRIBUTION //
    // 2 cards to each game
    for ($i = 1; $i <= sizeof($_SESSION['list']); $i ++) {
        $game = "game" . $i;
        for ($j = 1; $j <= 2; $j ++) {
            giveCard($game);
        }
    }
    // 2 cards to the dealer

    for ($j = 1; $j <= 2; $j ++) {
        giveCard("dealer");
    }
}

// ********* HITTING *************//
?>
<form name="hittingform" method="post">
	HIT GAME<input type="text" name="hit"><input type="submit" name="bt2"
		value="HIT">
</form>
<?php
if (isset($_POST['bt2']))
    giveCard($_POST['hit']);

// ******** ACE CONVERSION *********//
?>
<form name="aceform" method="post">
	CONVERT FOR GAME<input type="text" name="acegame"><input type="radio"
		name="ace" value="1">1 <input type="radio" name="ace" value="11">11<input
		type="submit" name="bt3" value="Convert Ace">
</form>
<?php
if (isset($_POST['bt3'])) {
    $c = 0;
    for ($i = 0; $i < sizeof($_SESSION[$_POST['acegame']]); $i ++) {
        if ($_SESSION[$_POST['acegame']][$i] == "A") {
            $_SESSION[$_POST['acegame']][$i] = $_POST['ace'];
            $c += 1;
        }
        if ($c > 0)
            break;
    }
}

// *************** SPLIT ***********************//
?>
<form name="splitform" method="post">
	SPLIT GAME<input type="text" name="split"><input type="submit"
		name="bt4">
</form>
<?php

if (isset($_POST['bt4'])) {
    if ($_SESSION[$_POST['split']][0] == $_SESSION[$_POST['split']][1] and sizeof($_SESSION[$_POST['split']]) == 2) {
        $new1 = $_POST['split'] . "1";
        $new2 = $_POST['split'] . "2";

        array_push($_SESSION['list'], $new1, $new2);
        $_SESSION[$new1] = [];
        $_SESSION[$new2] = [];
        $_SESSION[$new1][0] = $_SESSION[$_POST['split']][0];
        $_SESSION[$new2][0] = $_SESSION[$_POST['split']][1];
        giveCard($new1);
        giveCard($new2);
        unset($_SESSION[$_POST['split']]);
    }
}

// **************** DEALER'S TURN *******************//
?>
<form name="form1" method="post">
	Dealer's Turn<input type="submit" name="bt5" value="Dealer">
</form>
<?php

if (isset($_POST['bt5'])) {
    for ($i = 0; $i < sizeof($_SESSION['dealer']); $i ++) {
        if ($_SESSION['dealer'][$i] == "A" and $_SESSION['sumdealer'] + 11 < 22) {
            $_SESSION['dealer'][$i] = 11;
            dealerSum();
        } elseif ($_SESSION['dealer'][$i] == "A" and $_SESSION['sumdealer'] + 11 > 21) {
            $_SESSION['dealer'][$i] = 1;
            dealerSum();
        }
    }
    if ($_SESSION['sumdealer'] < 17)
        giveCard("dealer");
}

// ************** CALCULATING THE SUM OF THE CARDS OF THE GAMES ***************//
for ($i = 0; $i < sizeof($_SESSION['list']); $i ++) {
    $game = $_SESSION['list'][$i];
    $sum = "sum" . $game;
    $_SESSION[$sum] = 0;
    for ($j = 0; $j < sizeof($_SESSION[$game]); $j ++) {
        if ($_SESSION[$game][$j] == "J" or $_SESSION[$game][$j] == "Q" or $_SESSION[$game][$j] == "K")
            $_SESSION[$sum] += 10;
        elseif ($_SESSION[$game] != "A")
            $_SESSION[$sum] += $_SESSION[$game][$j];
    }
}
// Dealer's sum
dealerSum();

function dealerSum()
{
    $_SESSION['sumdealer'] = 0;
    for ($i = 0; $i < sizeof($_SESSION['dealer']); $i ++) {
        if ($_SESSION['dealer'][$i] == "J" or $_SESSION['dealer'][$i] == "Q" or $_SESSION['dealer'][$i] == "K")
            $_SESSION['sumdealer'] += 10;
        elseif ($_SESSION['dealer'][$i] != "A")
            $_SESSION['sumdealer'] += $_SESSION['dealer'][$i];
    }
}

// ***************************** SEEING THE CARSDS **********************************//
print_r($_SESSION['list']);
echo "<br><br>";

// deck
for ($i = 0; $i < sizeof($_SESSION['deck']); $i ++) {
    echo $_SESSION['deck'][$i] . ",";
}
echo "<br><br>";

// games
for ($k = 1; $k <= $_SESSION['games']; $k ++) {
    for ($i = 0; $i < sizeof($_SESSION['list']); $i ++) {
        if ($k == substr($_SESSION['list'][$i], 4, 1)) {
            $game = $_SESSION['list'][$i];
            $sum = "sum" . $game;
            echo $_SESSION['list'][$i] . ": ";
            print_r($_SESSION[$_SESSION['list'][$i]]);
            echo " Sum: " . $_SESSION[$sum];
            echo "<br>";
        }
    }
}
// dealer
echo "dealer: ";
print_r($_SESSION['dealer']);
echo " Sum: " . $_SESSION['sumdealer'];
echo "<br>";

?>
