<?php

include_once __DIR__ . '/Post.php';

const DATA_FOLDER = __DIR__ . '/data/';
const DATA_FILE = __DIR__ . '/data/posts.txt';

savePost(new Post('Html', "some text about html"));

printPosts(getAllPosts());

function getAllPosts(): array
{
    $list = [];
    $lines = file(DATA_FILE);

    foreach ($lines as $line)
    {
        $parts = explode(';', trim($line));
        $title = urldecode($parts[0]);
        $text = urldecode($parts[1]);

        $list[] = new Post($title, $text);
    }

    return $list;
}

function savePost(Post $post): void
{
    $title = urlencode($post->title);
    $text = urlencode($post->text);

    if (!is_dir(DATA_FOLDER))
        mkdir(DATA_FOLDER);

    file_put_contents(DATA_FILE, "{$title};{$text}\n", FILE_APPEND);
}

function printPosts(array $posts)
{
    foreach ($posts as $post)
        print $post . PHP_EOL;
}