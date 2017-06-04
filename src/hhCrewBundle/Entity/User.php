<?php

namespace hhCrewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 *
 * @ORM\Table(name= "fos_user")
 * @ORM\Entity(repositoryClass="hhCrewBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=40)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=90)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, unique=true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Post",mappedBy="user")
     */
     private $posts;

     /**
     * Constructor
     */
    public function __construct()
    {
        $this->tweets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add posts
     *
     * @param \hhCrewBundle\Entity\Post $posts
     * @return User
     */
    public function addPost(\hhCrewBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \hhCrewBundle\Entity\Post $posts
     */
    public function removePost(\hhCrewBundle\Entity\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     */
    private $comments;
    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="nadawca")
     */
    private $wyslane;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="odbiorca")
     */
    private $odebrane;



    /**
     * Add comments
     *
     * @param \hhCrewBundle\Entity\Comment $comments
     * @return User
     */
    public function addComment(\hhCrewBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \hhCrewBundle\Entity\Comment $comments
     */
    public function removeComment(\hhCrewBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add wyslane
     *
     * @param \hhCrewBundle\Entity\Message $wyslane
     * @return User
     */
    public function addWyslane(\hhCrewBundle\Entity\Message $wyslane)
    {
        $this->wyslane[] = $wyslane;

        return $this;
    }

    /**
     * Remove wyslane
     *
     * @param \hhCrewBundle\Entity\Message $wyslane
     */
    public function removeWyslane(\hhCrewBundle\Entity\Message $wyslane)
    {
        $this->wyslane->removeElement($wyslane);
    }

    /**
     * Get wyslane
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWyslane()
    {
        return $this->wyslane;
    }

    /**
     * Add odebrane
     *
     * @param \hhCrewBundle\Entity\Message $odebrane
     * @return User
     */
    public function addOdebrane(\hhCrewBundle\Entity\Message $odebrane)
    {
        $this->odebrane[] = $odebrane;

        return $this;
    }

    /**
     * Remove odebrane
     *
     * @param \hhCrewBundle\Entity\Message $odebrane
     */
    public function removeOdebrane(\hhCrewBundle\Entity\Message $odebrane)
    {
        $this->odebrane->removeElement($odebrane);
    }

    /**
     * Get odebrane
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOdebrane()
    {
        return $this->odebrane;
    }
}
