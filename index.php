<?php


function getPlayerDetails($uid) {
    $api_url = "https://ffname.vercel.app/?uid=" . $uid;
    $json_data = file_get_contents($api_url);
    return json_decode($json_data, true);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['uid'])) {
        $uid = $_POST['uid'];
        $playerDetails = getPlayerDetails($uid);


        if ($playerDetails && isset($playerDetails['region'], $playerDetails['nickname'], $playerDetails['join'])) {
            $region = $playerDetails['region'];
            $nickname = $playerDetails['nickname'];
            $server = $playerDetails['join'];

            echo "<div class='container'>";
            echo "<h1 class='header-text'>Player Details</h1>";
            echo "<p>UID: $uid</p>";
            echo "<p>Display Name: $nickname</p>";
            echo "<p>Server: $server ($region)</p>";
            echo "</div>";
        } else {
            echo "<div class='container'>";
            echo "<h1 class='header-text'>Player not found. Please check the UID and try again.</h1>";
            echo "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Teko&display=swap">
    <style>
body {
            background: #000 center / cover no-repeat;
            margin: 0;
            font-family: 'Teko', sans-serif;
            color: #fff;
        }

        .navbar {
            background: url(https://i.postimg.cc/tTm1vbkb/20230830-142910.jpg) top center / 100% no-repeat;
            width: 100%;
            height: 65px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .navbar h2 {
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            margin-bottom: 150px;
            color: #000;
        }

        .header-text {
            font-size: 2em;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1.5px solid #E6C164;
            font-size: 1em;
            border-radius: 4px;
        }

        button {
            background-color: #000;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Teko', sans-serif;
            font-weight: 700;
            font-size: 1.1em;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #333;
        }

        .bottom-navbar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            text-align: center;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px;
        }

        .bottom-navbar a {
            color: #000;
            text-decoration: none;
            padding: 10px;
            border-radius: 8px;
            background-color: #fff;
            transition: background-color 0.3s, color 0.3s;
        }

        .bottom-navbar a:hover {
            background-color: #000;
            color: #fff;
        }
 

        .container p {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
    </style>
    <title>FreeFire Tournament</title>
</head>
<body>
    <div class="navbar">
        <h2>NEPCODER</h2>
    </div>
    <?php

    if (isset($playerDetails)) {
        echo "<div class='container'>";
        echo "<h1 class='header-text'>Welcome to FreeFire Tournament</h1>";
        echo "<p>Player details:</p>";
        echo "<p>UID: $uid</p>";
        echo "<p>Display Name: $nickname</p>";
        echo "<p>Server: $server ($region)</p>";
        echo "</div>";
    } else {
     
        echo "<div class='container'>";
        echo "<h1 class='header-text'>Welcome to FreeFire Tournament</h1>";
        echo "<p>Enter your FreeFire UID to participate:</p>";
        echo "<form action='' method='post'>"; 
        echo "<label for='uid'>FreeFire UID:</label>";
        echo "<input type='text' id='uid' name='uid' required>";
        echo "<button type='submit' class='awesome-button'>Submit</button>";
        echo "</form>";
        echo "</div>";
    }
    ?>

</body>
</html>
