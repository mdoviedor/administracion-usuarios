<?php

namespace Aseduis\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conocimientoevento
 *
 * @ORM\Table(name="conocimientoEvento")
 * @ORM\Entity
 */
class Conocimientoevento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idconocimientoEvento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idconocimientoevento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;



    /**
     * Get idconocimientoevento
     *
     * @return integer 
     */
    public function getIdconocimientoevento()
    {
        return $this->idconocimientoevento;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Conocimientoevento
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}
