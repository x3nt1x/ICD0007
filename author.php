<?php

class author
{
    public int $id;
    public string $firstName;
    public string $lastName;
    public int $grade;

    public function __construct(int $id, string $firstName, string $lastName, int $grade)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->grade = $grade;
    }

    public function getFullName(): string
    {
        return "$this->firstName $this->lastName";
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