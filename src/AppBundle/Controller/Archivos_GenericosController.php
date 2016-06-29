<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Curso;
use AppBundle\Entity\Colegio;
use AppBundle\Entity\Monitor;
use AppBundle\Entity\Nivel;
use AppBundle\Entity\Actividad;
use AppBundle\Entity\Alumno;
use AppBundle\Entity\User;
use AppBundle\Form\RoleType;

class Archivos_GenericosController extends Controller
{
	private $DEFAULT_THEME = "default";
	
	
    /**
     * @Route("/curso", name="curso")
     */
    public function cursoAction(Request $request)
    {	
		$session = $request->getSession();
		$session->set('theme',$this->DEFAULT_THEME);	
		$theme = $session->get('theme',$this->DEFAULT_THEME);
		
		$arg = array();
		
		$rg = new Curso();
		$form = $this->createFormBuilder($rg)
			->add('nombre', 'text', array('label' => 'Nombre del Curso','required'  => false))
			->getForm();
			
		$form->handleRequest($request);
	 
		if ($form->isValid()) {
			//Guardamos en la base de datos
			$bd = $this->getDoctrine()->getManager();
			$bd->persist($rg);
			$bd->flush();
	 
			//return $this->redirect($this->generateUrl('curso_success'));
		}			
			
		$arg['form'] = $form->createView();
		
		//Listamos el contenido de la tabla
		$repository = $this->getDoctrine()->getRepository('AppBundle:Curso');
        $list = $repository->findAll();		
		
		$arg['list'] = $list;
	
		return $this->render($theme.'/curso.html.twig', $arg);
	}	
	
	/**
	* @Route("/eliminar_curso/{id}", name="eliminar_curso")
    */
    public function eliminar_cursoAction(Request $request, $id)	
    {		
		$db = $this->getDoctrine()->getEntityManager();
		$repository = $db->getRepository('AppBundle:Curso');

		$rg = $repository->find($id);
		$db->remove($rg);
		$db->flush();
	
		return $this->redirectToRoute('curso'); 		
	}
	
    /**
     * @Route("/colegio", name="colegio")
     */
    public function colegioAction(Request $request)
    {
		$session = $request->getSession();
		$session->set('theme',$this->DEFAULT_THEME);	
		$theme = $session->get('theme',$this->DEFAULT_THEME);
		
		$arg = array();
		
		$rg = new Colegio();
		$form = $this->createFormBuilder($rg)
			->add('nombre', 'text', array('label' => 'Nombre del Colegio','required'  => false))
			->getForm();
			
		$form->handleRequest($request);
	 
		if ($form->isValid()) {
			//Guardamos en la base de datos
			$bd = $this->getDoctrine()->getManager();
			$bd->persist($rg);
			$bd->flush();
	 
			//return $this->redirect($this->generateUrl('curso_success'));
		}			
			
		$arg['form'] = $form->createView();
		
		//Listamos el contenido de la tabla
		$repository = $this->getDoctrine()->getRepository('AppBundle:Colegio');
        $list = $repository->findAll();		
		
		$arg['list'] = $list;
		
	
		return $this->render($theme.'/colegio.html.twig', $arg);
	}	
	
	/**
	* @Route("/eliminar_colegio/{id}", name="eliminar_colegio")
    */
    public function eliminar_colegioAction(Request $request, $id)	
    {		
		$db = $this->getDoctrine()->getEntityManager();
		$repository = $db->getRepository('AppBundle:Colegio');

		$rg = $repository->find($id);
		$db->remove($rg);
		$db->flush();
	
		return $this->redirectToRoute('colegio'); 		
	}	
	
