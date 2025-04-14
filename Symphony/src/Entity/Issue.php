<?php

namespace App\Entity;

use App\Repository\IssueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IssueRepository::class)]
class Issue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $book = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reader $Reader = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $IssuedAt = null;

    #[ORM\OneToOne(mappedBy: 'issue', cascade: ['persist', 'remove'])]
    private ?ReturnEntry $returnEntry = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): static
    {
        $this->book = $book;

        return $this;
    }

    public function getReader(): ?Reader
    {
        return $this->Reader;
    }

    public function setReader(?Reader $Reader): static
    {
        $this->Reader = $Reader;

        return $this;
    }

    public function getIssuedAt(): ?\DateTimeInterface
    {
        return $this->IssuedAt;
    }

    public function setIssuedAt(\DateTimeInterface $IssuedAt): static
    {
        $this->IssuedAt = $IssuedAt;

        return $this;
    }

    public function getReturnEntry(): ?ReturnEntry
    {
        return $this->returnEntry;
    }

    public function setReturnEntry(ReturnEntry $returnEntry): static
    {
        // set the owning side of the relation if necessary
        if ($returnEntry->getIssue() !== $this) {
            $returnEntry->setIssue($this);
        }

        $this->returnEntry = $returnEntry;

        return $this;
    }
}
