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
}
