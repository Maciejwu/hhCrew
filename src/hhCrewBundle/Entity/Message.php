<?php

namespace hhCrewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="hhCrewBundle\Repository\MessageRepository")
 */
class Message
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="messageText", type="string", length=255)
     */
    private $messageText;


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
     * Set date
     *
     * @param \DateTime $date
     * @return Message
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Message
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set messageText
     *
     * @param string $messageText
     * @return Message
     */
    public function setMessageText($messageText)
    {
        $this->messageText = $messageText;

        return $this;
    }

    /**
     * Get messageText
     *
     * @return string
     */
    public function getMessageText()
    {
        return $this->messageText;
    }


    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="wyslane")
     */
    private $nadawca;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="odebrane")
     */
    private $odbiorca;

    /**
     * Set nadawca
     *
     * @param \hhCrewBundle\Entity\User $nadawca
     * @return Message
     */
    public function setNadawca(\hhCrewBundle\Entity\User $nadawca = null)
    {
        $this->nadawca = $nadawca;

        return $this;
    }

    /**
     * Get nadawca
     *
     * @return \hhCrewBundle\Entity\User 
     */
    public function getNadawca()
    {
        return $this->nadawca;
    }

    /**
     * Set odbiorca
     *
     * @param \hhCrewBundle\Entity\User $odbiorca
     * @return Message
     */
    public function setOdbiorca(\hhCrewBundle\Entity\User $odbiorca = null)
    {
        $this->odbiorca = $odbiorca;

        return $this;
    }

    /**
     * Get odbiorca
     *
     * @return \hhCrewBundle\Entity\User 
     */
    public function getOdbiorca()
    {
        return $this->odbiorca;
    }
}
