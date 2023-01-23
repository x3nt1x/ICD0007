<?php

require_once '../vendor/tpl.php';
require_once 'Book.php';
require_once 'Author.php';

$book1 = new Book('Head First HTML and CSS', 5, false);
$book1->addAuthor(new Author('Elisabeth', 'Robson'));
$book1->addAuthor(new Author('Eric', 'Freeman'));

$book2 = new Book('Learning Web Design', 4, false);
$book2->addAuthor(new Author('Jennifer', 'Robbins'));

$book3 = new Book('Head First Learn to Code', 4, false);
$book3->addAuthor(new Author('Eric', 'Freeman'));

$data = ['books' => [$book1, $book2, $book3]];

print renderTemplate('list.html', $data);