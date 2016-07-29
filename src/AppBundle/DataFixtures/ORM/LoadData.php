<?php
	namespace AppBundle\DataFixtures\ORM;

	use Doctrine\Common\DataFixtures\FixtureInterface;
	use Doctrine\Common\Persistence\ObjectManager;
	use Symfony\Component\DependencyInjection\ContainerAwareInterface;
	use Symfony\Component\DependencyInjection\ContainerInterface;
	use AppBundle\Entity\User;
	use AppBundle\Entity\Curso;
	use AppBundle\Entity\Colegio;
	use AppBundle\Entity\Monitor;
	use AppBundle\Entity\Nivel;
	use AppBundle\Entity\Actividad;

	class LoadData implements FixtureInterface, ContainerAwareInterface
	{
	
		/**
		 * @var ContainerInterface
		 */
		private $container;		

		public function setContainer(ContainerInterface $container = null)
		{
			$this->container = $container;
		}
		
		public function load(ObjectManager $manager)
		{
		
			$array_data = array();
		
			$encoder = $this->container->get('security.password_encoder');
			
			//-----------------------------------------------------
			//Creacion de Usuarios
			//-----------------------------------------------------
			//Usuario admin
			$userAdmin = new User();
			$userAdmin->setUsername('admin');
						
			$password = $encoder->encodePassword($userAdmin, '123');	
			$userAdmin->setPassword($password);
			
			$userAdmin->setEmail('admin@gmail.com');
			$userAdmin->setRole('ROLE_ADMIN');
			$userAdmin->setIsActive(true);

			$manager->persist($userAdmin);
			$manager->flush();
			
			$array_data['admin'] = $userAdmin->getId();
			
			//Usuario prueba
			$user = new User();
			$user->setUsername('prueba');
						
			$password = $encoder->encodePassword($user, '123');	
			$user->setPassword($password);
			
			$user->setEmail('prueba@gmail.com');
			$user->setRole('ROLE_USER');
			$user->setIsActive(true);

			$manager->persist($user);
			$manager->flush();		
			
			$array_data['prueba'] = $user->getId();

			//-----------------------------------------------------
			//Creacion de Cursos
			//-----------------------------------------------------
			$rg = new Curso();
			$rg->setNombre('6ª de PRIMARIA');
						
			$manager->persist($rg);
			$manager->flush();
			
			$array_data['curso1'] = $rg->getId();
			
			$rg = new Curso();
			$rg->setNombre('1º de ESO');
						
			$manager->persist($rg);
			$manager->flush();
			
			$array_data['curso2'] = $rg->getId();
			
			$rg = new Curso();
			$rg->setNombre('2º de ESO');
						
			$manager->persist($rg);
			$manager->flush();		
			
			$array_data['curso3'] = $rg->getId();
			
			$rg = new Curso();
			$rg->setNombre('3º de ESO');
						
			$manager->persist($rg);
			$manager->flush();	
			
			$array_data['curso4'] = $rg->getId();
			
			$rg = new Curso();
			$rg->setNombre('4º de ESO');
						
			$manager->persist($rg);
			$manager->flush();	
			
			$array_data['curso5'] = $rg->getId();
			
			$rg = new Curso();
			$rg->setNombre('1º de BACHILLERATO');
						
			$manager->persist($rg);
			$manager->flush();		
			
			$array_data['curso6'] = $rg->getId();
			
			$rg = new Curso();
			$rg->setNombre('2º de BACHILLERATO');
						
			$manager->persist($rg);
			$manager->flush();	
			
			$array_data['curso7'] = $rg->getId();
			
			//-----------------------------------------------------
			//Creacion de Colegios
			//-----------------------------------------------------
			$rg = new Colegio();
			$rg->setNombre('LA INMACULADA GRANADA');
						
			$manager->persist($rg);
			$manager->flush();
			
			$array_data['col1'] = $rg->getId();
			
			$rg = new Colegio();
			$rg->setNombre('LA INMACULADA CORDOBA');
						
			$manager->persist($rg);
			$manager->flush();			
			
			$array_data['col2'] = $rg->getId();
			
			$rg = new Colegio();
			$rg->setNombre('LA INMACULADA SEVILLA');
						
			$manager->persist($rg);
			$manager->flush();
			
			$array_data['col3'] = $rg->getId();
			
			$rg = new Colegio();
			$rg->setNombre('LA INMACULADA MALAGA');
						
			$manager->persist($rg);
			$manager->flush();	
			
			$array_data['col4'] = $rg->getId();
			
			$rg = new Colegio();
			$rg->setNombre('LA INMACULADA MURCIA');
						
			$manager->persist($rg);
			$manager->flush();
			
			$array_data['col5'] = $rg->getId();
			
			//-----------------------------------------------------
			//Creacion de Monitores
			//-----------------------------------------------------
			$rg = new Monitor();
			$rg->setNombre('Ivan');						
						
			$manager->persist($rg);
			$manager->flush();		
			
			$array_data['m1'] = $rg->getId();
		
			$rg = new Monitor();
			$rg->setNombre('Pepito');
						
			$manager->persist($rg);
			$manager->flush();				
			
			$array_data['m2'] = $rg->getId();
		
			$rg = new Monitor();
			$rg->setNombre('Jose');
						
			$manager->persist($rg);
			$manager->flush();	
			
			$array_data['m3'] = $rg->getId();
		
			//-----------------------------------------------------
			//Creacion de Niveles
			//-----------------------------------------------------
			$rg = new Nivel();
			$rg->setNombre('MARCHA 1');
			$rg->setMonitores(array($array_data['m1'],$array_data['m3']));
						
			$manager->persist($rg);
			$manager->flush();	
			
			$array_data['niv1'] = $rg->getId();
			
			$rg = new Nivel();
			$rg->setNombre('MARCHA 2');
			$rg->setMonitores(array($array_data['m2'],$array_data['m3']));
						
			$manager->persist($rg);
			$manager->flush();	
			
			$array_data['niv2'] = $rg->getId();
			
			$rg = new Nivel();
			$rg->setNombre('MARCHA 3');
			$rg->setMonitores(array($array_data['m1'],$array_data['m2']));
						
			$manager->persist($rg);
			$manager->flush();		
			
			$array_data['niv3'] = $rg->getId();
			
			//-----------------------------------------------------
			//Creacion de Actividades
			//-----------------------------------------------------		
			
			$rg = new Actividad();
			$rg->setNombre('CAMPAMENTO MARCHA 1 ORIENTAL');
			$rg->setCurso($array_data['curso1']);
			$rg->setFechaIni(date_create('01-07-2016'));
			$rg->setFechaFin(date_create('20-07-2016'));
			$rg->setLugar('FUENTEHERIDOS');
			$rg->setColegios(array($array_data['col1'],$array_data['col2']));
			$rg->setNiveles(array($array_data['niv1'],$array_data['niv3']));
			$rg->setActiva(true);
						
			$manager->persist($rg);
			$manager->flush();		
			
			$array_data['act1'] = $rg->getId();
			
			$rg = new Actividad();
			$rg->setNombre('CAMPAMENTO SIERRA NEVADA');
			$rg->setCurso($array_data['curso2']);
			$rg->setFechaIni(date_create('05-07-2016'));
			$rg->setFechaFin(date_create('31-07-2016'));
			$rg->setLugar('FUENTEHERIDOS');
			$rg->setColegios(array($array_data['col3'],$array_data['col1']));
			$rg->setNiveles(array($array_data['niv3'],$array_data['niv2']));
			$rg->setActiva(true);
						
			$manager->persist($rg);
			$manager->flush();		
			
			$array_data['act2'] = $rg->getId();		
			
			
			
			
						
		}

		public function getOrder()
		{
			// the order in which fixtures will be loaded
			// the lower the number, the sooner that this fixture is loaded
			return 1;
		}
	}