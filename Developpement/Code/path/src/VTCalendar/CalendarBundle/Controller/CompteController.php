<?php

namespace VTCalendar\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CompteController extends Controller{
	
	public function compteAction(){
		
		$session = new Session();
		
		$user = $session->get('user_id');
		$conn = $this->get('database_connection');
		
		//Requête pour permettre l'affichage des séances pour un prof connecté
		$sqllogin = $conn->fetchAll('  SELECT DISTINCT login, emailProf
                                        FROM login_prof
                                        WHERE login_prof.codeProf = ?', array($user));
		
		return $this->render('CalendarBundle:Default:gestionCompte.html.twig', array('login' => $sqllogin));
	}
	
	public function majEmailAction(Request $request){
		
		$session = new Session();
		
		$newemail = $request->get('newemail');
		
		$user = $session->get('user_id');
		$conn = $this->get('database_connection');
		
		$sql = "UPDATE LOGIN_PROF SET emailProf = '$newemail' WHERE codeProf = '$user'";
		
		$conn->executeQuery($sql);
		
		return new RedirectResponse($this->generateUrl('calendar_home_page'));

	}
	
}