    /**
     * @Route("/monitor", name="monitor")
     */
    public function monitorAction(Request $request)
    {
		$session = $request->getSession();
		$session->set('theme',$this->DEFAULT_THEME);	
		$theme = $session->get('theme',$this->DEFAULT_THEME);
		
		$arg = array();
		
		$rg = new Monitor();
		$form = $this->createFormBuilder($rg)
			->add('nombre', 'text', array('label' => 'Nombre del Monitor','required'  => false))
			->getForm();
			
		$form->handleRequest($request);
	 
		if ($form->isValid()) {
			//Guardamos en la base de datos
			$bd = $this->getDoctrine()->getManager();
			$bd->persist($rg);
			$bd->flush();
	 
			//return $this->redirect($this->generateUrl('curso_success'));
		}			
			
		$arg['form'] = $form->createView();
		
		//Listamos el contenido de la tabla
		$repository = $this->getDoctrine()->getRepository('AppBundle:Monitor');
        $list = $repository->findAll();		
		
		$arg['list'] = $list;
	
		return $this->render($theme.'/monitor.html.twig', $arg);
	}	
	
	/**
	* @Route("/eliminar_monitor/{id}", name="eliminar_monitor")
    */
    public function eliminar_monitorAction(Request $request, $id)	
    {		
		$db = $this->getDoctrine()->getEntityManager();
		$repository = $db->getRepository('AppBundle:Monitor');

		$rg = $repository->find($id);
		$db->remove($rg);
		$db->flush();
	
		return $this->redirectToRoute('monitor'); 		
	}	
	
	
    /**
     * @Route("/nivel", name="nivel")
     */
    public function nivelAction(Request $request)
    {
		$session = $request->getSession();
		$session->set('theme',$this->DEFAULT_THEME);	
		$theme = $session->get('theme',$this->DEFAULT_THEME);
		
		$arg = array();
		
		//Buscamos los Monitores
		$choices          = [];
		$table2Repository = $this->getDoctrine()->getRepository('AppBundle:Monitor');
		$table2Objects    = $table2Repository->findAll();

		foreach ($table2Objects as $table2Obj) {
			$choices[$table2Obj->getId()] = $table2Obj->getNombre();
		}		
		
		
		$rg = new Nivel();
		$form = $this->createFormBuilder($rg)
			->add('nombre', 'text', array('label' => 'Nombre del Nivel','required'  => false))
			//->add('id_monitor', 'integer', array('label' => 'Monitor'))
			//'mapped'  => true,
			->add('monitores', 'choice', array('multiple' => true,'choices' => $choices,'required'  => false))
			->getForm();
			
		$form->handleRequest($request);
	 
		if ($form->isValid()) {
			//Guardamos en la base de datos
			$bd = $this->getDoctrine()->getManager();
			$bd->persist($rg);
			$bd->flush();
	 
		}			
			
		$arg['form'] = $form->createView(); 
		
		//Listamos el contenido de la tabla
		$repository = $this->getDoctrine()->getRepository('AppBundle:Nivel');
		
		//Cambiamos los id's de los monitores por nombres
        $list = $repository->findAll();	
		$rep2 = $this->getDoctrine()->getRepository('AppBundle:Monitor');
		foreach ($list as $nivel) {
			$ls_monitores=array();
			foreach ($nivel->getMonitores() as $id_monitor) {
				$rg2 = $rep2->find($id_monitor);	
				$ls_monitores[]=$rg2->getNombre();
			}
			$nivel->setMonitores($ls_monitores);
		}
				
		$arg['list'] = $list;
	
		return $this->render($theme.'/nivel.html.twig', $arg);
	}	
	
	/**
	* @Route("/eliminar_nivel/{id}", name="eliminar_nivel")
    */
    public function eliminar_nivelAction(Request $request, $id)	
    {		
		$db = $this->getDoctrine()->getEntityManager();
		$repository = $db->getRepository('AppBundle:Nivel');

		$rg = $repository->find($id);
		$db->remove($rg);
		$db->flush();
	
		return $this->redirectToRoute('nivel'); 		
	}		
	
