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
            $event = $conn->fetchAll('  SELECT seances.codeSeance, seances.dateSeance, seances.heureSeance, seances.dureeSeance, seances.Commentaire, enseignements.nom 
                                        FROM enseignements, seances
                                        WHERE enseignements.codeEnseignement = seances.codeEnseignement 
                                        ');
            
            // Requêtes pour liste déroulante - formulaire Enseignement
            $sqlmatiere = $conn->fetchAll('SELECT MATIERES.codeMatiere, MATIERES.nom FROM MATIERES ORDER BY MATIERES.nom');
            $sqlzonesalle = $conn->fetchAll('SELECT ZONES_SALLES.codeZoneSalle, ZONES_SALLES.nom FROM ZONES_SALLES ORDER BY ZONES_SALLES.nom');
            $sqlniveau = $conn->fetchAll('SELECT NIVEAUX.codeNiveau, NIVEAUX.nom FROM NIVEAUX ORDER BY NIVEAUX.nom');
            $sqltypesalle = $conn->fetchAll('SELECT TYPES_SALLES.codeTypeSalle, TYPES_SALLES.nom FROM TYPES_SALLES ORDER BY TYPES_SALLES.nom');
            $sqlcomposante = $conn->fetchAll('SELECT COMPOSANTES.codeComposante, COMPOSANTES.nom FROM COMPOSANTES');
            $sqltypeactivite = $conn->fetchAll('SELECT TYPES_ACTIVITES.codeTypeActivite, TYPES_ACTIVITES.nom FROM TYPES_ACTIVITES ORDER BY TYPES_ACTIVITES.nom');
            
            $sqlemail = $conn->executeQuery('SELECT emailProf
            							FROM LOGIN_PROF
            							WHERE codeProf = ?', array($user));
            $hasMail = $sqlemail->fetch();
            if(empty($hasMail['emailProf'])){
            	$nomail = 1;
            }
            else{
            	$nomail = 0;
            }
             
             // Requêtes pour liste déroulante - formulaire Séance
            $sqlenseignement = $conn->fetchAll('SELECT enseignements.codeEnseignement, enseignements.nom FROM enseignements');
            return $this->render('CalendarBundle:Default:index.html.twig', array('user' => $session->get('user'), 'events' => $event, 'lstSqlMatiere' => $sqlmatiere, 'lstSqlZoneSalle' => $sqlzonesalle, 'lstSqlNiveau' => $sqlniveau, 'lstSqlType' => $sqltypesalle, 'lstSqlEnseignement' => $sqlenseignement, 'lstSqlComposante' => $sqlcomposante, 'lstSqlTypeActivite' => $sqltypeactivite, 'msgmail' => $nomail));
            
            
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
    
    
    public function ajoutSeanceAction(Request $request)
    {
        if($request->getMethod() == 'POST'){
            
            $conn = $this->get('database_connection');
            
            $sql = $conn->executeQuery('SELECT * FROM enseignements WHERE codeEnseignement = ?', array($request->get('enseignement')));
            $enseignement = $sql->fetch();
            
            if($enseignement['dureeTotale'] - $enseignement['dureeSeance'] >= 0){
                
                $heureDebut = new \DateTime($request->get('start'));
                $tmpHeureSeance = explode(':', $heureDebut->format('H:i'));
                
                $heureSeance = intval($tmpHeureSeance[0].$tmpHeureSeance[1]);
                $dateSeance = new \DateTime($request->get('dateSeance'));
                $dateCreation = new \DateTime();
                $commentaire = $request->get('commentaire');
                
                $conn->executeQuery('INSERT INTO seances (codeSeance, dateSeance, heureSeance, dureeSeance, codeEnseignement, dateCreation, deleted, codeProprietaire, commentaire, diffusable)
                                     VALUES (0, ?, ?, ?, ?, ?, 0, 777, ?, 0)', array($dateSeance->format('Y-m-d'), $heureSeance, $enseignement['dureeSeance'], $enseignement['codeEnseignement'], $dateCreation->format('Y-m-d H:i:sP'), $commentaire));
                
                $updateDureeTotale = $enseignement['dureeTotale'] - $enseignement['dureeSeance'];
                $conn->executeQuery('UPDATE enseignements SET dureeTotale = ?' , array($updateDureeTotale));
                
                return new RedirectResponse($this->generateUrl('calendar_home_page'));         
                
            }
 
        }
        
        else{
            return new RedirectResponse($this->generateUrl('calendar_home_page'));         
        }
    }
    
}
