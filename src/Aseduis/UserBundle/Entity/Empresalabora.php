<?php

namespace Aseduis\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empresalabora
 *
 * @ORM\Table(name="empresaLabora", indexes={@ORM\Index(name="empresaLabora_ciudad_idx", columns={"ciudad"}), @ORM\Index(name="empresaLabora_egresado_idx", columns={"egresado"})})
 * @ORM\Entity
 */
class Empresalabora
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idempresaLabora", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idempresalabora;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=200, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=15, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=100, nullable=true)
     */
    private $cargo;

    /**
     * @var \Ciudad
     *
     * @ORM\ManyToOne(targetEntity="Ciudad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ciudad", referencedColumnName="idciudad")
     * })
     */
    private $ciudad;

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
     * Get idempresalabora
     *
     * @return integer 
     */
    public function getIdempresalabora()
    {
        return $this->idempresalabora;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Empresalabora
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
     * Set direccion
     *
     * @param string $direccion
     * @return Empresalabora
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Empresalabora
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     * @return Empresalabora
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set ciudad
     *
     * @param \Aseduis\UserBundle\Entity\Ciudad $ciudad
     * @return Empresalabora
     */
    public function setCiudad(\Aseduis\UserBundle\Entity\Ciudad $ciudad = null)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return \Aseduis\UserBundle\Entity\Ciudad 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set egresado
     *
     * @param \Aseduis\UserBundle\Entity\Egresado $egresado
     * @return Empresalabora
     */
    public function setEgresado(\Aseduis\UserBundle\Entity\Egresado $egresado = null)
    {
        $this->egresado = $egresado;

        return $this;
    }

    /**
     * Get egresado
     *
     * @return \Aseduis\UserBundle\Entity\Egresado 
     */
    public function getEgresado()
    {
        return $this->egresado;
    }
}
