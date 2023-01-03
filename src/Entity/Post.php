<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
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
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SellerName;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $description;


    /**
     * @ORM\Column(type="integer", length=8)
     */
    private $price;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ContactNumber;


    /**
     * @ORM\Column(type="string", length=100)
     */
    private $image1;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $image2;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $image3;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $image4;




    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="post");
    */
    private $category;

    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\User", inversedBy="post")
    */
    private $user;





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getContactNumber(): ?string
    {
        return $this->ContactNumber;
    }

    public function setContactNumber(string $ContactNumber): self
    {
        $this->ContactNumber = $ContactNumber;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage1(): ?string
    {
        return $this->image1;
    }

    public function setImage1(string $image1): self
    {
        $this->image1 = $image1;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(string $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image3;
    }

    public function setImage3(string $image3): self
    {
        $this->image3 = $image3;

        return $this;
    }

    public function getImage4(): ?string
    {
        return $this->image4;
    }

    public function setImage4(string $image4): self
    {
        $this->image4 = $image4;

        return $this;
    }

    public function getSellerName(): ?string
    {
        return $this->SellerName;
    }

    public function setSellerName(string $SellerName): self
    {
        $this->SellerName = $SellerName;

        return $this;
    }


}
