<?php

namespace Aseduis\EgresadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EgresadoProgramaacademico
 *
 * @ORM\Table(name="egresado_programaAcademico", indexes={@ORM\Index(name="eg_pa_egresado_idx", columns={"egresado"}), @ORM\Index(name="eg_pa_programaAcademico_idx", columns={"programaAcademico"})})
 * @ORM\Entity
 */
class EgresadoProgramaacademico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idegresado_programaAcademico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idegresadoProgramaacademico;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaGrado", type="datetime", nullable=true)
     */
    private $fechagrado;

    /**
     * @var \Egresado
     *
     * @ORM\ManyToOne(targetEntity="Egresado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="egresado", referencedColumnName="idegresado")
     * })
     */
    private $egresado;

    /**
     * @var \Programaacademico
     *
     * @ORM\ManyToOne(targetEntity="Programaacademico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="programaAcademico", referencedColumnName="idprogramaAcademico")
     * })
     */
    private $programaacademico;



    /**
     * Get idegresadoProgramaacademico
     *
     * @return integer 
     */
    public function getIdegresadoProgramaacademico()
    {
        return $this->idegresadoProgramaacademico;
    }

    /**
     * Set fechagrado
     *
     * @param \DateTime $fechagrado
     * @return EgresadoProgramaacademico
     */
    public function setFechagrado($fechagrado)
    {
        $this->fechagrado = $fechagrado;

        return $this;
    }

    /**
     * Get fechagrado
     *
     * @return \DateTime 
     */
    public function getFechagrado()
    {
        return $this->fechagrado;
    }

    /**
     * Set egresado
     *
     * @param \Aseduis\EgresadosBundle\Entity\Egresado $egresado
     * @return EgresadoProgramaacademico
     */
    public function setEgresado(\Aseduis\EgresadosBundle\Entity\Egresado $egresado = null)
    {
        $this->egresado = $egresado;

        return $this;
    }

    /**
     * Get egresado
     *
     * @return \Aseduis\EgresadosBundle\Entity\Egresado 
     */
    public function getEgresado()
    {
        return $this->egresado;
    }

    /**
     * Set programaacademico
     *
     * @param \Aseduis\EgresadosBundle\Entity\Programaacademico $programaacademico
     * @return EgresadoProgramaacademico
     */
    public function setProgramaacademico(\Aseduis\EgresadosBundle\Entity\Programaacademico $programaacademico = null)
    {
        $this->programaacademico = $programaacademico;

        return $this;
    }

    /**
     * Get programaacademico
     *
     * @return \Aseduis\EgresadosBundle\Entity\Programaacademico 
     */
    public function getProgramaacademico()
    {
        return $this->programaacademico;
    }
}
