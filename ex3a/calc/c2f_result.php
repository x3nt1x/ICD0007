<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Celsius to Fahrenheit</title>
</head>
<body>

<nav>
    <a href="." id="c2f">Celsius to Fahrenheit</a> |
    <a href="f2c.html" id="f2c">Fahrenheit to Celsius</a>
</nav>

<main>
    <h3>Celsius to Fahrenheit</h3>

    <?php
    $temp = $_POST['temperature'];

    if($temp)
    {
        if (is_numeric($temp))
        {
            $result = round(intval($temp) * 9 / 5 + 32);

            print "{$temp} decrees in Celsius is {$result} decrees in Fahrenheit";
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