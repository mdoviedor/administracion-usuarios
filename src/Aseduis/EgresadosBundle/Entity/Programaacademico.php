<?php

namespace Aseduis\EgresadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Programaacademico
 *
 * @ORM\Table(name="programaAcademico", indexes={@ORM\Index(name="programaAcademico_tipo_idx", columns={"tipoProgramaAcademico"})})
 * @ORM\Entity
 */
class Programaacademico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idprogramaAcademico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprogramaacademico;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var \Tipoprogramaacademico
     *
     * @ORM\ManyToOne(targetEntity="Tipoprogramaacademico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipoProgramaAcademico", referencedColumnName="idtipoProgramaAcademico")
     * })
     */
    private $tipoprogramaacademico;



    /**
     * Get idprogramaacademico
     *
     * @return integer 
     */
    public function getIdprogramaacademico()
    {
        return $this->idprogramaacademico;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Programaacademico
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

    /**
     * Set tipoprogramaacademico
     *
     * @param \Aseduis\EgresadosBundle\Entity\Tipoprogramaacademico $tipoprogramaacademico
     * @return Programaacademico
     */
    public function setTipoprogramaacademico(\Aseduis\EgresadosBundle\Entity\Tipoprogramaacademico $tipoprogramaacademico = null)
    {
        $this->tipoprogramaacademico = $tipoprogramaacademico;

        return $this;
    }

    /**
     * Get tipoprogramaacademico
     *
     * @return \Aseduis\EgresadosBundle\Entity\Tipoprogramaacademico 
     */
    public function getTipoprogramaacademico()
    {
        return $this->tipoprogramaacademico;
    }
}
