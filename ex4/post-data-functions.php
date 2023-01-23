<?php

include_once __DIR__ . '/Post.php';

const DATA_FOLDER = __DIR__ . '/data/';
const DATA_FILE = DATA_FOLDER . 'posts.txt';

$post = new Post('Title 1', 'Text 1');

savePost($post);

function savePost(Post $post): int
{
    if ($post->id)
    {
        deletePostById($post->id);
    }
    else
    {
        $availableID = 1;

        foreach (getAllPosts() as $current_post)
        {
            if (intval($current_post->id) >= $availableID)
                $availableID = intval($current_post->id) + 1;
        }

        $post->id = $availableID;
    }

    $line = urlencode($post->id) . ';' . urlencode($post->title) . ';' . urlencode($post->text) . PHP_EOL;

    file_put_contents(DATA_FILE, $line, FILE_APPEND);

    return $post->id;
}

function deletePostById(string $id): void
{
    $posts = getAllPosts();
    file_put_contents(DATA_FILE, '');

    foreach ($posts as $post)
    {
        if (intval($post->id) !== intval($id))
            savePost($post);
    }
}

function getAllPosts(): array
{
    if(!is_dir(DATA_FOLDER))
    {
        mkdir(DATA_FOLDER);
        return [];
    }

    $lines = file(DATA_FILE);
    $result = [];

    foreach ($lines as $line)
    {
        [$id, $title, $text] = explode(';', trim($line));

        $result[] = new Post(urldecode($title), urldecode($text), urldecode($id));
    }

    return $result;
}

function printPosts(array $posts): void
{
    foreach ($posts as $post)
        print $post . PHP_EOL;
}