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
use AppBundle\Entity\User;
use AppBundle\Form\UserType;

class DefaultController extends Controller
{
	private $DEFAULT_THEME = "default";
	
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
		$session = $request->getSession();
		$session->set('theme',$this->DEFAULT_THEME);	
		$theme = $session->get('theme',$this->DEFAULT_THEME);
		
		$arg = array();
	
		return $this->render($theme.'/index.html.twig', $arg);

    }
	
    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction(Request $request)
    {
		$session = $request->getSession();
		$session->set('theme',$this->DEFAULT_THEME);	
		$theme = $session->get('theme',$this->DEFAULT_THEME);
		
		$arg = array();

		return $this->render($theme.'/admin.html.twig', $arg);
	}
	
	/**
     * @Route("/login", name="login")
     */
	public function loginAction(Request $request)
	{
	
		$session = $request->getSession();
		$session->set('theme',$this->DEFAULT_THEME);	
		$theme = $session->get('theme',$this->DEFAULT_THEME);
		
		$authenticationUtils = $this->get('security.authentication_utils');

		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();
		
		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();
		
		//if ($error == '')
		//	return $this->redirectToRoute('homepage');	
	
		$user = new User();
		$form = $this->createForm(UserType::class, $user, array(
			'action' => $this->generateUrl('register'),			
			));

		return $this->render(
			$theme.'/login_register.html.twig',
			array(
				// last username entered by the user
				'last_username' => $lastUsername,
				'error'         => $error,
				'form_active'  => 'login',		
				'form' => $form->createView(),
			)
		);
	}
	
	/**
     * @Route("/logout", name="logout")
     */
	public function logoutAction(Request $request)
	{
		return $this->redirectToRoute('login'); 		
	}		
	
	
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
		$session = $request->getSession();
		$session->set('theme',$this->DEFAULT_THEME);	
		$theme = $session->get('theme',$this->DEFAULT_THEME);
		
        // 1) build the form
        $user = new User();		        
		$form = $this->createForm(UserType::class, $user, array(
			'action' => $this->generateUrl('register'),			
			));
			
		/*
		$data = $request->request->all();
		$user->setUsername($data['username']);
		$user->setUsername($data['email']);
		$user->setUsername($data['password']);
		$user->setUsername($data['confirm-passwor']);
		*/

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('homepage');
        }
		$lastUsername = '';
		$error = '';
		
		
		return $this->render($theme.'/login_register.html.twig',
			array(
				// last username entered by the user
				'last_username' => $lastUsername,
				'error'         => $error,
				'form_active'  => 'register',
				'form' => $form->createView(),
			)
		);
		
		/*
        return $this->render(
            $theme.'/register.html.twig',
            array('form' => $form->createView())
        );
		*/
    }	
	
    /**
     * @Route("/register2", name="register2")
     */
    public function register2Action(Request $request)
    {
		$session = $request->getSession();
		$session->set('theme',$this->DEFAULT_THEME);	
		$theme = $session->get('theme',$this->DEFAULT_THEME);
		
        // 1) build the form
        $user = new User();
		        
		$form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('homepage');
        }
		$lastUsername = '';
		$error = '';
				
        return $this->render(
            $theme.'/register.html.twig',
            array('form' => $form->createView())
        );
		
    }		

	
}
?>