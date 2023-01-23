<?php

require_once __DIR__ . '/book.php';
require_once __DIR__ . '/author.php';
require_once __DIR__ . '/ex5/connection.php';

class dao
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = getConnection();
    }

    function saveBook(int $id, string $title, array $authors, int $grade, bool $isRead): string
    {
        if ($id)
        {
            // update existing book
            $statement = $this->connection->prepare
            ('delete from book_author where book_id = :id;
                    update book set title = :title, grade = :grade, isRead = :isRead where id = :id');

            $statement->execute(array(':id' => $id, ':title' => $title, ':grade' => $grade, ':isRead' => intval($isRead)));

            $message = "Uuendatud!";
        }
        else
        {
            // add new book
            $statement = $this->connection->prepare('insert into book (title, grade, isRead) values (:title, :grade, :isRead)');
            $statement->execute(array(':title' => $title, ':grade' => $grade, ':isRead' => intval($isRead)));

            $id = $this->connection->lastInsertId();

            $message = "Lisatud!";
        }

        // create relations between book and its authors
        $statement = $this->connection->prepare('insert into book_author (book_id, author_id) values (:book_id, :author1), (:book_id, :author2)');
        $statement->execute(array(':book_id' => $id, ':author1' => $authors[0] ?: null, ':author2' => $authors[1] ?: null));

        return $message;
    }

    function saveAuthor(int $id, string $firstName, string $lastName, int $grade): string
    {
        if ($id)
        {
            // update existing author
            $statement = $this->connection->prepare('update author set firstName = :firstName, lastName = :lastName, grade = :grade where id = :id');
            $statement->execute(array(':firstName' => $firstName, ':lastName' => $lastName, ':grade' => $grade, ':id' => $id));

            $message = "Uuendatud!";
        }
        else
        {
            // add new author
            $statement = $this->connection->prepare('insert into author (firstName, lastName, grade) values (:firstName, :lastName, :grade)');
            $statement->execute(array(':firstName' => $firstName, ':lastName' => $lastName, ':grade' => $grade));

            $message = "Lisatud!";
        }

        return $message;
    }

    function deleteBook(int $id): string
    {
        $statement = $this->connection->prepare
        ('delete book_author from book_author where book_id = :id;
                delete book from book where id = :id');

        $statement->execute(array(':id' => $id));

        return 'Kustutatud!';
    }

    function deleteAuthor(int $id): string
    {
        $statement = $this->connection->prepare
        ('update book_author set author_id = null where author_id = :id;
                delete author from author where id = :id');

        $statement->execute(array(':id' => $id));

        return 'Kustutatud!';
    }

    function getBook(int $id): ?book
    {
        $statement = $this->connection->prepare
        ('select b.id, b.title, b.grade, b.isRead, a.id as author_id from book_author ba
                left join book b on ba.book_id = b.id left join author a on ba.author_id = a.Id where b.id = :id');

        $statement->execute(array(':id' => $id));

        $book = null;

        foreach ($statement as $item)
        {
            if (!$book)
                $book = new book($item['id'], $item['title'], $item['grade'], $item['isRead']);

            if ($author_id = $item['author_id'])
                $book->addAuthorID($author_id);
        }

        return $book;
    }

    function getAuthor(int $id): ?author
    {
        $statement = $this->connection->prepare('select * from author where id = :id');
        $statement->execute(array(':id' => $id));

        foreach ($statement as $item)
            return new author($item['id'], $item['firstName'], $item['lastName'], $item['grade']);

        return null;
    }

    function getBooks(): array
    {
        $statement = $this->connection->prepare
        ('select b.id, b.title, b.grade, b.isRead, a.firstName, a.lastName from book_author ba
                left join book b on ba.book_id = b.id left join author a on ba.author_id = a.Id order by b.id');

        $statement->execute();

        $book = null;
        $result = [];
        $index = 0;

        foreach ($statement as $item)
        {
            $id = intval($item['id']);

            if ($index !== $id)
                $result[] = $book = new book($id, $item['title'], $item['grade'], $item['isRead']);

            if (($firstName = $item['firstName']) && ($lastName = $item['lastName']))
                $book->addAuthor($firstName, $lastName);

            $index = $id;
        }

        return $result;
    }

    function getAuthors(): array
    {
        $result = [];

        $statement = $this->connection->prepare('select * from author');
        $statement->execute();

        foreach ($statement as $item)
            $result[] = new author($item['id'], $item['firstName'], $item['lastName'], $item['grade']);

        return $result;
    }
}