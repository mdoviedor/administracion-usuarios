<?php

namespace Aseduis\EgresadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipoidentificacion
 *
 * @ORM\Table(name="tipoIdentificacion")
 * @ORM\Entity
 */
class Tipoidentificacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtipoIdentificacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtipoidentificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;



    /**
     * Get idtipoidentificacion
     *
     * @return integer 
     */
    public function getIdtipoidentificacion()
    {
        return $this->idtipoidentificacion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Tipoidentificacion
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
