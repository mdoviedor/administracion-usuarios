<?php

namespace Aseduis\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tiposangre
 *
 * @ORM\Table(name="tipoSangre")
 * @ORM\Entity
 */
class Tiposangre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtipoSangre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtiposangre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;



    /**
     * Get idtiposangre
     *
     * @return integer 
     */
    public function getIdtiposangre()
    {
        return $this->idtiposangre;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Tiposangre
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
