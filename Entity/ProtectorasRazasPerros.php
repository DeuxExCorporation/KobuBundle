<?php

namespace Destiny\KobuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Mensajes
 *
 * @ORM\Table(name="protectoras_razas_perros")
 * @ORM\Entity(repositoryClass="Destiny\KobuBundle\Entity\Repository\ProtectorasRazasPerrosRepository")
 *
 */
class ProtectorasRazasPerros
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
     * @ORM\OneToMany(targetEntity="Destiny\KobuBundle\Entity\ProtectorasPerros", mappedBy="raza")
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
     * @return ProtectorasPerros
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
     * Set slug
     *
     * @param string $slug
     * @return ProtectorasPerros
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return ProtectorasPerros
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
     * @return ProtectorasPerros
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
     * @return ProtectorasPerros
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
     * @return ProtectorasPerros
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
     * Set protectora
     *
     * @param \Destiny\KobuBundle\Entity\Protectoras $protectora
     * @return ProtectorasPerros
     */
    public function setProtectora(\Destiny\KobuBundle\Entity\Protectoras $protectora = null)
    {
        $this->protectora = $protectora;

        return $this;
    }

    /**
     * Get protectora
     *
     * @return \Destiny\KobuBundle\Entity\Protectoras 
     */
    public function getProtectora()
    {
        return $this->protectora;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->perros = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add perros
     *
     * @param \Destiny\KobuBundle\Entity\ProtectorasPerros $perros
     * @return ProtectorasRazasPerros
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
