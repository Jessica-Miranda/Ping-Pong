<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;


use AppBundle\Doctrine\Behaviors\Loggable\Loggable as CYABundleLoggableTrait;

/**
* @ORM\Entity
* @ORM\Table(name="Torneo")
*/
class Torneo
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
    * @ORM\OneToMany(targetEntity="ListVS", mappedBy="torneo", cascade={"persist", "remove"})
    */
    protected $lists;

    /**
    * @ORM\Column(name="fecha_inicio", type="datetime")
    */
    protected $fecha_inicio;

    /**
    * @ORM\Column(name="fecha_fin", type="datetime")
    */
    protected $fecha_fin;

    /**
    * @ORM\Column(name="nombre", type="string")
    */
    protected $nombre;

    public function __construct()
    {
        $this->lists = new ArrayCollection();
    }

    public function addList(ListVS $list)
    {
        $list->setTorneo($this);
        $this->lists->add($list);

        return $this;
    }
    /**
    * @param Direction $direction
    * @return $this
    */
    public function removeList(ListVS $list)
    {
        $this->lists->removeElement($list);

        return $this;
    }
    /**
    * @return \Doctrine\Common\Collections\Collection
    */
    public function getLists()
    {
        return $this->lists;
    }

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
     * Get the value of Fecha Inicio
     *
     * @return mixed
     */
    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * Set the value of Fecha Inicio
     *
     * @param mixed fecha_inicio
     *
     * @return self
     */
    public function setFechaInicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    /**
     * Get the value of Fecha Fin
     *
     * @return mixed
     */
    public function getFechaFin()
    {
        return $this->fecha_fin;
    }

    /**
     * Set the value of Fecha Fin
     *
     * @param mixed fecha_fin
     *
     * @return self
     */
    public function setFechaFin($fecha_fin)
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    /**
     * Get the value of Nombre
     *
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of Nombre
     *
     * @param mixed nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

}
