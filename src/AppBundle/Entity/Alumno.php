<?php
	
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="alumno")
 */
class Alumno
{
    /**
	 * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */	
	private $id;			// Id del nivel

    /**
     * @ORM\Column(type="string", length=200)
	 * @Assert\NotNull(message="Debe indicar el nombre del alumno")	 	 	 
     */	
	private $nombre;		// Nombre del alumno
	
    /**
     * @ORM\Column(type="string", length=200)
	 * @Assert\NotNull(message="Debe indicar el 1º Apellido")	 	 	 
     */	
	private $apellido1;		// Apellido 1
	
    /**
     * @ORM\Column(type="string", length=200)
	 * @Assert\NotNull(message="Debe indicar el 2º Apellido")	 	 	 	 
     */	
	private $apellido2;		// Apellido 2	
	
    /**
     * @ORM\Column(type="date")
     */	
	private $fecha_nasc;	// Fecha de Inicio		
	
    /**
     * @ORM\Column(type="integer")
	 * @Assert\NotNull(message="Debe el curso")	 	 	 	 
     */	
	private $curso;		// Curso	
	
    /**
     * @ORM\Column(type="integer")
	 * @Assert\NotNull(message="Debe indicar el colegio")	 	 	 	 
     */	
	private $colegio;		// Colegio	
	
    /**
     * @ORM\Column(type="integer")
	 * @Assert\NotNull(message="Debe indicar el nivel")	 	 	 	 	 
     */	
	private $nivel;		// Nivel	
	
	
    /**
     * @ORM\Column(type="integer", nullable=TRUE)
     */	
	private $padre;		// Padre
	
    public function __construct()
    {
        $this->padre = -1;
    }	

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
     * @return Alumno
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
     * Set apellido1
     *
     * @param string $apellido1
     * @return Alumno
     */
    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    /**
     * Get apellido1
     *
     * @return string 
     */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * Set apellido2
     *
     * @param string $apellido2
     * @return Alumno
     */
    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    /**
     * Get apellido2
     *
     * @return string 
     */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * Set fecha_nasc
     *
     * @param \DateTime $fechaNasc
     * @return Alumno
     */
    public function setFechaNasc($fechaNasc)
    {
        $this->fecha_nasc = $fechaNasc;

        return $this;
    }

    /**
     * Get fecha_nasc
     *
     * @return \DateTime 
     */
    public function getFechaNasc()
    {
        return $this->fecha_nasc;
    }

    /**
     * Set curso
     *
     * @param integer $curso
     * @return Alumno
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return integer 
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set colegio
     *
     * @param integer $colegio
     * @return Alumno
     */
    public function setColegio($colegio)
    {
        $this->colegio = $colegio;

        return $this;
    }

    /**
     * Get colegio
     *
     * @return integer 
     */
    public function getColegio()
    {
        return $this->colegio;
    }

    /**
     * Set nivel
     *
     * @param integer $nivel
     * @return Alumno
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return integer 
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set padre
     *
     * @param integer $padre
     * @return Alumno
     */
    public function setPadre($padre)
    {
        $this->padre = $padre;

        return $this;
    }

    /**
     * Get padre
     *
     * @return integer 
     */
    public function getPadre()
    {
        return $this->padre;
    }
	
	public function getUrlAmigable(){
        $nombre = trim($this->getNombre().' '.$this->getApellido1().' '.$this->getApellido2());
        $nombre = $this->normalize($nombre);
        $nombre = strtolower($nombre);
        return $this->getId() . '-' . urlencode($nombre);
    }
	
	public static function normalize($texto){
        $texto = str_replace("/","-",$texto);
		$texto = str_replace(" ","-",$texto);
        return preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($texto, ENT_QUOTES, 'UTF-8'));
    }	
	

}
