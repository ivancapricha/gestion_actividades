<?php
	
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="actividad")
 */
class Actividad
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */	
	private $id;			// Id del nivel

    /**
     * @ORM\Column(type="string", length=200)
	 * @Assert\NotNull(message="Debe indicar el nombre de la actividad")	 	 
     */	
	private $nombre;		// Nombre de la actividad
	
    /**
     * @ORM\Column(type="string", length=200)
	 * @Assert\NotNull(message="Debe indicar el curso")	 	 	 
     */	
	private $curso;		// Curso
	
    /**
     * @ORM\Column(type="date")
     */	
	private $fecha_ini;		// Fecha de Inicio		
	
    /**
     * @ORM\Column(type="date")
     */	
	private $fecha_fin;		// Fecha de Fin			
	
    /**
     * @ORM\Column(type="string", length=200)
	 * @Assert\NotNull(message="Debe indicar el lugar")	 
     */	
	private $lugar;		// Lugar (Dirreccion de la actividad)	
	 
	/**
	* @ORM\Column(type="array", nullable=true)
	* @Assert\Count(
	*      min = "1",
	*      minMessage = "Debe inidicar al menos un colegio",
	* )		
	*/	 	
    private $colegios;	// Array de colegios
	
	/**
	* @ORM\Column(type="array", nullable=true)
	* @Assert\Count(
	*      min = "1",
	*      minMessage = "Debe inidicar al menos un nivel",
	* )	
	*/	 	
    private $niveles;	// Array de niveles	
	
	/**
	* @ORM\Column(columnDefinition="TINYINT DEFAULT 0 NOT NULL")
	*/	 	
    private $activa;	// Curso activo? (0 or 1)
	
	/**
	* @ORM\Column(type="array", nullable=true)
	*/	 	
    private $alumnos;	// Array de Alumnos en la actividad	


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Actividad
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
     * Set curso
     *
     * @param string $curso
     * @return Actividad
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return string 
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set fecha_ini
     *
     * @param \DateTime $fechaIni
     * @return Actividad
     */
    public function setFechaIni($fechaIni)
    {
        $this->fecha_ini = $fechaIni;

        return $this;
    }

    /**
     * Get fecha_ini
     *
     * @return \DateTime 
     */
    public function getFechaIni()
    {
        return $this->fecha_ini;
    }

    /**
     * Set fecha_fin
     *
     * @param \DateTime $fechaFin
     * @return Actividad
     */
    public function setFechaFin($fechaFin)
    {
        $this->fecha_fin = $fechaFin;

        return $this;
    }

    /**
     * Get fecha_fin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fecha_fin;
    }

    /**
     * Set lugar
     *
     * @param string $lugar
     * @return Actividad
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;

        return $this;
    }

    /**
     * Get lugar
     *
     * @return string 
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set colegios
     *
     * @param array $colegios
     * @return Actividad
     */
    public function setColegios($colegios)
    {
        $this->colegios = $colegios;

        return $this;
    }

    /**
     * Get colegios
     *
     * @return array 
     */
    public function getColegios()
    {
        return $this->colegios;
    }

    /**
     * Set niveles
     *
     * @param array $niveles
     * @return Actividad
     */
    public function setNiveles($niveles)
    {
        $this->niveles = $niveles;

        return $this;
    }

    /**
     * Get niveles
     *
     * @return array 
     */
    public function getNiveles()
    {
        return $this->niveles;
    }

    /**
     * Set activa
     *
     * @param string $activa
     * @return Actividad
     */
    public function setActiva($activa)
    {
        $this->activa = $activa;

        return $this;
    }

    /**
     * Get activa
     *
     * @return string 
     */
    public function getActiva()
    {
        return $this->activa;
    }

    /**
     * Set alumnos
     *
     * @param array $alumnos
     * @return Actividad
     */
    public function setAlumnos($alumnos)
    {
        $this->alumnos = $alumnos;

        return $this;
    }

    /**
     * Get alumnos
     *
     * @return array 
     */
    public function getAlumnos()
    {
        return $this->alumnos;
    }
}
