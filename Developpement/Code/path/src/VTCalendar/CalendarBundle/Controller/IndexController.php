<?php

namespace VTCalendar\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class IndexController extends Controller
{
    public function indexAction()
    {
        $session = new Session();
        
        if($session->get('user') != null){
            return $this->render('CalendarBundle:Default:index.html.twig', array('user' => $session->get('user')));
        }
        
        else{
            return $this->render('CalendarBundle:Default:login.html.twig');
        }
        
    }
    
    
    public function ajoutMatiereAction(Request $request)
    {
        if($request->getMethod() == "POST"){
            
            $connection = mysql_connect( "localhost", "root", "root" ) ;
            $db  = mysql_select_db( "VT" ) ;
            
            $nomMatiere = $request->get('nom');
            $dateCreation = date("Y-m-d H:i:s");
            $codeProprietaire = 777;
            $sql = "INSERT  INTO matieres (nom, dateCreation, codeProprietaire) VALUES ( '$nomMatiere', '$dateCreation', '$codeProprietaire')";
            $requete = mysql_query($sql, $connection) or die( mysql_error() );
            
            return new RedirectResponse($this->generateUrl('calendar_home_page'));
            
        }
        
        return new RedirectResponse($this->generateUrl('calendar_home_page'));
    }
    
}
