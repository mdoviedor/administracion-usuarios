<?php

namespace Aseduis\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipoprogramaacademico
 *
 * @ORM\Table(name="tipoProgramaAcademico")
 * @ORM\Entity
 */
class Tipoprogramaacademico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtipoProgramaAcademico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtipoprogramaacademico;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;



    /**
     * Get idtipoprogramaacademico
     *
     * @return integer 
     */
    public function getIdtipoprogramaacademico()
    {
        return $this->idtipoprogramaacademico;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Tipoprogramaacademico
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