    /**
     * @Route("/actividad", name="actividad")
     */
    public function actividadAction(Request $request)
    {
		$session = $request->getSession();
		$session->set('theme',$this->DEFAULT_THEME);	
		$theme = $session->get('theme',$this->DEFAULT_THEME);
		
		$arg = array();
		
		//Buscamos los Cursos
		$ls_cursos        = [];
		$rep = $this->getDoctrine()->getRepository('AppBundle:Curso');
		foreach ($rep->findAll() as $obj) {
			$ls_cursos[$obj->getId()] = $obj->getNombre();
		}		

		//Buscamos los Colegios
		$ls_colegios        = [];
		$rep = $this->getDoctrine()->getRepository('AppBundle:Colegio');
		foreach ($rep->findAll() as $obj) {
			$ls_colegios[$obj->getId()] = $obj->getNombre();
		}		
		
		//Buscamos los niveles
		$ls_niveles        = [];		
		$rep = $this->getDoctrine()->getRepository('AppBundle:Nivel');
		foreach ($rep->findAll() as $obj) {
			$ls_niveles[$obj->getId()] = $obj->getNombre();
		}				
		
		
		$rg = new Actividad();
		$form = $this->createFormBuilder($rg)
			->add('nombre', 'text', array('label' => 'Nombre de la actividad','required'  => false))
			->add('curso', 'choice', array('multiple' => false,'choices' => $ls_cursos,'required'  => false))
			->add('fecha_ini', 'date', array('label' => 'Fecha de Inicio','format'=>'d/M/y'))
			->add('fecha_fin', 'date', array('label' => 'Fecha de Fin','format'=>'d/M/y'))
			->add('lugar', 'text', array('label' => 'Lugar','required'  => false))
			->add('colegios', 'choice', array('multiple' => true,'choices' => $ls_colegios,'required'  => false))
			->add('niveles', 'choice', array('multiple' => true,'choices' => $ls_niveles,'required'  => false))
			->add('activa', 'checkbox', array('label' => '¿Activa?','required'  => false))
			->getForm();
			
		$form->handleRequest($request);
	 
		if ($form->isValid()) {
			//Guardamos en la base de datos
			$bd = $this->getDoctrine()->getManager();
			$bd->persist($rg);
			$bd->flush();
	 
		}			
			
		$arg['form'] = $form->createView(); 
		
		
		//Listamos el contenido de la tabla
		$repository = $this->getDoctrine()->getRepository('AppBundle:Actividad');		
        $list = $repository->findAll();	
		
		
		$rep_cursos = $this->getDoctrine()->getRepository('AppBundle:Curso');
		$rep_colegios = $this->getDoctrine()->getRepository('AppBundle:Colegio');
		$rep_niveles = $this->getDoctrine()->getRepository('AppBundle:Nivel');		
		$rep_alumnos = $this->getDoctrine()->getRepository('AppBundle:Alumno');
		foreach ($list as $actividad) {
			//Cambiamos el id del curso por el nombre
			$rg2 = $rep_cursos->find($actividad->getCurso());	
			$actividad->setCurso($rg2->getNombre());
		
			//Cambiamos los id's de los colegios por nombres
			$ls_colegios=array();
			foreach ($actividad->getColegios() as $id) {
				$rg2 = $rep_colegios->find($id);	
				$ls_colegios[]=$rg2->getNombre();
			}
			$actividad->setColegios($ls_colegios);
			
			//Cambiamos los id's de los niveles por nombres
			$ls_niveles=array();
			foreach ($actividad->getNiveles() as $id) {
				$rg2 = $rep_niveles->find($id);	
				$ls_niveles[]=$rg2->getNombre();
			}
			$actividad->setNiveles($ls_niveles);		
			
			//Cambiamos los id's de los alumnos por nombres			
			if (!empty($actividad->getAlumnos())) {
				$ls_alumnos=array();
				foreach ($actividad->getAlumnos() as $id) {
					$rg2 = $rep_alumnos->find($id);	
					if ($rg2 == null)continue;
					$ls_alumnos[]=$rg2->getNombre() . ' ' . $rg2->getApellido1();
				}
				$actividad->setAlumnos($ls_alumnos);				
			}	
			
			if ($actividad->getActiva() == 1)
				$actividad->setActiva("Si");
			else
				$actividad->setActiva("No");
			
		}
		
				
		$arg['list'] = $list;
	
		return $this->render($theme.'/actividad.html.twig', $arg);
	}	
	
