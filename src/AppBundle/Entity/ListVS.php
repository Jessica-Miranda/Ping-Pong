<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;


use AppBundle\Doctrine\Behaviors\Loggable\Loggable as CYABundleLoggableTrait;

/**
* @ORM\Entity
* @ORM\Table(name="ListVS")
*/
class ListVS
{
    use ORMBehaviors\Timestampable\Timestampable,
    ORMBehaviors\Blameable\Blameable;

    /**
    * @ORM\Column(type="guid")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="UUID")
    */
    protected $id;

    /**
    * @ORM\ManyToOne(targetEntity="Usuario")
    * @ORM\JoinColumn(name="user_a_id", referencedColumnName="id")
    */
    protected $user_a;

    /**
    * @ORM\ManyToOne(targetEntity="Usuario")
    * @ORM\JoinColumn(name="user_b_id", referencedColumnName="id")
    */
    protected $user_b;

    /**
    * @ORM\Column(name="user_a_punteo", type="integer", nullable=true)
    */
    protected $user_a_punteo;

    /**
    * @ORM\Column(name="user_b_punteo", type="integer", nullable=true)
    */
    protected $user_b_punteo;

    /**
    * @ORM\ManyToOne(targetEntity="Torneo", inversedBy="lists")
    * @ORM\JoinColumn(name="torneo_id", referencedColumnName="id")
    */
    protected $torneo;

    /**
    * Get the value of Id
    *
    * @return mixed
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Set the value of Id
    *
    * @param mixed id
    *
    * @return self
    */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
    * Get the value of User a
    *
    * @return mixed
    */
    public function getUserA()
    {
        return $this->user_a;
    }

    /**
    * Set the value of User a
    *
    * @param mixed user_a
    *
    * @return self
    */
    public function setUserA($user_a)
    {
        $this->user_a = $user_a;

        return $this;
    }

    /**
    * Get the value of User b
    *
    * @return mixed
    */
    public function getUserB()
    {
        return $this->user_b;
    }

    /**
    * Set the value of User b
    *
    * @param mixed user_b
    *
    * @return self
    */
    public function setUserB($user_b)
    {
        $this->user_b = $user_b;

        return $this;
    }

    /**
    * Get the value of Torneo
    *
    * @return mixed
    */
    public function getTorneo()
    {
        return $this->torneo;
    }

    /**
    * Set the value of Torneo
    *
    * @param mixed torneo
    *
    * @return self
    */
    public function setTorneo($torneo)
    {
        $this->torneo = $torneo;

        return $this;
    }

    /**
    * Get the value of User a Punteo
    *
    * @return mixed
    */
    public function getUserAPunteo()
    {
        return $this->user_a_punteo;
    }

    /**
    * Get the value of User b Punteo
    *
    * @return mixed
    */
    public function getUserBPunteo()
    {
        return $this->user_b_punteo;
    }

    /**
    * Set the value of User a Punteo
    *
    * @param mixed user_a_punteo
    *
    * @return self
    */
    public function setUserAPunteo($user_a_punteo)
    {
        $this->user_a_punteo = $user_a_punteo;

        return $this;
    }

    /**
    * Set the value of User b Punteo
    *
    * @param mixed user_b_punteo
    *
    * @return self
    */
    public function setUserBPunteo($user_b_punteo)
    {
        $this->user_b_punteo = $user_b_punteo;

        return $this;
    }

}
