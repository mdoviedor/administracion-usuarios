<?php

namespace Aseduis\EgresadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Administrador
 *
 * @ORM\Table(name="administrador", indexes={@ORM\Index(name="administrador_user_idx", columns={"user"}), @ORM\Index(name="administrador_tipoIdentificacion_idx", columns={"tipoIdentificacion"})})
 * @ORM\Entity
 */
class Administrador {

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
     * @Assert\Range(
     *      min = "100000",
     *      max = "999999999999999999",  
     *      invalidMessage ="Este valor '{{ value }}' debe ser un número valido. Este campo solo puede ser numérico. Intentelo nuevamente."
     * )
     */
    private $identificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombres", type="string", length=80, nullable=false)
     * @Assert\Regex(
     *     pattern="/^[a-zA-Za0-9 ]+$/",
     *     message="Este valor '{{ value }}' no es permitido. Intentelo nuevamente."
     * )
     */
    private $nombres;
   
    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=80, nullable=false)
     * @Assert\Regex(
     *     pattern="/^[a-zA-Za0-9 ]+$/",
     *     message="Este valor '{{ value }}' no es permitido. Intentelo nuevamente."
     * )
     */
    private $apellidos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fecharegistro;

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
     * @var \Tipoidentificacion
     *
     * @ORM\ManyToOne(targetEntity="Tipoidentificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipoIdentificacion", referencedColumnName="idtipoIdentificacion")
     * })
     */
    private $tipoidentificacion;

    /**
     * Get idadministrador
     *
     * @return integer 
     */
    public function getIdadministrador() {
        return $this->idadministrador;
    }

    /**
     * Set identificacion
     *
     * @param string $identificacion
     * @return Administrador
     */
    public function setIdentificacion($identificacion) {
        $this->identificacion = $identificacion;

        return $this;
    }

    /**
     * Get identificacion
     *
     * @return string 
     */
    public function getIdentificacion() {
        return $this->identificacion;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     * @return Administrador
     */
    public function setNombres($nombres) {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string 
     */
    public function getNombres() {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Administrador
     */
    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos() {
        return $this->apellidos;
    }

    /**
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     * @return Administrador
     */
    public function setFecharegistro($fecharegistro) {
        $this->fecharegistro = $fecharegistro;

        return $this;
    }

    /**
     * Get fecharegistro
     *
     * @return \DateTime 
     */
    public function getFecharegistro() {
        return $this->fecharegistro;
    }

    /**
     * Set user
     *
     * @param \Aseduis\EgresadosBundle\Entity\User $user
     * @return Administrador
     */
    public function setUser(\Aseduis\EgresadosBundle\Entity\User $user = null) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Aseduis\EgresadosBundle\Entity\User 
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set tipoidentificacion
     *
     * @param \Aseduis\EgresadosBundle\Entity\Tipoidentificacion $tipoidentificacion
     * @return Administrador
     */
    public function setTipoidentificacion(\Aseduis\EgresadosBundle\Entity\Tipoidentificacion $tipoidentificacion = null) {
        $this->tipoidentificacion = $tipoidentificacion;

        return $this;
    }

    /**
     * Get tipoidentificacion
     *
     * @return \Aseduis\EgresadosBundle\Entity\Tipoidentificacion 
     */
    public function getTipoidentificacion() {
        return $this->tipoidentificacion;
    }

}