	/**
	* @Route("/eliminar_actividad/{id}", name="eliminar_actividad")
    */
    public function eliminar_actividadAction(Request $request, $id)	
    {		
		$db = $this->getDoctrine()->getEntityManager();
		$repository = $db->getRepository('AppBundle:Actividad');

		$rg = $repository->find($id);
		$db->remove($rg);
		$db->flush();
	
		return $this->redirectToRoute('actividad'); 		
	}		
	
	
    /**
     * @Route("/alumno", name="alumno")
     */
    public function alumnoAction(Request $request)
    {
		$session = $request->getSession();
		$session->set('theme',$this->DEFAULT_THEME);	
		$theme = $session->get('theme',$this->DEFAULT_THEME);
		
		$arg = array();
		
		//Buscamos los Cursos
		$ls_cursos        = [];
		$rep = $this->getDoctrine()->getRepository('AppBundle:Curso');
		foreach ($rep->findAll() as $obj) {
			$ls_cursos[$obj->getId()] = $obj->getNombre();
		}		

		//Buscamos los Colegios
		$ls_colegios        = [];
		$rep = $this->getDoctrine()->getRepository('AppBundle:Colegio');
		foreach ($rep->findAll() as $obj) {
			$ls_colegios[$obj->getId()] = $obj->getNombre();
		}		
		
		//Buscamos los niveles
		$ls_niveles        = [];		
		$rep = $this->getDoctrine()->getRepository('AppBundle:Nivel');
		foreach ($rep->findAll() as $obj) {
			$ls_niveles[$obj->getId()] = $obj->getNombre();
		}				
		
		
		$rg = new Alumno();
		$form = $this->createFormBuilder($rg)
			->add('nombre', 'text', array('label' => 'Nombre','required'  => false))
			->add('apellido1', 'text', array('label' => '1º Apellido','required'  => false))
			->add('apellido2', 'text', array('label' => '2º Apellido','required'  => false))
			->add('fecha_nasc', 'date', array('label' => 'Fecha de Inicio','format'=>'d/M/y'))
			->add('curso', 'choice', array('multiple' => false,'choices' => $ls_cursos,'required'  => false))
			->add('colegio', 'choice', array('multiple' => false,'choices' => $ls_colegios,'required'  => false))
			->add('nivel', 'choice', array('multiple' => false,'choices' => $ls_niveles,'required'  => false))
			->getForm();
			
		$form->handleRequest($request);
		
		$user= $this->get('security.context')->getToken()->getUser();			
		if ($form->isValid()) {
			//Verificamos cual es el usuario concetado
			
			
			//Guardamos en la base de datos
			$bd = $this->getDoctrine()->getManager();
			$rg->setPadre($user->getId());
			$bd->persist($rg);
			$bd->flush();
	 
		}			
			
		$arg['form'] = $form->createView(); 
		
		
		//Listamos el contenido de la tabla
		$repository = $this->getDoctrine()->getRepository('AppBundle:Alumno');		
        $list = $repository->findBy(array('padre' => $user->getId()));	
				
		$rep_cursos = $this->getDoctrine()->getRepository('AppBundle:Curso');
		$rep_colegios = $this->getDoctrine()->getRepository('AppBundle:Colegio');
		$rep_niveles = $this->getDoctrine()->getRepository('AppBundle:Nivel');		
		foreach ($list as $alumno) {
			//Cambiamos el id del curso por el nombre
			$rg2 = $rep_cursos->find($alumno->getCurso());	
			$alumno->setCurso($rg2->getNombre());
			
			//Cambiamos el id del colegio por el nombre
			$rg2 = $rep_colegios->find($alumno->getColegio());	
			$alumno->setColegio($rg2->getNombre());
			
			//Cambiamos el id del nivel por el nombre
			$rg2 = $rep_niveles->find($alumno->getNivel());	
			$alumno->setNivel($rg2->getNombre());		
		
		}
		
				
		$arg['list'] = $list;
	
		return $this->render($theme.'/alumno.html.twig', $arg);
	}	
	
