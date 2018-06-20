<?php
/**
 * Created by PhpStorm.
 * User: Roma
 * Date: 03/05/2018
 * Time: 11:30
 */

namespace App\Entity;


use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity
 * @ORM\Table(name="teachers")
 * @UniqueEntity(fields={"email"}, message="Email all ready exists!")
 */
class Teacher implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    private $plainPassword;

    /**
     * @ORM\Column(type="string")
     */
    private $role;


    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $updatedAt;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lecture", mappedBy="teacher")
     */
    private $lectures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="teacher")
     */
    private $articles;



 /////////////////////////////////////<- getter & setters ->///////////////////////////////////////////////

    public function getId()
    {
        return $this->id;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email): void
    {
        $this->email = $email;
    }


    public function getFirstName()
    {
        return $this->firstName;
    }


    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }


    public function getLastName()
    {
        return $this->lastName;
    }


    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }


    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password): void
    {
        $this->password = $password;
    }


    public function getPlainPassword()
    {
        return $this->plainPassword;
    }


    public function setPlainPassword($password): void
    {
        $this->plainPassword = $password;
    }


    public function getRole()
    {
        return $this->role;
    }


    public function setRole($role): void
    {
        $this->role = $role;
    }

    public function getRoles()
    {
        return array($this->role);
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        return null;
    }


    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }


    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }


    public function getLectures()
    {
        return $this->lectures;
    }


    public function setLectures($lectures): void
    {
        $this->lectures = $lectures;
    }



//////////////////////////////////<- custom functions ->////////////////////////////////////////
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function  updateTimestamps(): void
    {
        $dateTimeNow = new DateTime('now');
        $this->setUpdatedAt($dateTimeNow);
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt($dateTimeNow);
        }
    }

    public function __construct()
    {
        $this->role = 'ROLE_USER';
        $this->lectures = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }
}