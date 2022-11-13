<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Contact {

  /**
   * @var string|null
   * @Assert\NotBlank()
   * @Assert\Length(min=2,max=100)
   */  
  private $firstname;

  /**
   * @var string|null
   * @Assert\NotBlank()
   * @Assert\Length(min=2,max=100)
   */  
  private $lastname;

   /**
   * @var string|null
   * @Assert\NotBlank()
   * @Assert\Regex(
   *   pattern="/[0-9]{10}/")
   */  
  private $phone;

  /**
   * @var string|null
   * @Assert\NotBlank()
   * @Assert\Email()
   */  
     private $email;

     /**
   * @var string|null
   * @Assert\NotBlank()
   * @Assert\Length(min=10)
   */  
  private $message;
  
  /** 
  * @var Article|null
  * 
  * @Assert\Length(min=10)
  */  
 private $article;

  public function getFirstname(): ?string
    {
        return $this->firstname;
    }
     /**
     * @return Contact
      */
    public function setFirstname(string $firstname): Contact
    {
        $this->firstname = $firstname;

        return $this;
    }


    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @return Contact
      */
    public function setLastname(string $lastname): Contact
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }
     
    /**
     * @return Contact
      */
    public function setPhone(string $phone): Contact
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
     
    /**
     * @return Contact
      */
    public function setEmail(string $email): Contact
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }
     
    /**
     * @return Contact
      */
    public function setMessage(string $message): Contact
    {
        $this->message = $message;

        return $this;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }
     
    /**
     * @return Contact
      */
    public function setArticle(Article $article): Contact
    {
        $this->article = $article;

        return $this;
    }

}