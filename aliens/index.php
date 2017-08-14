<?php session_start();

// Size for the playing area
const WIDTH = 15;
const HEIGHT = 15;
const AMOUNTOFALIENS = 3;

// design resources
$alien = 'resources/alien.png';
$ripley = 'resources/ripley.png';


// Set Ripley's and Alien's first position, if there is not session entry)
if (!isset($_SESSION["ripleypos"])) {
    $_SESSION["ripleyLives"] = 3;
    $_SESSION["ripleypos"] = $ripleypos = array("x" => rand(0, WIDTH), "y" => rand(0, HEIGHT));
    $_SESSION["alienpos"] = $alienpos = array("x" => rand(0, WIDTH), "y" => rand(0, HEIGHT));
    $_SESSION["alienpos2"] = $alienpos2 = array("x" => rand(0, WIDTH), "y" => rand(0, HEIGHT));
    $_SESSION["alienpos3"] = $alienpos3 = array("x" => rand(0, WIDTH), "y" => rand(0, HEIGHT));
    $_SESSION["runningCounter"] = 0;
    $_SESSION["ID"] = session_id();

    // create positons for aliens
    for ($count = 0; $count < AMOUNTOFALIENS; $count++) {
        $_SESSION["alienpositions"] = array("alien" . $count => "alien" . $count, "x" => rand(0, WIDTH), "y" => rand(0, HEIGHT));

    }

}

// Positions
$ripleypos = $_SESSION["ripleypos"];

$alienpos = $_SESSION["alienpos"];
$alienpos2 = $_SESSION["alienpos2"];
$alienpos3 = $_SESSION["alienpos3"];

// If user run with Ripley, set her new position
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION["runningCounter"] = $_SESSION["runningCounter"] + 1;

    $position = explode(".", $_POST['position']);

    // Ripley Movement
    if ($ripleypos["x"] < $position[0]) {
        $ripleypos["x"] = $position[0];
        $_SESSION["ripleypos"] = $ripleypos;
    }
    if ($ripleypos["x"] > $position[0]) {
        $ripleypos["x"] = $position[0];
        $_SESSION["ripleypos"] = $ripleypos;
    }

    if ($ripleypos["y"] > $position[1]) {
        $ripleypos["y"] = $position[1];
        $_SESSION["ripleypos"] = $ripleypos;
    }
    if ($ripleypos["y"] < $position[1]) {
        $ripleypos["y"] = $position[1];
        $_SESSION["ripleypos"] = $ripleypos;
    }

    // Alien  Movement
    if ($ripleypos["x"] < $alienpos["x"]) {
        $alienpos["x"] = $alienpos["x"] - 1;
        $_SESSION["alienpos"] = $alienpos;
    }

    if ($ripleypos["x"] > $alienpos["x"]) {
        $alienpos["x"] = $alienpos["x"] + 1;
        $_SESSION["alienpos"] = $alienpos;
    }

    if ($ripleypos["y"] < $alienpos["y"]) {
        $alienpos["y"] = $alienpos["y"] - 1;
        $_SESSION["alienpos"] = $alienpos;
    }

    if ($ripleypos["y"] > $alienpos["y"]) {
        $alienpos["y"] = $alienpos["y"] + 1;
        $_SESSION["alienpos"] = $alienpos;
    }

    // Alien2  Movement
    if ($ripleypos["x"] < $alienpos2["x"]) {
        $alienpos2["x"] = $alienpos2["x"] - 1;
        $_SESSION["alienpos2"] = $alienpos2;
    }

    if ($ripleypos["x"] > $alienpos2["x"]) {
        $alienpos2["x"] = $alienpos2["x"] + 1;
        $_SESSION["alienpos2"] = $alienpos2;
    }

    if ($ripleypos["y"] < $alienpos2["y"]) {
        $alienpos2["y"] = $alienpos2["y"] - 1;
        $_SESSION["alienpos2"] = $alienpos2;
    }

    if ($ripleypos["y"] > $alienpos2["y"]) {
        $alienpos2["y"] = $alienpos2["y"] + 1;
        $_SESSION["alienpos2"] = $alienpos2;
    }

    // Alien3  Movement
    if ($ripleypos["x"] < $alienpos3["x"]) {
        $alienpos3["x"] = $alienpos3["x"] - 1;
        $_SESSION["alienpos3"] = $alienpos3;
    }

    if ($ripleypos["x"] > $alienpos3["x"]) {
        $alienpos3["x"] = $alienpos3["x"] + 1;
        $_SESSION["alienpos3"] = $alienpos3;
    }

    if ($ripleypos["y"] < $alienpos3["y"]) {
        $alienpos3["y"] = $alienpos3["y"] - 1;
        $_SESSION["alienpos3"] = $alienpos3;
    }

    if ($ripleypos["y"] > $alienpos3["y"]) {
        $alienpos3["y"] = $alienpos3["y"] + 1;
        $_SESSION["alienpos3"] = $alienpos3;
    }


    if ($_SESSION["runningCounter"] === 10 && $_SESSION["ripleyLives"] > 0 && ($ripleypos != $alienpos || $ripleypos != $alienpos2 || $ripleypos != $alienpos3)) {

        playerWon();

    }

    if ($ripleypos == $alienpos || $ripleypos == $alienpos2 || $ripleypos == $alienpos3) {
        $alienkiller = null;
        if ($ripleypos == $alienpos) {
            $alienkiller = "Alien";
        }

        if ($ripleypos == $alienpos2) {
            $alienkiller = "Alien 2";
        }

        if ($ripleypos == $alienpos3) {
            $alienkiller = "Alien 3";
        }

        playerDied($alienkiller);
    }

}

