<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fahrenheit to Celsius</title>
</head>
<body>

<nav>
    <a href="." id="c2f">Celsius to Fahrenheit</a> |
    <a href="f2c.html" id="f2c">Fahrenheit to Celsius</a>
</nav>

<main>
    <h3>Fahrenheit to Celsius</h3>

    <?php
    $temp = $_POST['temperature'];

    if($temp)
    {
        if (is_numeric($temp))
        {
            $result = round((intval($temp) - 32) / (9/5));

            print "{$temp} decrees in Fahrenheit is {$result} decrees in Celsius";
        }
        else
        {
            print "Temperature must be an integer";
        }
    }
    else
    {
        print "Insert temperature";
    }
    ?>
</main>

</body>
</html>