<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'user')]
#[ORM\UniqueConstraint(name: 'uniq_user_email', columns: ['email'])]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $username = '';

    #[ORM\Column(length: 255, unique: true)]
    private string $email = '';

    #[ORM\Column(length: 255)]
    private string $password = '';

    #[ORM\Column(type: 'datetime_immutable', name: 'created_at')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    private bool $active = true;

    /**
     * @var Collection<int, BookList>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: BookList::class, orphanRemoval: true)]
    private Collection $lists;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Review::class, orphanRemoval: true)]
    private Collection $reviews;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->lists = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection<int, BookList>
     */
    public function getLists(): Collection
    {
        return $this->lists;
    }

    public function addList(BookList $list): static
    {
        if (!$this->lists->contains($list)) {
            $this->lists->add($list);
            $list->setUser($this);
        }

        return $this;
    }

    public function removeList(BookList $list): static
    {
        if ($this->lists->removeElement($list) && $list->getUser() === $this) {
            $list->setUser(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setUser($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review) && $review->getUser() === $this) {
            $review->setUser(null);
        }

        return $this;
    }
}
