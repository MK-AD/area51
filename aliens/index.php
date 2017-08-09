<?php
session_start();

const COLS = 100;
$alien = 'alien.png';
$ripley = 'ripley.png';
$i = 0;

// Set Ripley's and Alien's first position, if there is not session entry
if (!isset($_SESSION["ripleypos"])) {
    $_SESSION["ripleypos"] = $ripleypos = rand(0, COLS - 1);
    $_SESSION["alienpos"] = $alienpos = rand(0, COLS - 1);
    $_SESSION["alienpos2"] = $alienpos2 = rand(0, COLS - 1);
    $_SESSION["alienpos3"] = $alienpos3 = rand(0, COLS - 1);
}
$ripleypos = $_SESSION["ripleypos"];
$alienpos = $_SESSION["alienpos"];
$alienpos2 = $_SESSION["alienpos2"];
$alienpos3 = $_SESSION["alienpos3"];

// If user run with Ripley, set her new position
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($ripleypos != $_POST['alter']) {
        $_SESSION["ripleypos"] = $ripleypos = $_POST['alter'];

    }
}

?>

<div style="background-color: black; border:1px solid #0063dc; text-align: center; position: absolute; width: 100%;">
    <form method="post">
        <!--   <span><img src="aliens.png"</span>-->
        <table style="padding-left: 25%;">
            <?php

            while ($i < COLS) {
                if ($i % 10 == 0) {
                    echo "<tr>";
                }

                //<td style="border: 1px solid #0063dc;height: 55px; width: 55px; text-align: center; border-radius: 5px;"
                if ($i == $ripleypos) {
                    echo "<td style=\"border: 1px solid #0063dc;\"><img src=\"$ripley\"/></td>"; // ripley pos
                } elseif ($i == $alienpos && $alienpos != $ripleypos && $alienpos != $alienpos2 && $alienpos != $alienpos3) {
                    echo "<td style=\"border: 1px solid #0063dc;\"><img src=\"$alien\"/></td>"; // alien 1 pos
                } elseif ($i == $alienpos2 && $alienpos2 != $ripleypos && $alienpos2 != $alienpos && $alienpos2 != $alienpos3) {
                    echo "<td style=\"border: 1px solid #0063dc;\"><img src=\"$alien\"/></td>"; // alien 2 pos
                } elseif ($i == $alienpos3 && $alienpos3 != $ripleypos && $alienpos3 != $alienpos && $alienpos3 != $alienpos2) {
                    echo "<td style=\"border: 1px solid #0063dc;\"><img src=\"$alien\"/></td>"; // alien 3 pos
                } else {
                    echo "<td style=\"border: 1px solid #0063dc;\"><input style='height: 49px; width: 49px; background:white; border:0 none; cursor:pointer;' value='$i' type=\"submit\" name=\"alter\" /></td>" . PHP_EOL; // empty
                }

                $i++;
                if ($i % 10 == 0) {
                    echo "</tr>";
                }
            }

            ?>
        </table>
    </form>
</div>
