<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ORM\Table(name: 'book')]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $title = '';

    #[ORM\Column(type: 'datetime_immutable', name: 'created_at')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $length = null;

    #[ORM\Column(type: 'date_immutable', nullable: true)]
    private ?\DateTimeImmutable $issueDate = null;

    /**
     * @var Collection<int, Genre>
     */
    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'books')]
    private Collection $genres;

    /**
     * @var Collection<int, Author>
     */
    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: 'books')]
    #[ORM\JoinTable(name: 'book_author')]
    private Collection $authors;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Review::class, orphanRemoval: true)]
    private Collection $reviews;

    /**
     * @var Collection<int, BookList>
     */
    #[ORM\ManyToMany(targetEntity: BookList::class, mappedBy: 'books')]
    private Collection $lists;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->genres = new ArrayCollection();
        $this->authors = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->lists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(?int $length): static
    {
        $this->length = $length;

        return $this;
    }

    public function getIssueDate(): ?\DateTimeImmutable
    {
        return $this->issueDate;
    }

    public function setIssueDate(?\DateTimeImmutable $issueDate): static
    {
        $this->issueDate = $issueDate;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
            $genre->addBook($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeBook($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Author>
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Author $author): static
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
            $author->addBook($this);
        }

        return $this;
    }

    public function removeAuthor(Author $author): static
    {
        if ($this->authors->removeElement($author)) {
            $author->removeBook($this);
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
            $review->setBook($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review) && $review->getBook() === $this) {
            $review->setBook(null);
        }

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
            $list->addBook($this);
        }

        return $this;
    }

    public function removeList(BookList $list): static
    {
        if ($this->lists->removeElement($list)) {
            $list->removeBook($this);
        }

        return $this;
    }
}
