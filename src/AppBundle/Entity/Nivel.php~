<?php
	
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="nivel")
 */
class Nivel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */	
	private $id;			// Id del nivel

    /**
     * @ORM\Column(type="string", length=200)
	 * @Assert\NotNull(message="Debe indicar el nombre del nivel")	 
     */	
	private $nombre;		// Nombre del nivel
	 
	/**
	* @ORM\Column(type="array")
	* @Assert\Count(
	*      min = "1",
	*      minMessage = "Debe inidicar como minimo un monitor",
	* )
	*/	  
    private $monitores = array();	// Array de monitores

 

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
     * @return Nivel
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
     * Set id_monitor
     *
     * @param integer $idMonitor
     * @return Nivel
     */
    public function setIdMonitor($idMonitor)
    {
        $this->id_monitor = $idMonitor;

        return $this;
    }

    /**
     * Get id_monitor
     *
     * @return integer 
     */
    public function getIdMonitor()
    {
        return $this->id_monitor;
    }

    /**
     * Set monitores
     *
     * @param array $monitores
     * @return Nivel
     */
    public function setMonitores($monitores)
    {
        $this->monitores = $monitores;

        return $this;
    }

    /**
     * Get monitores
     *
     * @return array 
     */
    public function getMonitores()
    {
        return $this->monitores;
    }
}
