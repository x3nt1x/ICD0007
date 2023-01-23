<?php

$data = $_POST['data'] ?? '';

error_log($data);

// some code that should save the data.

$url = 'index.php?message=' . "Data saved!";

header('Location: ' . $url);