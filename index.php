<?php

require_once __DIR__ . '/dao.php';
require_once __DIR__ . '/book.php';
require_once __DIR__ . '/author.php';
require_once __DIR__ . '/ex7/Request.php';
require_once __DIR__ . '/ex7/vendor/tpl.php';

$request = new Request($_REQUEST);

$cmd = $request->param('cmd') ?: 'book-list';

if ($cmd === 'book-list')
{
    $data = [
        'page' => 'book-list-page',
        'content' => 'book-list.html',
        'message' => $request->param('message') ?? null,
        'books' => (new dao())->getBooks()
    ];
}
else if ($cmd === 'author-list')
{
    $data = [
        'page' => 'author-list-page',
        'content' => 'author-list.html',
        'message' => $request->param('message') ?? null,
        'authors' => (new dao())->getAuthors()
    ];
}
else if ($cmd === 'book-add' || $cmd === 'book-add-submit')
{
    $dao = new dao();

    $id = intval($request->param('id') ?? 0);
    $title = $request->param('title') ?? '';
    $author1 = intval($request->param('author1') ?? 0);
    $author2 = intval($request->param('author2') ?? 0);
    $grade = intval($request->param('grade') ?? 0);
    $isRead = boolval($request->param('isRead') ?? false);

    $error = null;
    $authors = [$author1, $author2];

    if ($cmd === 'book-add-submit')
    {
        if (strlen($title) < 3 || strlen($title) > 23)
        {
            $error = "Pealkiri peab oleama 3 kuni 23 märki!";
        }
        else
        {
            if ($request->param('deleteButton'))
                $message = $dao->deleteBook($id);
            else
                $message = $dao->saveBook($id, $title, $authors, $grade, $isRead);

            header("Location: ?cmd=book-list&message=$message");
            exit();
        }
    }
    else if ($id)
    {
        $book = $dao->getBook($id);

        $title = $book->title;
        $authors = $book->authors;
        $grade = $book->grade;
        $isRead = $book->isRead;
    }

    $data = [
        'id' => $id,
        'title' => $title,
        'grade' => $grade,
        'isRead' => $isRead,
        'error' => $error,
        'authors' => $authors,
        'allAuthors' => $dao->getAuthors(),
        'content' => 'book-add-form.html',
        'page' => 'book-form-page'
    ];
}
else if ($cmd === 'author-add' || $cmd === 'author-add-submit')
{
    $id = intval($request->param('id') ?? 0);
    $firstName = $request->param('firstName') ?? '';
    $lastName = $request->param('lastName') ?? '';
    $grade = intval($request->param('grade') ?? 0);
    $error = null;

    if ($cmd === 'author-add-submit')
    {
        if (strlen($firstName) < 1 || strlen($firstName) > 21)
        {
            $error = "Eesnimi peab oleama 1 kuni 21 märki!";
        }
        else if (strlen($lastName) < 2 || strlen($lastName) > 22)
        {
            $error = "Perekonnanimi peab oleama 2 kuni 22 märki!";
        }
        else
        {
            if ($request->param('deleteButton'))
                $message = (new dao())->deleteAuthor($id);
            else
                $message = (new dao())->saveAuthor($id, $firstName, $lastName, $grade);

            header("Location: ?cmd=author-list&message=$message");
            exit();
        }
    }
    else if ($id)
    {
        $author = (new dao())->getAuthor($id);

        $firstName = $author->firstName;
        $lastName = $author->lastName;
        $grade = $author->grade;
    }

    $data = [
        'id' => $id,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'grade' => $grade,
        'error' => $error,
        'content' => 'author-add-form.html',
        'page' => 'author-form-page'
    ];
}

print renderTemplate('main.html', $data);