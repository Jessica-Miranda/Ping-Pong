<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Doctrine\Behaviors\Loggable\Loggable as CYABundleLoggableTrait;

/**
* @ORM\Entity
* @ORM\Table(name="usuario")
*/
class Usuario extends BaseUser
{
    use ORMBehaviors\Timestampable\Timestampable,
    ORMBehaviors\Blameable\Blameable;

    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';

    /**
    * @ORM\Column(type="guid")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="UUID")
    */
    protected $id;

    /**
    * @ORM\Column(type="string", nullable=true)
    * @var string
    */
    private $nombreImpresion;

    /**
    * @ORM\Column(type="string", nullable=true)
    */
    protected $avatar;

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
    * Set id
    *
    * @param string $id
    * @return Usuario
    */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
    * Get id
    *
    * @return string
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    *
    * @return string [description]
    */
    public function __toString()
    {
        return (string)$this->getId();
    }

    /**
    * @return string
    */
    public function getNombreImpresion()
    {
        if ($this->nombreImpresion) {
            return $this->nombreImpresion;
        }

        return $this->usernameCanonical;
    }

    public function setNombreImpresion($nombreImpresion)
    {
        $this->nombreImpresion = $nombreImpresion;

        return $this;
    }
}
