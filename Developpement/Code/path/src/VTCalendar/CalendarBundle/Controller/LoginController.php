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
            
            $user = $conn->fetchAll('SELECT login, codeProf FROM login_prof WHERE login = ? AND motPasse = ?', array($userMail, md5($userPassword)));
        
            if($user){
                
                $session = new Session();
                $session->start();
                $session->set('user', $user);
                
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

}