/*
 * Player won, reset the game
 */
function playerWon()
{
    echo "<div class=\"winner\">YOU ESCAPED! New Game start by click!<div>";

    resetGame();
}

/**
 * Player died, reset the game
 * @param $alienkiller
 */
function playerDied($alienkiller)
{
    echo "<div class=\"loser\">YOU DIED! Killed by $alienkiller - New Game start by click!<div>";
    $_SESSION["ripleyLives"] = 0;
    resetGame();
}

/**
 * Reset the game, start a new round
 */
function resetGame()
{
    $_SESSION["runningCounter"] = 0;
    session_regenerate_id();
    $_SESSION["NEWID"] = session_id();
    $_SESSION["ripleypos"] = null;
}

?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<span><img src="resources/aliens.png"</span>


<div class="center">
    <span><?php echo "<img src=\"$ripley\"/>:" . $_SESSION["ripleyLives"] . " X" ?></span>
    <form method="post">
        <table>
            <?php
            for ($height = 0; $height < HEIGHT; $height++) {
                echo "<tr>";
                for ($width = 0; $width < WIDTH; $width++) {

                    if ($ripleypos == $alienpos || $ripleypos == $alienpos2 || $ripleypos == $alienpos3) {
                        echo "<td class=\"tdstyle\"><input class=\"inputstyle\" value='$width.$height' type=\"submit\" name=\"position\" /></td>" . PHP_EOL;
                    } elseif ($ripleypos["x"] == $width && $ripleypos["y"] == $height) {
                        echo "<td class=\"tdstyle\"><img src=\"$ripley\"/></td>" . PHP_EOL;
                    } elseif ($alienpos["x"] == $width && $alienpos["y"] == $height) {
                        echo "<td class=\"tdstyle\"><img src=\"$alien\"/></td>" . PHP_EOL;
                    } elseif ($alienpos2["x"] == $width && $alienpos2["y"] == $height) {
                        echo "<td class=\"tdstyle\"><img src=\"$alien\"/></td>" . PHP_EOL;
                    } elseif ($alienpos3["x"] == $width && $alienpos3["y"] == $height) {
                        echo "<td class=\"tdstyle\"><img src=\"$alien\"/></td>" . PHP_EOL;
                    } else {
                        echo "<td class=\"tdstyle\"><input class=\"inputstyle\" value='$width.$height' type=\"submit\" name=\"position\" /></td>" . PHP_EOL;
                    }
                }
                echo "</tr>";
            }
            ?>
        </table>
    </form>
</div>
</body>

</html>