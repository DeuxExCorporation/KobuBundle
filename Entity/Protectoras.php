<?php

namespace Destiny\KobuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Protectoras
 *
 * @ORM\Table(name="protectoras")
 * @ORM\Entity(repositoryClass="Destiny\KobuBundle\Entity\Repository\ProtectorasRepository")
 * @UniqueEntity("nombre")
 */
class Protectoras
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"nombre"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @ORM\ManyToMany(targetEntity="Destiny\AppBundle\Entity\Usuarios")
     * @ORM\JoinTable(name="protectoras_usuarios",
     *      joinColumns={@ORM\JoinColumn(name="protectoras_backend_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="usuarios_id", referencedColumnName="id", onDelete="CASCADE")}
     *      )
     **/
    private $usuarios;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     * @Assert\NotBlank(message="contacto.direccion.notblank")
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "contacto.direccion.min",
     * )
     *
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=255)
     * @Assert\NotBlank(message="contacto.ciudad.notblank")
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "contacto.ciudad.min",
     * )
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="provincia", type="string", length=255)
     * @Assert\NotBlank(message="contacto.provincia.notblank")
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "contacto.provincia.min",
     * )
     */
    private $provincia;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=255)
     * @Assert\NotBlank(message="contacto.pais.notblank")
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "contacto.pais.min",
     * )
     */
    private $pais;

    /**
     * @var integer
     *
     * @ORM\Column(name="telefono", type="integer", nullable=true)
     * @Assert\Type(type="integer", message="contacto.numero")
     */
    private $telefono;

    /**
     * @var integer
     *
     * @ORM\Column(name="movil", type="integer", nullable=true)
     * @Assert\Type(type="integer", message="contacto.numero")
     */
    private $movil;

    /**
     * @var integer
     *
     * @ORM\Column(name="fax", type="integer", nullable=true)
     * @Assert\Type(type="integer", message="contacto.numero")
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=255, nullable=true)
     */
    private $web;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="fechaCreacion", type="datetime")
     */
    private $fechaCreacion;


    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="fechaModificacion", type="datetime")
     */
    private $fechaModificacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity="Destiny\KobuBundle\Entity\ProtectorasRedesSociales", mappedBy="protectora")
     * @ORM\OrderBy({"nombre" = "ASC"})
     **/
    private $redesSociales;

    /**
     * @ORM\OneToMany(targetEntity="Destiny\KobuBundle\Entity\ProtectorasPerros", mappedBy="protectora")
     * @ORM\OrderBy({"nombre" = "ASC"})
     **/
    private $perros;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getNombre();
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Protectoras
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Protectoras
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Protectoras
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Protectoras
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return Protectoras
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Protectoras
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add usuarios
     *
     * @param \Destiny\AppBundle\Entity\Usuarios $usuarios
     * @return Protectoras
     */
    public function addUsuario(\Destiny\AppBundle\Entity\Usuarios $usuarios)
    {
        $this->usuarios[] = $usuarios;

        return $this;
    }

    /**
     * Remove usuarios
     *
     * @param \Destiny\AppBundle\Entity\Usuarios $usuarios
     */
    public function removeUsuario(\Destiny\AppBundle\Entity\Usuarios $usuarios)
    {
        $this->usuarios->removeElement($usuarios);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Protectoras
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
     * Set ciudad
     *
     * @param string $ciudad
     * @return Protectoras
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     * @return Protectoras
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set pais
     *
     * @param string $pais
     * @return Protectoras
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     * @return Protectoras
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return integer 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set movil
     *
     * @param integer $movil
     * @return Protectoras
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;

        return $this;
    }

    /**
     * Get movil
     *
     * @return integer 
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set fax
     *
     * @param integer $fax
     * @return Protectoras
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return integer 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set web
     *
     * @param string $web
     * @return Protectoras
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string 
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Protectoras
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add redesSociales
     *
     * @param \Destiny\KobuBundle\Entity\ProtectorasRedesSociales $redesSociales
     * @return Protectoras
     */
    public function addRedesSociale(\Destiny\KobuBundle\Entity\ProtectorasRedesSociales $redesSociales)
    {
        $this->redesSociales[] = $redesSociales;

        return $this;
    }

    /**
     * Remove redesSociales
     *
     * @param \Destiny\KobuBundle\Entity\ProtectorasRedesSociales $redesSociales
     */
    public function removeRedesSociale(\Destiny\KobuBundle\Entity\ProtectorasRedesSociales $redesSociales)
    {
        $this->redesSociales->removeElement($redesSociales);
    }

    /**
     * Get redesSociales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRedesSociales()
    {
        return $this->redesSociales;
    }

    /**
     * Add perros
     *
     * @param \Destiny\KobuBundle\Entity\ProtectorasPerros $perros
     * @return Protectoras
     */
    public function addPerro(\Destiny\KobuBundle\Entity\ProtectorasPerros $perros)
    {
        $this->perros[] = $perros;

        return $this;
    }

    /**
     * Remove perros
     *
     * @param \Destiny\KobuBundle\Entity\ProtectorasPerros $perros
     */
    public function removePerro(\Destiny\KobuBundle\Entity\ProtectorasPerros $perros)
    {
        $this->perros->removeElement($perros);
    }

    /**
     * Get perros
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPerros()
    {
        return $this->perros;
    }
}
