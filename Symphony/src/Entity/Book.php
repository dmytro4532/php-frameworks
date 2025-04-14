<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Author $title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?Author
    {
        return $this->title;
    }

    public function setTitle(?Author $title): static
    {
        $this->title = $title;

        return $this;
    }
}
