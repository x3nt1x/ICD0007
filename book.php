<?php

class book
{
    public int $id;
    public string $title;
    public array $authors;
    public int $grade;
    public bool $isRead;

    public function __construct(int $id, string $title, int $grade, bool $isRead, array $authors = [])
    {
        $this->id = $id;
        $this->title = $title;
        $this->authors = $authors;
        $this->grade = $grade;
        $this->isRead = $isRead;
    }

    public function addAuthorID(int $authorID): void
    {
        $this->authors[] = $authorID;
    }

    public function addAuthor(string $firstName, string $lastName): void
    {
        $this->authors[] = "$firstName $lastName";
    }

    public function authorsAsString(): string
    {
        return implode(', ', $this->authors);
    }

    public function gradeAsString(): string
    {
        $gradeString = '';

        for ($i = 0; $i < 5; $i++)
        {
            if ($this->grade > $i)
                $gradeString .= '★';
            else
                $gradeString .= '☆';
        }

        return $gradeString;
    }
}