<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $designation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $posted_at;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $prix;

    /**
     * @ORM\Column(nullable=true)
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="articles")
     */
    private $category;

    /**
     * @ORM\Column(type="integer")
     */
    private $pointure;
     
    public function getId(): ?int
    {
        return $this->id;
    }

    const point=[
        1=>"Small",
        2=>"Medium",
        3=>"Large",
        4=>"Extra large"];

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }
      public function getslug():string
     {
          $slug=new Slugify();
         return $slug->slugify($this->designation);
     }
 
    public function __construct()
    {
        $this->posted_at=new \datetime();
    }
    public function getPostedAt(): ?\DateTimeInterface
    {
        return $this->posted_at;
    }

    public function setPostedAt(\DateTimeInterface $posted_at): self
    {
        $this->posted_at = $posted_at;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPointure(): ?int
    {
        return $this->pointure;
    }

    public function setPointure(int $pointure): self
    {
        $this->pointure = $pointure;

        return $this;
    }

    public function getpoin():string
    {

         return self:: point[$this->pointure];
    }
}
