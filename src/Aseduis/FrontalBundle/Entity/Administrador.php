<?php

namespace Aseduis\FrontalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Administrador
 *
 * @ORM\Table(name="administrador", indexes={@ORM\Index(name="administrador_user_idx", columns={"user"}), @ORM\Index(name="administrador_tipoIdentificacion_idx", columns={"tipoIdentificacion"})})
 * @ORM\Entity
 */
class Administrador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idadministrador", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idadministrador;

    /**
     * @var string
     *
     * @ORM\Column(name="identificacion", type="string", length=18, nullable=false)
     */
    private $identificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombres", type="string", length=80, nullable=false)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=80, nullable=false)
     */
    private $apellidos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fecharegistro;

    /**
     * @var \Tipoidentificacion
     *
     * @ORM\ManyToOne(targetEntity="Tipoidentificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipoIdentificacion", referencedColumnName="idtipoIdentificacion")
     * })
     */
    private $tipoidentificacion;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    private $user;



    /**
     * Get idadministrador
     *
     * @return integer 
     */
    public function getIdadministrador()
    {
        return $this->idadministrador;
    }

    /**
     * Set identificacion
     *
     * @param string $identificacion
     * @return Administrador
     */
    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;

        return $this;
    }

    /**
     * Get identificacion
     *
     * @return string 
     */
    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     * @return Administrador
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string 
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Administrador
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     * @return Administrador
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
     * Set tipoidentificacion
     *
     * @param \Aseduis\FrontalBundle\Entity\Tipoidentificacion $tipoidentificacion
     * @return Administrador
     */
    public function setTipoidentificacion(\Aseduis\FrontalBundle\Entity\Tipoidentificacion $tipoidentificacion = null)
    {
        $this->tipoidentificacion = $tipoidentificacion;

        return $this;
    }

    /**
     * Get tipoidentificacion
     *
     * @return \Aseduis\FrontalBundle\Entity\Tipoidentificacion 
     */
    public function getTipoidentificacion()
    {
        return $this->tipoidentificacion;
    }

    /**
     * Set user
     *
     * @param \Aseduis\FrontalBundle\Entity\User $user
     * @return Administrador
     */
    public function setUser(\Aseduis\FrontalBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Aseduis\FrontalBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
