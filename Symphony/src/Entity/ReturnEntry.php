<?php

namespace App\Entity;

use App\Repository\ReturnEntryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReturnEntryRepository::class)]
class ReturnEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'returnEntry', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Issue $issue = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $returnedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIssue(): ?Issue
    {
        return $this->issue;
    }

    public function setIssue(Issue $issue): static
    {
        $this->issue = $issue;

        return $this;
    }

    public function getReturnedAt(): ?\DateTimeInterface
    {
        return $this->returnedAt;
    }

    public function setReturnedAt(\DateTimeInterface $returnedAt): static
    {
        $this->returnedAt = $returnedAt;

        return $this;
    }
}
