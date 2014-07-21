<?php

namespace Aseduis\EgresadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Egresado
 *
 * @ORM\Table(name="egresado", indexes={@ORM\Index(name="egresado_genero_idx", columns={"genero"}), @ORM\Index(name="ciudad_genero_idx", columns={"ciudad"}), @ORM\Index(name="egresado_tipoIdentificacion_idx", columns={"tipoIdentificacion"}), @ORM\Index(name="egresado_user_idx", columns={"user"}), @ORM\Index(name="egresado_tipoSangre_idx", columns={"tipoSangre"})})
 * @ORM\Entity(repositoryClass="Aseduis\EgresadosBundle\Entity\EgresadoRepository")
 */
class Egresado {

    /**
     * @var integer
     *
     * @ORM\Column(name="idegresado", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idegresado;

    /**
     * @var string
     *
     * @ORM\Column(name="identificacion", type="string", length=18, nullable=false)
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/",
     *     message="Este valor '{{ value }}' no es permitido. Intentelo nuevamente."
     * )
     */
    private $identificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="primerNombre", type="string", length=45, nullable=false)
     * @Assert\Regex(
     *     pattern="/^[a-zA-Za0-9 ]+$/",
     *     message="Este valor '{{ value }}' no es permitido. Intentelo nuevamente."
     * )
     */
    private $primernombre;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoNombre", type="string", length=45, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[a-zA-Za0-9 ]+$/",
     *     message="Este valor '{{ value }}' no es permitido. Intentelo nuevamente."
     * )
     */
    private $segundonombre;

    /**
     * @var string
     *
     * @ORM\Column(name="primerApellido", type="string", length=45, nullable=false)
     * @Assert\Regex(
     *     pattern="/^[a-zA-Za0-9 ]+$/",
     *     message="Este valor '{{ value }}' no es permitido. Intentelo nuevamente."
     * )
     */
    private $primerapellido;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoApellido", type="string", length=45, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[a-zA-Za0-9 ]+$/",
     *     message="Este valor '{{ value }}' no es permitido. Intentelo nuevamente."
     * )
     */
    private $segundoapellido;

    /**
     * @var string
     *
     * @ORM\Column(name="direccionResidencia", type="string", length=200, nullable=true)
     */
    private $direccionresidencia;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoFijo", type="string", length=15, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/",
     *     message="Este valor '{{ value }}' no es permitido. Intentelo nuevamente."
     * )
     */
    private $telefonofijo;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=15, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/",
     *     message="Este valor '{{ value }}' no es permitido. Intentelo nuevamente."
     * )
     */
    private $celular;

    /**
     * @var boolean
     *
     * @ORM\Column(name="egresadoUis", type="boolean", nullable=false)
     */
    private $egresadouis = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="noticias", type="boolean", nullable=false)
     */
    private $noticias = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fecharegistro;

    /**
     * @var \Genero
     *
     * @ORM\ManyToOne(targetEntity="Genero")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="genero", referencedColumnName="idgenero")
     * })
     */
    private $genero;

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
     * @var \Tiposangre
     *
     * @ORM\ManyToOne(targetEntity="Tiposangre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipoSangre", referencedColumnName="idtipoSangre")
     * })
     */
    private $tiposangre;

    /**
     * Get idegresado
     *
     * @return integer 
     */
    public function getIdegresado() {
        return $this->idegresado;
    }

    /**
     * Set identificacion
     *
     * @param string $identificacion
     * @return Egresado
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
     * Set primernombre
     *
     * @param string $primernombre
     * @return Egresado
     */
    public function setPrimernombre($primernombre) {
        $this->primernombre = $primernombre;

        return $this;
    }

    /**
     * Get primernombre
     *
     * @return string 
     */
    public function getPrimernombre() {
        return $this->primernombre;
    }

    /**
     * Set segundonombre
     *
     * @param string $segundonombre
     * @return Egresado
     */
    public function setSegundonombre($segundonombre) {
        $this->segundonombre = $segundonombre;

        return $this;
    }

    /**
     * Get segundonombre
     *
     * @return string 
     */
    public function getSegundonombre() {
        return $this->segundonombre;
    }

    /**
     * Set primerapellido
     *
     * @param string $primerapellido
     * @return Egresado
     */
    public function setPrimerapellido($primerapellido) {
        $this->primerapellido = $primerapellido;

        return $this;
    }

    /**
     * Get primerapellido
     *
     * @return string 
     */
    public function getPrimerapellido() {
        return $this->primerapellido;
    }

    /**
     * Set segundoapellido
     *
     * @param string $segundoapellido
     * @return Egresado
     */
    public function setSegundoapellido($segundoapellido) {
        $this->segundoapellido = $segundoapellido;

        return $this;
    }

    /**
     * Get segundoapellido
     *
     * @return string 
     */
    public function getSegundoapellido() {
        return $this->segundoapellido;
    }

    /**
     * Set direccionresidencia
     *
     * @param string $direccionresidencia
     * @return Egresado
     */
    public function setDireccionresidencia($direccionresidencia) {
        $this->direccionresidencia = $direccionresidencia;

        return $this;
    }

    /**
     * Get direccionresidencia
     *
     * @return string 
     */
    public function getDireccionresidencia() {
        return $this->direccionresidencia;
    }

    /**
     * Set telefonofijo
     *
     * @param string $telefonofijo
     * @return Egresado
     */
    public function setTelefonofijo($telefonofijo) {
        $this->telefonofijo = $telefonofijo;

        return $this;
    }

    /**
     * Get telefonofijo
     *
     * @return string 
     */
    public function getTelefonofijo() {
        return $this->telefonofijo;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return Egresado
     */
    public function setCelular($celular) {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular() {
        return $this->celular;
    }

    /**
     * Set egresadouis
     *
     * @param boolean $egresadouis
     * @return Egresado
     */
    public function setEgresadouis($egresadouis) {
        $this->egresadouis = $egresadouis;

        return $this;
    }

    /**
     * Get egresadouis
     *
     * @return boolean 
     */
    public function getEgresadouis() {
        return $this->egresadouis;
    }

    /**
     * Set noticias
     *
     * @param boolean $noticias
     * @return Egresado
     */
    public function setNoticias($noticias) {
        $this->noticias = $noticias;

        return $this;
    }

    /**
     * Get noticias
     *
     * @return boolean 
     */
    public function getNoticias() {
        return $this->noticias;
    }

    /**
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     * @return Egresado
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
     * Set genero
     *
     * @param \Aseduis\EgresadosBundle\Entity\Genero $genero
     * @return Egresado
     */
    public function setGenero(\Aseduis\EgresadosBundle\Entity\Genero $genero = null) {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get genero
     *
     * @return \Aseduis\EgresadosBundle\Entity\Genero 
     */
    public function getGenero() {
        return $this->genero;
    }

    /**
     * Set ciudad
     *
     * @param \Aseduis\EgresadosBundle\Entity\Ciudad $ciudad
     * @return Egresado
     */
    public function setCiudad(\Aseduis\EgresadosBundle\Entity\Ciudad $ciudad = null) {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return \Aseduis\EgresadosBundle\Entity\Ciudad 
     */
    public function getCiudad() {
        return $this->ciudad;
    }

    /**
     * Set tipoidentificacion
     *
     * @param \Aseduis\EgresadosBundle\Entity\Tipoidentificacion $tipoidentificacion
     * @return Egresado
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

    /**
     * Set user
     *
     * @param \Aseduis\EgresadosBundle\Entity\User $user
     * @return Egresado
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
     * Set tiposangre
     *
     * @param \Aseduis\EgresadosBundle\Entity\Tiposangre $tiposangre
     * @return Egresado
     */
    public function setTiposangre(\Aseduis\EgresadosBundle\Entity\Tiposangre $tiposangre = null) {
        $this->tiposangre = $tiposangre;

        return $this;
    }

    /**
     * Get tiposangre
     *
     * @return \Aseduis\EgresadosBundle\Entity\Tiposangre 
     */
    public function getTiposangre() {
        return $this->tiposangre;
    }

}
