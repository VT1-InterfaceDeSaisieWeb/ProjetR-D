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
            $event = $conn->fetchAll('SELECT DISTINCT seances.codeSeance, seances.dateSeance, seances.heureSeance, seances.dureeSeance, seances.Commentaire, enseignements.nom 
                                        FROM enseignements, seances, seances_profs, ressources_profs, login_prof 
                                        WHERE enseignements.codeEnseignement = seances.codeEnseignement 
                                        AND seances.codeSeance = seances_profs.codeSeance
                                        AND enseignements.codeEnseignement = seances.codeEnseignement
                                        AND ressources_profs.codeProf = seances_profs.codeRessource
                                        AND login_prof.codeProf = ressources_profs.codeProf
                                        AND login_prof.codeProf = ?
                                        AND seances.deleted = 0', array($user)
                                    );
            
            // Requêtes pour liste déroulante - formulaire Enseignement
            $sqlmatiere = $conn->fetchAll('SELECT MATIERES.codeMatiere, MATIERES.nom FROM MATIERES ORDER BY MATIERES.nom');
            $sqlzonesalle = $conn->fetchAll('SELECT ZONES_SALLES.codeZoneSalle, ZONES_SALLES.nom FROM ZONES_SALLES ORDER BY ZONES_SALLES.nom');
            $sqlniveau = $conn->fetchAll('SELECT NIVEAUX.codeNiveau, NIVEAUX.nom FROM NIVEAUX ORDER BY NIVEAUX.nom');
            $sqltypesalle = $conn->fetchAll('SELECT TYPES_SALLES.codeTypeSalle, TYPES_SALLES.nom FROM TYPES_SALLES ORDER BY TYPES_SALLES.nom');
            $sqlcomposante = $conn->fetchAll('SELECT COMPOSANTES.codeComposante, COMPOSANTES.nom FROM COMPOSANTES');
            $sqltypeactivite = $conn->fetchAll('SELECT TYPES_ACTIVITES.codeTypeActivite, TYPES_ACTIVITES.nom FROM TYPES_ACTIVITES ORDER BY TYPES_ACTIVITES.nom');
            $sqlgroupeenseignement = $conn->fetchAll('SELECT codeGroupe, nom FROM ressources_groupes ORDER BY nom');
            $sqlsalles = $conn->fetchAll('SELECT DISTINCT codeSalle, nom FROM ressources_salles ORDER BY nom');
            $seancesSalles = $conn->fetchAll('SELECT codeSeance, codeRessource FROM seances_salles');
            $seancesGroupes = $conn->fetchAll('SELECT codeSeance, codeRessource FROM seances_groupes');
            $ressourcesProfs = $conn->fetchALL('SELECT codeProf, nom, prenom FROM ressources_profs ORDER BY nom');

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
            
            $displayAll = 0;
             
             // Requêtes pour liste déroulante - formulaire Séance
            $sqlenseignement = $conn->fetchAll('SELECT DISTINCT enseignements.codeEnseignement, enseignements.nom FROM enseignements, enseignements_profs, ressources_profs, login_prof WHERE enseignements.codeEnseignement = enseignements_profs.codeEnseignement AND login_prof.codeProf = ressources_profs.codeProf AND ressources_profs.codeProf = enseignements_profs.codeRessource AND login_prof.codeProf = ? ', array($user));
            return $this->render('CalendarBundle:Default:index.html.twig', array('user' => $session->get('user'), 'events' => $event, 'lstSqlMatiere' => $sqlmatiere, 'lstSqlZoneSalle' => $sqlzonesalle, 'lstSqlNiveau' => $sqlniveau, 'lstSqlType' => $sqltypesalle, 'lstSqlEnseignement' => $sqlenseignement, 'lstSqlComposante' => $sqlcomposante, 'lstSqlTypeActivite' => $sqltypeactivite, 'msgmail' => $nomail, 'lstSqlGroupes' => $sqlgroupeenseignement, 'lstSqlSalles' => $sqlsalles, 'displayAll' => $displayAll, 'seancesSalles' => $seancesSalles, '$seancesGroupes' => $seancesGroupes, 'ressourcesProfs' => $ressourcesProfs));
            
            
        }
        
        else{
            return $this->render('CalendarBundle:Default:login.html.twig');
        }
        
    }
    
     public function filtreAction()
    {
         
          $session = new Session();
        
        if($session->get('user_id') != null){
            
            $user = $session->get('user_id');
            $conn = $this->get('database_connection');
            
            //Requête pour permettre l'affichage des séances pour un prof connecté
            $event = $conn->fetchAll('  SELECT seances.codeSeance, seances.dateSeance, seances.heureSeance, seances.dureeSeance, seances.Commentaire, enseignements.nom 
                                        FROM enseignements, seances
                                        WHERE enseignements.codeEnseignement = seances.codeEnseignement
                                        AND seances.deleted = 0');
            
            
            // Requêtes pour liste déroulante - formulaire Enseignement
            $sqlmatiere = $conn->fetchAll('SELECT MATIERES.codeMatiere, MATIERES.nom FROM MATIERES ORDER BY MATIERES.nom');
            $sqlzonesalle = $conn->fetchAll('SELECT ZONES_SALLES.codeZoneSalle, ZONES_SALLES.nom FROM ZONES_SALLES ORDER BY ZONES_SALLES.nom');
            $sqlniveau = $conn->fetchAll('SELECT NIVEAUX.codeNiveau, NIVEAUX.nom FROM NIVEAUX ORDER BY NIVEAUX.nom');
            $sqltypesalle = $conn->fetchAll('SELECT TYPES_SALLES.codeTypeSalle, TYPES_SALLES.nom FROM TYPES_SALLES ORDER BY TYPES_SALLES.nom');
            $sqlcomposante = $conn->fetchAll('SELECT COMPOSANTES.codeComposante, COMPOSANTES.nom FROM COMPOSANTES');
            $sqltypeactivite = $conn->fetchAll('SELECT TYPES_ACTIVITES.codeTypeActivite, TYPES_ACTIVITES.nom FROM TYPES_ACTIVITES ORDER BY TYPES_ACTIVITES.nom');
            $sqlgroupeenseignement = $conn->fetchAll('SELECT codeGroupe, nom FROM ressources_groupes ORDER BY nom');
            $sqlsalles = $conn->fetchAll('SELECT DISTINCT codeSalle, nom FROM ressources_salles ORDER BY nom');
            $seancesSalles = $conn->fetchAll('SELECT codeSeance, codeRessource FROM seances_salles');
            $seancesGroupes = $conn->fetchAll('SELECT codeSeance, codeRessource FROM seances_groupes');
            $ressourcesProfs = $conn->fetchALL('SELECT codeProf, nom, prenom FROM ressources_profs ORDER BY nom');
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
            
            $displayAll = 1;
            
             // Requêtes pour liste déroulante - formulaire Séance
            $sqlenseignement = $conn->fetchAll('SELECT DISTINCT enseignements.codeEnseignement, enseignements.nom FROM enseignements, enseignements_profs, ressources_profs, login_prof WHERE enseignements.codeEnseignement = enseignements_profs.codeEnseignement AND login_prof.codeProf = ressources_profs.codeProf AND ressources_profs.codeProf = enseignements_profs.codeRessource AND login_prof.codeProf = ? ', array($user));
            return $this->render('CalendarBundle:Default:index.html.twig', array('user' => $session->get('user'), 'events' => $event, 'lstSqlMatiere' => $sqlmatiere, 'lstSqlZoneSalle' => $sqlzonesalle, 'lstSqlNiveau' => $sqlniveau, 'lstSqlType' => $sqltypesalle, 'lstSqlEnseignement' => $sqlenseignement, 'lstSqlComposante' => $sqlcomposante, 'lstSqlTypeActivite' => $sqltypeactivite, 'msgmail' => $nomail, 'lstSqlGroupes' => $sqlgroupeenseignement, 'lstSqlSalles' => $sqlsalles, 'displayAll' => $displayAll, 'seancesSalles' => $seancesSalles, '$seancesGroupes' => $seancesGroupes, 'ressourcesProfs' => $ressourcesProfs));
            
            
        }
        
        else{
            return $this->render('CalendarBundle:Default:login.html.twig');
        }
         
         
    }
    
    
    
    public function ajoutMatiereAction(Request $request)
    {
        if($request->getMethod() == "POST"){
            
            $conn = $this->get('database_connection');
            
            $nomMatiere = $request->get('nom');
            $dateCreation = date("Y-m-d H:i:s");
            $codeProprietaire = 777;
            $conn->executeQuery('INSERT  INTO matieres (nom, dateCreation, codeProprietaire) VALUES ( ?, ?, ?)', array($nomMatiere, $dateCreation, $codeProprietaire));
            
            
            return new RedirectResponse($this->generateUrl('calendar_home_page'));
            
        }
        
        return new RedirectResponse($this->generateUrl('calendar_home_page'));
    }

    public function ajoutEnseignementAction(Request $request)
    {
        if($request->getMethod() == 'POST'){
            
            
            
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
            $prof = $request->get('prof');

            /*$sql = "INSERT INTO enseignements(nom, codeMatiere, dureeTotale, dureeSeance, alias, codeTypeSalle, codeZoneSalle, nbSeancesHebdo, 
                    dateDebut, dateFin, identifiant, commentaire, dateCreation, codeNiveau, codeProprietaire, codeComposante, codeTypeActivite) VALUES('$nom', '$codeMatiere', 
                    '$dureeTotale', '$dureeSeance', '$alias', '$codeTypeSalle', '$codeZoneSalle', '$nbSeancesHebdo', '$dateDebut', '$dateFin', 
                    '$identifiant', '$commentaires', '$dateCreation', '$codeNiveau', '$codeProprietaire', '$composante', '$typeActivite')";
           
            $requete = mysql_query($sql, $connection) or die( mysql_error() );*/
            
            $conn = $this->get('database_connection');
            
            $conn->executeQuery('INSERT INTO enseignements(nom, codeMatiere, dureeTotale, dureeSeance, alias, codeTypeSalle, codeZoneSalle, nbSeancesHebdo, 
                    dateDebut, dateFin, identifiant, commentaire, dateCreation, codeNiveau, codeProprietaire, codeComposante, codeTypeActivite) VALUES(?, ?, 
                    ?, ?, ?, ?, ?, ?, ?, ?, 
                    ?, ?, ?, ?, ?, ?, ?)', array($nom, $codeMatiere, $dureeTotale, $dureeSeance, $alias, $codeTypeSalle, $codeZoneSalle, $nbSeancesHebdo, $dateDebut, $dateFin, $identifiant, $commentaires, $dateCreation, $codeNiveau, $codeProprietaire, $composante, $typeActivite));
            
            $selectLastIdInserted = $conn->executeQuery('SELECT LAST_INSERT_ID() as lastId FROM enseignements');
            $lastIdInserted = $selectLastIdInserted->fetch();
            
            $conn->executeQuery('INSERT INTO enseignements_profs(codeEnseignement, codeRessource, deleted) VALUES (?, ?, 0)', array($lastIdInserted['lastId'], $prof));
            
            
            
            
            
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
                
                if($request->get('groupes') == 0){
                    $groupe = 0;
                }
                else{
                   $groupe = $request->get('groupes'); 
                }
                
                $salle = $request->get('salles');
                
                $selectRessourceProf = $conn->executeQuery('SELECT codeRessource FROM enseignements_profs WHERE codeEnseignement = ? ', array($enseignement['codeEnseignement']));
                $ressourceProf = $selectRessourceProf->fetch();
                
                $selectSeanceExistante = $conn->executeQuery('SELECT * FROM seances WHERE dateSeance = ? AND heureSeance = ?', array($dateSeance->format('Y-m-d'), $heureSeance));
                $seanceExistante = $selectSeanceExistante->fetchAll();
                
                if($seanceExistante){
                    
                    foreach ($seanceExistante as $uneSeanceExistante) {
                        
                        $selectSeancesGroupes = $conn->executeQuery('SELECT * FROM seances_groupes WHERE codeSeance = ?', array($uneSeanceExistante['codeSeance']));
                        $seancesGroupes = $selectSeancesGroupes->fetch();
                        
                        if($seancesGroupes){
                            $errorGroupe = 1;
                            $session = new Session();
                            $user = $session->get('user_id');
            
                            $conn = $this->get('database_connection');
            
                            //Requête pour permettre l'affichage des séances pour un prof connecté
                            $event = $conn->fetchAll('SELECT DISTINCT seances.codeSeance, seances.dateSeance, seances.heureSeance, seances.dureeSeance, seances.Commentaire, enseignements.nom 
                                                        FROM enseignements, seances, seances_profs, ressources_profs, login_prof 
                                                        WHERE enseignements.codeEnseignement = seances.codeEnseignement 
                                                        AND seances.codeSeance = seances_profs.codeSeance
                                                        AND enseignements.codeEnseignement = seances.codeEnseignement
                                                        AND ressources_profs.codeProf = seances_profs.codeRessource
                                                        AND login_prof.codeProf = ressources_profs.codeProf
                                                        AND login_prof.codeProf = ?
                                                        AND seances.deleted = 0', array($user)
                                                    );

                            // Requêtes pour liste déroulante - formulaire Enseignement
                            $sqlmatiere = $conn->fetchAll('SELECT MATIERES.codeMatiere, MATIERES.nom FROM MATIERES ORDER BY MATIERES.nom');
                            $sqlzonesalle = $conn->fetchAll('SELECT ZONES_SALLES.codeZoneSalle, ZONES_SALLES.nom FROM ZONES_SALLES ORDER BY ZONES_SALLES.nom');
                            $sqlniveau = $conn->fetchAll('SELECT NIVEAUX.codeNiveau, NIVEAUX.nom FROM NIVEAUX ORDER BY NIVEAUX.nom');
                            $sqltypesalle = $conn->fetchAll('SELECT TYPES_SALLES.codeTypeSalle, TYPES_SALLES.nom FROM TYPES_SALLES ORDER BY TYPES_SALLES.nom');
                            $sqlcomposante = $conn->fetchAll('SELECT COMPOSANTES.codeComposante, COMPOSANTES.nom FROM COMPOSANTES');
                            $sqltypeactivite = $conn->fetchAll('SELECT TYPES_ACTIVITES.codeTypeActivite, TYPES_ACTIVITES.nom FROM TYPES_ACTIVITES ORDER BY TYPES_ACTIVITES.nom');
                            $sqlgroupeenseignement = $conn->fetchAll('SELECT codeGroupe, nom FROM ressources_groupes ORDER BY nom');
                            $sqlsalles = $conn->fetchAll('SELECT DISTINCT codeSalle, nom FROM ressources_salles ORDER BY nom');
                            $seancesSalles = $conn->fetchAll('SELECT codeSeance, codeRessource FROM seances_salles');
                            $seancesGroupes = $conn->fetchAll('SELECT codeSeance, codeRessource FROM seances_groupes');
                            $ressourcesProfs = $conn->fetchALL('SELECT codeProf, nom, prenom FROM ressources_profs ORDER BY nom');
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

                            $displayAll = 0;

                             // Requêtes pour liste déroulante - formulaire Séance
                            $sqlenseignement = $conn->fetchAll('SELECT DISTINCT enseignements.codeEnseignement, enseignements.nom FROM enseignements, enseignements_profs, ressources_profs, login_prof WHERE enseignements.codeEnseignement = enseignements_profs.codeEnseignement AND login_prof.codeProf = ressources_profs.codeProf AND ressources_profs.codeProf = enseignements_profs.codeRessource AND login_prof.codeProf = ? ', array($user));
                            return $this->render('CalendarBundle:Default:index.html.twig', array('user' => $session->get('user'), 'events' => $event, 'lstSqlMatiere' => $sqlmatiere, 'lstSqlZoneSalle' => $sqlzonesalle, 'lstSqlNiveau' => $sqlniveau, 'lstSqlType' => $sqltypesalle, 'lstSqlEnseignement' => $sqlenseignement, 'lstSqlComposante' => $sqlcomposante, 'lstSqlTypeActivite' => $sqltypeactivite, 'msgmail' => $nomail, 'lstSqlGroupes' => $sqlgroupeenseignement, 'lstSqlSalles' => $sqlsalles, 'displayAll' => $displayAll, 'errorGroupe' => $errorGroupe, 'seancesSalles' => $seancesSalles, '$seancesGroupes' => $seancesGroupes, 'ressourcesProfs' => $ressourcesProfs));
                              
                        }
                        
                        else{
                            
                            $selectSeancesSalles = $conn->executeQuery('SELECT * FROM seances_salles WHERE codeSeance = ?', array($uneSeanceExistante['codeSeance']));
                            $seancesSalles = $selectSeancesSalles->fetch();
                            
                                    if($seancesSalles){
                                        $errorSalle = 1;
                                        $session = new Session();
                                        $user = $session->get('user_id');

                                        $conn = $this->get('database_connection');

                                        //Requête pour permettre l'affichage des séances pour un prof connecté
                                        $event = $conn->fetchAll('SELECT DISTINCT seances.codeSeance, seances.dateSeance, seances.heureSeance, seances.dureeSeance, seances.Commentaire, enseignements.nom 
                                                                    FROM enseignements, seances, seances_profs, ressources_profs, login_prof 
                                                                    WHERE enseignements.codeEnseignement = seances.codeEnseignement 
                                                                    AND seances.codeSeance = seances_profs.codeSeance
                                                                    AND enseignements.codeEnseignement = seances.codeEnseignement
                                                                    AND ressources_profs.codeProf = seances_profs.codeRessource
                                                                    AND login_prof.codeProf = ressources_profs.codeProf
                                                                    AND login_prof.codeProf = ?
                                                                    AND seances.deleted = 0', array($user)
                                                                );

                                        // Requêtes pour liste déroulante - formulaire Enseignement
                                        $sqlmatiere = $conn->fetchAll('SELECT MATIERES.codeMatiere, MATIERES.nom FROM MATIERES ORDER BY MATIERES.nom');
                                        $sqlzonesalle = $conn->fetchAll('SELECT ZONES_SALLES.codeZoneSalle, ZONES_SALLES.nom FROM ZONES_SALLES ORDER BY ZONES_SALLES.nom');
                                        $sqlniveau = $conn->fetchAll('SELECT NIVEAUX.codeNiveau, NIVEAUX.nom FROM NIVEAUX ORDER BY NIVEAUX.nom');
                                        $sqltypesalle = $conn->fetchAll('SELECT TYPES_SALLES.codeTypeSalle, TYPES_SALLES.nom FROM TYPES_SALLES ORDER BY TYPES_SALLES.nom');
                                        $sqlcomposante = $conn->fetchAll('SELECT COMPOSANTES.codeComposante, COMPOSANTES.nom FROM COMPOSANTES');
                                        $sqltypeactivite = $conn->fetchAll('SELECT TYPES_ACTIVITES.codeTypeActivite, TYPES_ACTIVITES.nom FROM TYPES_ACTIVITES ORDER BY TYPES_ACTIVITES.nom');
                                        $sqlgroupeenseignement = $conn->fetchAll('SELECT codeGroupe, nom FROM ressources_groupes ORDER BY nom');
                                        $sqlsalles = $conn->fetchAll('SELECT DISTINCT codeSalle, nom FROM ressources_salles ORDER BY nom');
                                        $seancesSalles = $conn->fetchAll('SELECT codeSeance, codeRessource FROM seances_salles');
                                        $seancesGroupes = $conn->fetchAll('SELECT codeSeance, codeRessource FROM seances_groupes'); 
                                        $ressourcesProfs = $conn->fetchALL('SELECT codeProf, nom, prenom FROM ressources_profs ORDER BY nom');
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

                                        $displayAll = 0;

                                         // Requêtes pour liste déroulante - formulaire Séance
                                        $sqlenseignement = $conn->fetchAll('SELECT DISTINCT enseignements.codeEnseignement, enseignements.nom FROM enseignements, enseignements_profs, ressources_profs, login_prof WHERE enseignements.codeEnseignement = enseignements_profs.codeEnseignement AND login_prof.codeProf = ressources_profs.codeProf AND ressources_profs.codeProf = enseignements_profs.codeRessource AND login_prof.codeProf = ? ', array($user));
                                        return $this->render('CalendarBundle:Default:index.html.twig', array('user' => $session->get('user'), 'events' => $event, 'lstSqlMatiere' => $sqlmatiere, 'lstSqlZoneSalle' => $sqlzonesalle, 'lstSqlNiveau' => $sqlniveau, 'lstSqlType' => $sqltypesalle, 'lstSqlEnseignement' => $sqlenseignement, 'lstSqlComposante' => $sqlcomposante, 'lstSqlTypeActivite' => $sqltypeactivite, 'msgmail' => $nomail, 'lstSqlGroupes' => $sqlgroupeenseignement, 'lstSqlSalles' => $sqlsalles, 'displayAll' => $displayAll, 'errorSalle' => $errorSalle, 'seancesSalles' => $seancesSalles, '$seancesGroupes' => $seancesGroupes));

                                    }
                            
                                    else{

                                        $conn->executeQuery('INSERT INTO seances (codeSeance, dateSeance, heureSeance, dureeSeance, codeEnseignement, dateCreation, deleted, codeProprietaire, commentaire, diffusable)
                                                 VALUES (0, ?, ?, ?, ?, ?, 0, 777, ?, 0)', array($dateSeance->format('Y-m-d'), $heureSeance, $enseignement['dureeSeance'], $enseignement['codeEnseignement'], $dateCreation->format('Y-m-d H:i:sP'), $commentaire));

                                        $selectLastIdInserted = $conn->executeQuery('SELECT LAST_INSERT_ID() as lastId FROM seances');
                                        $lastIdInserted = $selectLastIdInserted->fetch();

                                        $selectLastSeanceInserted = $conn->executeQuery('SELECT * FROM seances WHERE codeSeance = ?', array($lastIdInserted['lastId']));
                                        $selectLastSeance = $selectLastSeanceInserted->fetch();

                                        //seance profs

                                        $conn->executeQuery('INSERT INTO seances_profs (codeSeance, codeRessource, dateModif, deleted, codeProprietaire)
                                                             VALUES (?, ?, ?, 0, 777)', array($lastIdInserted['lastId'], $ressourceProf['codeRessource'], $dateCreation->format('Y-m-d H:i:sP')));

                                        //seance salles

                                        $conn->executeQuery('INSERT INTO seances_salles (codeSeance, codeRessource, dateModif, deleted, codeProprietaire)
                                                             VALUES (?, ?, ?, 0, 777)', array($lastIdInserted['lastId'], $salle, $dateCreation->format('Y-m-d H:i:sP')));

                                        //seance groupes

                                        if($groupe != 0){
                                        $conn->executeQuery('INSERT INTO seances_groupes (codeSeance, codeRessource, dateModif, deleted, codeProprietaire)
                                                             VALUES (?, ?, ?, 0, 777)', array($lastIdInserted['lastId'], $groupe, $dateCreation->format('Y-m-d H:i:sP')));
                                        }

                                        $updateDureeTotale = $enseignement['dureeTotale'] - $enseignement['dureeSeance'];
                                        $conn->executeQuery('UPDATE enseignements SET dureeTotale = ? WHERE codeEnseignement = ?' , array($updateDureeTotale, $enseignement['codeEnseignement']));

                                        return new RedirectResponse($this->generateUrl('calendar_home_page'));

                                    }
                            
                        }
                        
                        
                    }
    
                }
                
                
                
                    
                else{
                
                    $conn->executeQuery('INSERT INTO seances (codeSeance, dateSeance, heureSeance, dureeSeance, codeEnseignement, dateCreation, deleted, codeProprietaire, commentaire, diffusable)
                                         VALUES (0, ?, ?, ?, ?, ?, 0, 777, ?, 0)', array($dateSeance->format('Y-m-d'), $heureSeance, $enseignement['dureeSeance'], $enseignement['codeEnseignement'], $dateCreation->format('Y-m-d H:i:sP'), $commentaire));

                    $selectLastIdInserted = $conn->executeQuery('SELECT LAST_INSERT_ID() as lastId FROM seances');
                    $lastIdInserted = $selectLastIdInserted->fetch();

                    $selectLastSeanceInserted = $conn->executeQuery('SELECT * FROM seances WHERE codeSeance = ?', array($lastIdInserted['lastId']));
                    $selectLastSeance = $selectLastSeanceInserted->fetch();

                    //seance profs

                    $conn->executeQuery('INSERT INTO seances_profs (codeSeance, codeRessource, dateModif, deleted, codeProprietaire)
                                         VALUES (?, ?, ?, 0, 777)', array($lastIdInserted['lastId'], $ressourceProf['codeRessource'], $dateCreation->format('Y-m-d H:i:sP')));

                    //seance salles

                    $conn->executeQuery('INSERT INTO seances_salles (codeSeance, codeRessource, dateModif, deleted, codeProprietaire)
                                         VALUES (?, ?, ?, 0, 777)', array($lastIdInserted['lastId'], $salle, $dateCreation->format('Y-m-d H:i:sP')));

                    //seance groupes

                    if($groupe != 0){
                    $conn->executeQuery('INSERT INTO seances_groupes (codeSeance, codeRessource, dateModif, deleted, codeProprietaire)
                                         VALUES (?, ?, ?, 0, 777)', array($lastIdInserted['lastId'], $groupe, $dateCreation->format('Y-m-d H:i:sP')));
                    }

                    $updateDureeTotale = $enseignement['dureeTotale'] - $enseignement['dureeSeance'];
                    $conn->executeQuery('UPDATE enseignements SET dureeTotale = ? WHERE codeEnseignement = ?' , array($updateDureeTotale, $enseignement['codeEnseignement']));

                    return new RedirectResponse($this->generateUrl('calendar_home_page'));         
                } 
            }
            
            else{
                                        
                                        $errorEnseignement = 1;
                                        $session = new Session();
                                        $user = $session->get('user_id');

                                        $conn = $this->get('database_connection');

                                        //Requête pour permettre l'affichage des séances pour un prof connecté
                                        $event = $conn->fetchAll('SELECT DISTINCT seances.codeSeance, seances.dateSeance, seances.heureSeance, seances.dureeSeance, seances.Commentaire, enseignements.nom 
                                                                    FROM enseignements, seances, seances_profs, ressources_profs, login_prof 
                                                                    WHERE enseignements.codeEnseignement = seances.codeEnseignement 
                                                                    AND seances.codeSeance = seances_profs.codeSeance
                                                                    AND enseignements.codeEnseignement = seances.codeEnseignement
                                                                    AND ressources_profs.codeProf = seances_profs.codeRessource
                                                                    AND login_prof.codeProf = ressources_profs.codeProf
                                                                    AND login_prof.codeProf = ?
                                                                    AND seances.deleted = 0', array($user)
                                                                );

                                        // Requêtes pour liste déroulante - formulaire Enseignement
                                        $sqlmatiere = $conn->fetchAll('SELECT MATIERES.codeMatiere, MATIERES.nom FROM MATIERES ORDER BY MATIERES.nom');
                                        $sqlzonesalle = $conn->fetchAll('SELECT ZONES_SALLES.codeZoneSalle, ZONES_SALLES.nom FROM ZONES_SALLES ORDER BY ZONES_SALLES.nom');
                                        $sqlniveau = $conn->fetchAll('SELECT NIVEAUX.codeNiveau, NIVEAUX.nom FROM NIVEAUX ORDER BY NIVEAUX.nom');
                                        $sqltypesalle = $conn->fetchAll('SELECT TYPES_SALLES.codeTypeSalle, TYPES_SALLES.nom FROM TYPES_SALLES ORDER BY TYPES_SALLES.nom');
                                        $sqlcomposante = $conn->fetchAll('SELECT COMPOSANTES.codeComposante, COMPOSANTES.nom FROM COMPOSANTES');
                                        $sqltypeactivite = $conn->fetchAll('SELECT TYPES_ACTIVITES.codeTypeActivite, TYPES_ACTIVITES.nom FROM TYPES_ACTIVITES ORDER BY TYPES_ACTIVITES.nom');
                                        $sqlgroupeenseignement = $conn->fetchAll('SELECT codeGroupe, nom FROM ressources_groupes ORDER BY nom');
                                        $sqlsalles = $conn->fetchAll('SELECT DISTINCT codeSalle, nom FROM ressources_salles ORDER BY nom');
                                        $seancesSalles = $conn->fetchAll('SELECT codeSeance, codeRessource FROM seances_salles');
                                        $seancesGroupes = $conn->fetchAll('SELECT codeSeance, codeRessource FROM seances_groupes'); 
                                        $ressourcesProfs = $conn->fetchALL('SELECT codeProf, nom, prenom FROM ressources_profs ORDER BY nom');
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

                                        $displayAll = 0;

                                         // Requêtes pour liste déroulante - formulaire Séance
                                        $sqlenseignement = $conn->fetchAll('SELECT DISTINCT enseignements.codeEnseignement, enseignements.nom FROM enseignements, enseignements_profs, ressources_profs, login_prof WHERE enseignements.codeEnseignement = enseignements_profs.codeEnseignement AND login_prof.codeProf = ressources_profs.codeProf AND ressources_profs.codeProf = enseignements_profs.codeRessource AND login_prof.codeProf = ? ', array($user));
                                        return $this->render('CalendarBundle:Default:index.html.twig', array('user' => $session->get('user'), 'events' => $event, 'lstSqlMatiere' => $sqlmatiere, 'lstSqlZoneSalle' => $sqlzonesalle, 'lstSqlNiveau' => $sqlniveau, 'lstSqlType' => $sqltypesalle, 'lstSqlEnseignement' => $sqlenseignement, 'lstSqlComposante' => $sqlcomposante, 'lstSqlTypeActivite' => $sqltypeactivite, 'msgmail' => $nomail, 'lstSqlGroupes' => $sqlgroupeenseignement, 'lstSqlSalles' => $sqlsalles, 'displayAll' => $displayAll, 'errorEnseignement' => $errorEnseignement, 'seancesSalles' => $seancesSalles, '$seancesGroupes' => $seancesGroupes, 'ressourcesProfs' => $ressourcesProfs));
            }
 
        }
        
        else{
            return new RedirectResponse($this->generateUrl('calendar_home_page'));         
        }
    }
    
    public function supprimerSeanceAction(Request $request)
    {
        if($request->getMethod() == 'POST'){
            
            $conn = $this->get('database_connection');
            
            $selectSeance = $conn->executeQuery('SELECT codeEnseignement, dureeSeance FROM seances WHERE codeSeance = ?', array($request->get('codeSeance')));
            $seance = $selectSeance->fetch();
            
            $selectDureeTotaleEnseignement = $conn->executeQuery('SELECT dureeTotale FROM enseignements WHERE codeEnseignement = ?', array($seance['codeEnseignement']));
            $dureeTotaleEnseignement = $selectDureeTotaleEnseignement->fetch();
            
            $updateDureeTotale = $dureeTotaleEnseignement['dureeTotale'] + $seance['dureeSeance'];
            
            
            $conn->executeQuery('UPDATE seances SET deleted = 1 WHERE codeSeance = ?', array($request->get('codeSeance')));
            $conn->executeQuery('UPDATE seances_profs SET deleted = 1 WHERE codeSeance = ?', array($request->get('codeSeance')));
            $conn->executeQuery('UPDATE seances_salles SET deleted = 1 WHERE codeSeance = ?', array($request->get('codeSeance')));
            
            $conn->executeQuery('UPDATE enseignements SET dureeTotale = ? WHERE codeEnseignement = ?', array($updateDureeTotale, $seance['codeEnseignement']));
            
            return new RedirectResponse($this->generateUrl('calendar_home_page'));         
        }
        else{
            return new RedirectResponse($this->generateUrl('calendar_home_page'));         
        }
    }
    
}
