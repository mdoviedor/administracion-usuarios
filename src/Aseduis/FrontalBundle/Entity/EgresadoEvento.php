<?php

namespace Aseduis\FrontalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EgresadoEvento
 *
 * @ORM\Table(name="egresado_evento", indexes={@ORM\Index(name="ee_egresado_idx", columns={"egresado"}), @ORM\Index(name="ee_evento_idx", columns={"evento"}), @ORM\Index(name="ee_conocimientoEvento_idx", columns={"conocimientoEvento"})})
 * @ORM\Entity
 */
class EgresadoEvento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idegresado_evento", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idegresadoEvento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fecharegistro;

    /**
     * @var \Evento
     *
     * @ORM\ManyToOne(targetEntity="Evento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evento", referencedColumnName="idevento")
     * })
     */
    private $evento;

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
     * @var \Conocimientoevento
     *
     * @ORM\ManyToOne(targetEntity="Conocimientoevento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="conocimientoEvento", referencedColumnName="idconocimientoEvento")
     * })
     */
    private $conocimientoevento;



    /**
     * Get idegresadoEvento
     *
     * @return integer 
     */
    public function getIdegresadoEvento()
    {
        return $this->idegresadoEvento;
    }

    /**
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     * @return EgresadoEvento
     */
    public function setFecharegistro($fecharegistro)
    {
        $this->fecharegistro = $fecharegistro;

        return $this;
    }

    /**
     * Get fecharegistro
     *
     * @return \DateTime 
     */
    public function getFecharegistro()
    {
        return $this->fecharegistro;
    }

    /**
     * Set evento
     *
     * @param \Aseduis\FrontalBundle\Entity\Evento $evento
     * @return EgresadoEvento
     */
    public function setEvento(\Aseduis\FrontalBundle\Entity\Evento $evento = null)
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * Get evento
     *
     * @return \Aseduis\FrontalBundle\Entity\Evento 
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * Set egresado
     *
     * @param \Aseduis\FrontalBundle\Entity\Egresado $egresado
     * @return EgresadoEvento
     */
    public function setEgresado(\Aseduis\FrontalBundle\Entity\Egresado $egresado = null)
    {
        $this->egresado = $egresado;

        return $this;
    }

    /**
     * Get egresado
     *
     * @return \Aseduis\FrontalBundle\Entity\Egresado 
     */
    public function getEgresado()
    {
        return $this->egresado;
    }

    /**
     * Set conocimientoevento
     *
     * @param \Aseduis\FrontalBundle\Entity\Conocimientoevento $conocimientoevento
     * @return EgresadoEvento
     */
    public function setConocimientoevento(\Aseduis\FrontalBundle\Entity\Conocimientoevento $conocimientoevento = null)
    {
        $this->conocimientoevento = $conocimientoevento;

        return $this;
    }

    /**
     * Get conocimientoevento
     *
     * @return \Aseduis\FrontalBundle\Entity\Conocimientoevento 
     */
    public function getConocimientoevento()
    {
        return $this->conocimientoevento;
    }
}
