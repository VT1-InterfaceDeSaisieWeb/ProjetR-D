/**
 * 
 */

function surligne(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";
   else
      champ.style.backgroundColor = "";
}

function verifTexteField(champ)
{
   if(champ.value.length == 0)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function verifForm(f)
{
   var bres = true;
   f.lstm.style.backgroundColor = "";
   f.lstcodetypesalle.style.backgroundColor = "";
   f.lstcodezonesalle.style.backgroundColor = "";
   f.lstcodeniveau.style.backgroundColor = "";
   
   if(f.lstm.value == "-1"){
	   bres = false;
	   f.lstm.style.backgroundColor = "#fba";
   }
	   
   
   if(f.lstcodetypesalle.value == "-1"){
	   bres = false;
	   f.lstcodetypesalle.style.backgroundColor = "#fba";
   }
   
   if(f.lstcodezonesalle.value == "-1"){
	   bres = false;
	   f.lstcodezonesalle.style.backgroundColor = "#fba";
   }
   
   if(f.lstcodeniveau.value == "-1"){
	   bres = false;
	   f.lstcodeniveau.style.backgroundColor = "#fba";
   }
   
   if(f.lstcomposante.value == "-1"){
	   bres = false;
	   f.lstcomposante.style.backgroundColor = "#fba";
   }
   
   if(f.lsttypeactivite.value == "-1"){
	   bres = false;
	   f.lsttypeactivite.style.backgroundColor = "#fba";
   }
   
   if(!bres){
	   alert("Veuillez remplir correctement les champs surlignés.");
	   return false;
   }
   return true;

}


function verifFormCompte(f)
{
   var bres = true;
   f.newemail.style.backgroundColor = "";
   
   if(f.newemail.value.length == 0){
	   bres = false;
	   f.newemail.style.backgroundColor = "#fba";
   }
   
   if(!bres){
	   alert("Veuillez renseigner la nouvelle adresse email.");
	   return false;
   }
   return true;

}