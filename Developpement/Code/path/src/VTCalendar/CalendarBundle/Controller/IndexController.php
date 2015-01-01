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
        
        if($session->get('user_id') != null){
            
            $user = $session->get('user_id');
            $conn = $this->get('database_connection');
            
            //Requête pour permettre l'affichage des séances pour un prof connecté
            $event = $conn->fetchAll('  SELECT DISTINCT seances.codeSeance, seances.dateSeance, seances.heureSeance, seances.dureeSeance, seances.Commentaire, enseignements.nom 
                                        FROM enseignements, seances, seances_profs, ressources_profs, login_prof 
                                        WHERE enseignements.codeEnseignement = seances.codeEnseignement 
                                        AND seances.codeSeance = seances_profs.codeSeance
                                        AND enseignements.codeEnseignement = seances.codeEnseignement
                                        AND ressources_profs.codeProf = seances_profs.codeRessource
                                        AND login_prof.codeProf = ressources_profs.codeProf
                                        AND login_prof.codeProf = ?', array($user));
            
            // Requêtes pour liste déroulante - formulaire Enseignement
            $sqlmatiere = $conn->fetchAll('SELECT MATIERES.codeMatiere, MATIERES.nom FROM MATIERES');
            $sqlzonesalle = $conn->fetchAll('SELECT ZONES_SALLES.codeZoneSalle, ZONES_SALLES.nom FROM ZONES_SALLES');
            $sqlniveau = $conn->fetchAll('SELECT NIVEAUX.codeNiveau, NIVEAUX.nom FROM NIVEAUX');
            $sqltypesalle = $conn->fetchAll('SELECT TYPES_SALLES.codeTypeSalle, TYPES_SALLES.nom FROM TYPES_SALLES');
            $sqlcomposante = $conn->fetchAll('SELECT COMPOSANTES.codeComposante, COMPOSANTES.nom FROM COMPOSANTES');
            $sqltypeactivite = $conn->fetchAll('SELECT TYPES_ACTIVITES.codeTypeActivite, TYPES_ACTIVITES.nom FROM TYPES_ACTIVITES');
            
             // Requêtes pour liste déroulante - formulaire Séance
            $sqlenseignement = $conn->fetchAll('SELECT enseignements.codeEnseignement, enseignements.nom FROM enseignements');
            return $this->render('CalendarBundle:Default:index.html.twig', array('user' => $session->get('user'), 'events' => $event, 'lstSqlMatiere' => $sqlmatiere, 'lstSqlZoneSalle' => $sqlzonesalle, 'lstSqlNiveau' => $sqlniveau, 'lstSqlType' => $sqltypesalle, 'lstSqlEnseignement' => $sqlenseignement, 'lstSqlComposante' => $sqlcomposante, 'lstSqlTypeActivite' => $sqltypeactivite));
            
            
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

    public function ajoutEnseignementAction(Request $request)
    {
        if($request->getMethod() == 'POST'){
            
            $connection = mysql_connect( "localhost", "root", "root" );
            $db  = mysql_select_db("VT");
            
            $nom = $request->get('nom');
            $codeMatiere = $request->get('lstMatieres');
            $dureeTotale = $request->get('dureetotale');
            $dureeSeance = $request->get('dureeseance');
            $alias = $request->get('alias');
            $codeTypeSalle = $request->get('codetypesalle');
            $codeZoneSalle = $request->get('codezonesalle');
            $nbSeancesHebdo = $request->get('nbseanceshebdo');
            $dateDebut = $request->get('dateDebut');
            $dateFin = $request->get('dateFin');
            $identifiant = $request->get('identifiant');
            $commentaires = $request->get('commentaires');
            $dateCreation = date("Y-m-d H:i:s");
            $codeNiveau = $request->get('codeNiveau');
            $codeProprietaire = 777;
            $composante = $request->get('composante');
            $typeActivite = $request->get('typeactivite');

            $sql = "INSERT INTO enseignements(nom, codeMatiere, dureeTotale, dureeSeance, alias, codeTypeSalle, codeZoneSalle, nbSeancesHebdo, 
                dateDebut, dateFin, identifiant, commentaire, dateCreation, codeNiveau, codeProprietaire, codeComposante, codeTypeActivite) VALUES('$nom', '$codeMatiere', 
                '$dureeTotale', '$dureeSeance', '$alias', '$codeTypeSalle', '$codeZoneSalle', '$nbSeancesHebdo', '$dateDebut', '$dateFin', 
                '$identifiant', '$commentaires', '$dateCreation', '$codeNiveau', '$codeProprietaire', '$composante', '$typeActivite')";
            
            $requete = mysql_query($sql, $connection) or die( mysql_error() );
            
            echo "ajouté !!";
            return new RedirectResponse($this->generateUrl('calendar_home_page'));
            
        }
    }
    
}