	/**
	* @Route("/eliminar_alumno/{id}", name="eliminar_alumno")
    */
    public function eliminar_alumnoAction(Request $request, $id)	
    {		
		$db = $this->getDoctrine()->getEntityManager();
		$repository = $db->getRepository('AppBundle:Alumno');

		$rg = $repository->find($id);
		$db->remove($rg);
		$db->flush();
	
		return $this->redirectToRoute('alumno'); 		
	}
	
	/**
	* @Route("/actividades_alumno/{id}", name="actividades_alumno")
    */
    public function actividades_alumnoAction(Request $request, $id)	
    {		
	
		$session = $request->getSession();
		$session->set('theme',$this->DEFAULT_THEME);	
		$theme = $session->get('theme',$this->DEFAULT_THEME);
		
		$db = $this->getDoctrine()->getEntityManager();
		$rep_alumno = $db->getRepository('AppBundle:Alumno');
		$rep_activ = $db->getRepository('AppBundle:Actividad');
		
		$alumno = $rep_alumno->find($id);
		
		$rep_cursos = $this->getDoctrine()->getRepository('AppBundle:Curso');
		$rep_colegios = $this->getDoctrine()->getRepository('AppBundle:Colegio');
		$rep_niveles = $this->getDoctrine()->getRepository('AppBundle:Nivel');				

		//Cambiamos el id del curso por el nombre
		$rg2 = $rep_cursos->find($alumno->getCurso());	
		$alumno->setCurso($rg2->getNombre());
		
		//Cambiamos el id del colegio por el nombre
		$rg2 = $rep_colegios->find($alumno->getColegio());	
		$alumno->setColegio($rg2->getNombre());
		
		//Cambiamos el id del nivel por el nombre
		$rg2 = $rep_niveles->find($alumno->getNivel());	
		$alumno->setNivel($rg2->getNombre());		
		
		$rep_activ = $this->getDoctrine()->getRepository('AppBundle:Actividad');	
		$actividades = $rep_activ->findAll();

		$arg = array();
		$arg['alumno'] = $alumno;
		$arg['actividades'] = $actividades;

		return $this->render($theme.'/actividades_alumno.html.twig', $arg); 		
	}	
	
	/**
	* @Route("/asignar_actividad/{id_alumno}/{id_actividad}", name="asignar_actividad")
    */
    public function asignar_actividadAction(Request $request, $id_alumno, $id_actividad)	
    {		
		$db = $this->getDoctrine()->getEntityManager();
		$repository = $db->getRepository('AppBundle:Actividad');

		$rg = $repository->find($id_actividad);
		$ls_alumnos = $rg->getAlumnos();
		if (!in_array($id_alumno,$ls_alumnos)){
			$ls_alumnos[] = $id_alumno;
			$rg->setAlumnos($ls_alumnos);
			$db->persist($rg);
			$db->flush();
		}

		return $this->redirect($this->generateUrl('actividades_alumno', array('id' => $id_alumno)));	
	}	
	
