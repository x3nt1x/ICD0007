<?php
$data = urlencode($_GET['text']) ?? '';
$confirmed = isset($_GET['confirmed']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>

<?php
if ($confirmed)
{
    $decoded = urldecode($data);
    print "Confirmed: $decoded";
}
else
{
    print "<a href='.'>Cancel</a> ";
    print "<a href='receiver.php?confirmed=1&text=$data'>Confirm</a>";
}
?>

</body>
</html>