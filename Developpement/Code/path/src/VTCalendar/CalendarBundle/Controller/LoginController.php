<?php

namespace VTCalendar\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    public function loginAction(Request $request)
    {
        if($request->getMethod() == 'POST'){
            
            $conn = $this->get('database_connection');
            $userMail=$request->get('mail');
            $userPassword=$request->get('mdp');
            
            $statement = $conn->executeQuery('SELECT login, codeProf FROM login_prof WHERE login = ? AND motPasse = ?', array($userMail, md5($userPassword)));
            $user = $statement->fetch();
            
            if($user){
                
                
                $session = new Session();
                $session->start();
                $session->set('user_id', $user['codeProf']);
                
                return new RedirectResponse($this->generateUrl('calendar_home_page'));
            }   
            
            else{
        
                 return $this->render('CalendarBundle:Default:login.html.twig');
            }
        }
        
        return $this->render('CalendarBundle:Default:login.html.twig');
    }
    
    
    public function logoutAction()
    {
        $session = new Session();
        
        $_SESSION = array();
        
        if (ini_get("session.use_cookies")) {
    
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
            $session->invalidate();
    
        }
        
        //return $this->render('IbiscReservationBundle:Default:login.html.twig', array('alert' => 0));
        return new RedirectResponse($this->generateUrl('calendar_login_page'));
    }
    
    // Fonction d'envoi de mail suite à l'oubli de son mot de passe
    public function sendMailAction(){
        $message = \Swift_Message::newInstance()
        ->setSubject('Visual Time Tabling - Oubli de votre mot de passe')
        ->setFrom('do-not-reply@ibiscreservation.fr')
        ->setTo('christelleayangma@yahoo.fr')
        ->setBody('<h1> test </h1>', 'text/html');
        
        $this->get('mailer')->send($message);
        
        return $this->render('CalendarBundle:Default:login.html.twig');
    }
     
    // Fonction d'affichage de la page d'oubli de mot de passe
    public function affichageOubliMdpAction(){
        return $this->render('CalendarBundle:Default:oubliMdp.html.twig');
    }
        
    // Fonction de vérification pour le changement de mot de passe - à terminer lors de l'ajout de mail
    public function testOubliMdpAction(Request $request)
    {
        $connection = mysql_connect( "localhost", "root", "root" ) ;
        $db  = mysql_select_db( "VT" ) ;
        
        $nomUser = $request->get('user');
        
        return $this->render('CalendarBundle:Default:oubliMdp.html.twig');
        
    }
     
    // Fonction d'affichage de la page de création d'un compte utilisateur
    public function affichageCreationCompteAction() {
        return $this->render('CalendarBundle:Default:creationCompte.html.twig');
    }
     
     //Fonction de création d'un compte utilisateur - à terminer lors de l'ajout de mail
      public function creationCompteAction(Request $request){
        $connection = mysql_connect( "localhost", "root", "root" ) ;
        $db  = mysql_select_db( "VT" ) ;
        
        $nomUser = $request->get('nom');
        
        $sql = "INSERT INTO utilisateurs(login) VALUES('$nomUser')";
            
        $requete = mysql_query($sql, $connection) or die( mysql_error() );
        
        echo "user ajouté !!";
        return $this->render('CalendarBundle:Default:login.html.twig');
    }
     

}