	/**
	* @Route("/quitar_actividad/{id_alumno}/{id_actividad}", name="quitar_actividad")
    */
    public function quitar_actividadAction(Request $request, $id_alumno, $id_actividad)	
    {		
		$db = $this->getDoctrine()->getEntityManager();
		$repository = $db->getRepository('AppBundle:Actividad');

		$rg = $repository->find($id_actividad);
		$ls_alumnos = $rg->getAlumnos();

		$key = array_search($id_alumno,$ls_alumnos);
		if($key!==false){
			unset($ls_alumnos[$key]);
		}
		
		$rg->setAlumnos($ls_alumnos);
		$db->persist($rg);
		$db->flush();
		
		
	
		return $this->redirect($this->generateUrl('actividades_alumno', array('id' => $id_alumno)));
	}	
	
	
	/**
     * @Route("/lista_usuarios", name="lista_usuarios")
     */
    public function usuarioAction(Request $request)
    {	
		$db = $this->getDoctrine()->getEntityManager();
		$repository = $db->getRepository('AppBundle:User');

		/*
		//Para borrar todos los usuarios
		$ls_rg = $repository->findall();
		foreach ($ls_rg as $rg) {
			$db->remove($rg);
			$db->flush();
		}
		*/
	
		$session = $request->getSession();
		$session->set('theme',$this->DEFAULT_THEME);	
		$theme = $session->get('theme',$this->DEFAULT_THEME);
		
		$arg = array();
		
		//Listamos el contenido de la tabla
		$repository = $this->getDoctrine()->getRepository('AppBundle:User');
        $list = $repository->findAll();		
		
		$arg['list'] = $list;
	
		return $this->render($theme.'/lista_usuarios.html.twig', $arg);
	}	
	
	/**
	* @Route("/eliminar_usuario/{id}", name="eliminar_usuario")
    */
    public function eliminar_usuarioAction(Request $request, $id)	
    {		
		$db = $this->getDoctrine()->getEntityManager();
		$repository = $db->getRepository('AppBundle:User');

		$rg = $repository->find($id);
		$db->remove($rg);
		$db->flush();
	
		return $this->redirectToRoute('lista_usuarios'); 		
	}	
	
	
	/**
	* @Route("/editar_usuario/{id}", name="editar_usuario")
    */
    public function editar_usuarioAction(Request $request, $id)	
    {		
		$session = $request->getSession();
		$session->set('theme',$this->DEFAULT_THEME);	
		$theme = $session->get('theme',$this->DEFAULT_THEME);
		
		$arg = array();
		
		//Buscamos los Cursos
		$ls_tipo_usuario = [];
		$ls_tipo_usuario['ROLE_ADMIN'] = 'Administrador';
		$ls_tipo_usuario['ROLE_USER'] = 'Normal';

		$db = $this->getDoctrine()->getEntityManager();
		$repository = $db->getRepository('AppBundle:User');
		$rg = $repository->find($id);
		$form = $this->createFormBuilder($rg)
			->add('username', 'text', array('label' => 'Username'))
			->add('email', 'text', array('label' => 'Email'))
			->add('role', 'choice', array('label' => 'Tipo de Usuario','multiple' => false,'choices' => $ls_tipo_usuario,'required'  => true))
			->add('isactive', 'checkbox', array('label' => 'Activo','required'  => false))
			->getForm();
						
		//$form->handleRequest($request);
		if ($request->isMethod('POST')) {
			$data = $request->request->all();
			$data=$data['form'];
				
			$username = $data['username'];
			$email = $data['email']; 
			$role = $data['role'];
			$activo = 0;
			if (array_key_exists("isactive",$data))
				$activo = $data['isactive'];
		 
			//Guardamos en la base de datos los nuevos datos
			$bd = $this->getDoctrine()->getManager();
			$rg_original = $repository->find($id);
			$rg_original->setUsername($username);
			$rg_original->setEmail($email);
			$rg_original->setRole($role);
			$rg_original->setIsActive($activo);
			$bd->persist($rg_original);
			$bd->flush();
			
			return $this->redirectToRoute('lista_usuarios');
		}
	 
		
		
			
		$arg['form'] = $form->createView();
	
		return $this->render($theme.'/usuario.html.twig', $arg);	
	}	

	
}

?>