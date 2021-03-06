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
            	
            	echo "<script>alert(\"La connexion a échoué. Veuillez entrer à nouveau vos identifiants.\")</script>";
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
    public function sendMailAction(Request $request){
        
        $session = new Session();
        $user = $session->get('user_id');
        
        //partie récupération du mail de l'user
        $conn = $this->get('database_connection');
        
        $User = $request->get('user');
        
        $sql = $conn->executeQuery('SELECT codeProf, emailProf FROM login_prof WHERE login = ?', array ($User));
        
        $mail = $sql->fetch();
        //$requete = mysql_query($sql, $conn) or die( mysql_error() );
                  
        
        $twig = $this->get('twig'); // Twig_Environment
        //$template = $twig->loadTemplate('CalendarBundle:Default:mailTemplate.html.twig');
        //$parameters  = array('user' => $user);
        //$subject  = $template->renderBlock('content', $parameters);
        
        $message = \Swift_Message::newInstance()
        ->setSubject('Visual Time Tabling - Oubli de votre mot de passe')
        ->setFrom('do-not-reply@ibiscreservation.fr')
        ->setTo($mail['emailProf'])
        ->setBody($this->render( 'CalendarBundle:Default:mailTemplate.html.twig', array('userId'=>md5($mail['codeProf']))), 'text/html');
        
        $this->get('mailer')->send($message);
        
        return $this->render('CalendarBundle:Default:login.html.twig');
    }
     
    // Fonction d'affichage de la page d'oubli de mot de passe - où on rentre le mail pour l'envoi de mail
    public function affichageOubliMdpAction(){
        return $this->render('CalendarBundle:Default:oubliMdp.html.twig');
    }
    
     
    // Fonction d'affichage de la page de changement de mot de passe
    public function affichageChangementMdpAction(){
        $error = 0;
        $session = new Session();
        $user = $session->get('user_id');
        return $this->render('CalendarBundle:Default:changementMdp.html.twig', array('error' => $error, 'userId' => $user));
    }
    
    
    // Fonction de changement de mot de passe
    public function verificationNouveauMdpAction (Request $request){
      
      // connection à la BD
      $conn = $this->get('database_connection');
      $session = new Session();
      
      //récupération du nouveau mot de passe entré
      $newMdp = $request->get('newPass');
      $cNewMdp = $request->get('confirmPass');
      
      if($session->get('user_id') != null){
          
          $user = $session->get('user_id');
          if ($newMdp != $cNewMdp) {
            $error = 1;
            return $this->render('CalendarBundle:Default:changementMdp.html.twig', array('error' => $error));
          }
          
          else{
             $conn->executeQuery('UPDATE login_prof SET motPasse = ? WHERE codeProf = ?', array(md5($newMdp), $user));
             return new RedirectResponse($this->generateUrl('calendar_gestion_compte')); 
          }
      }
      
      else{
      //vérification si les 2 corréespondent
        if ($newMdp != $cNewMdp) {
          $error = 1;
          return $this->render('CalendarBundle:Default:changementMdp.html.twig', array('error' => $error));
        }

        else{

            $sqlUsers = $conn->executeQuery('SELECT codeProf FROM login_prof');
            $allUsers = $sqlUsers->fetchAll();

            foreach($allUsers as $user){
                if(md5($user['codeProf']) == $request->get('userId')){
                    $userId = $user['codeProf'];
                    break;
                }
            }

             $conn->executeQuery('UPDATE login_prof SET motPasse = ? WHERE codeProf = ?', array(md5($newMdp), $userId));
             return new RedirectResponse($this->generateUrl('calendar_login_page'));
        }

      }  
    }
    
     
    // Fonction d'affichage de la page de création d'un compte utilisateur
    public function affichageCreationCompteAction() {
        return $this->render('CalendarBundle:Default:creationCompte.html.twig');
    }
    
     
     //Fonction de création d'un compte utilisateur - à terminer lors de l'ajout de mail
      public function creationCompteAction(Request $request){
         
        //connection à la base - à voir pour utiliser fichier ou les paramètres sont déja déclarés
        $conn = $this->get('database_connection');
        
        $nomUser = $request->get('nom');
        $prenomUser = $request->get('prenom');
        $mailUser = $request->get('mail');
        $passUser = $request->get('pass');
        $cpassUser = $request->get('cpass');
        
        //pour TEST, voir comment générer des clés unique à partir de la dernière clé de la base
         
        //vérification mot de passe 
        if ($passUser != $cpassUser) {
        $error = 1;
	return $this->render('CalendarBundle:Default:creationCompte.html.twig', array('error' => $error));
      }
      
      else{
            
            $sqlSelect = $conn->executeQuery('SELECT MAX(codeProf) as nb_id FROM login_prof');
            $res_nb = $sqlSelect->fetch();
            
            $id_last = $res_nb['nb_id'];
           
            $id_plus = $id_last+1;
           
           
            $PassUser = md5($passUser);
      
            
            $sqlInsert = $conn->executeQuery('INSERT INTO login_prof (codeProf, login, motPasse, emailProf) VALUES(?,?,?,?)' , array($id_plus, $nomUser, $PassUser, $mailUser));
        
           return $this->render('CalendarBundle:Default:login.html.twig');
           
      }     
        
   
    }
     

}