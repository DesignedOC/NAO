// Comment parcourir un tableau ?.
/*
function afficherTableau(tab) {
  for (i = 0; i < tab.length; i++) {
    alert(tab[i]);
  }
}

afficherTableau(["Sebastien", "Juliette", "Louis"]);*/

//Declarer les tableaux ouuu?? dans des fonctions ?
// ce code est bon mais quand on fera des tableaux plus complets avec plus de valeurs vaudra mieux les déclarer à part dans
//une var puis passer cette var à afficherTableau() qui la placera dans le parametre tab
//Je vois pas ce que je peux return dans ce code ?

function creerUnObjetLitteral() {
  var objetLitteral = {
    prenom: "Juliette",
    nom: "Lo faro",
    age: 20
  };
  var message = alert(objetLitteral.prenom);
  console.log(objetLitteral);
  //var message = alert(objetLitteral['nom'])
  return message;
}

creerUnObjetLitteral();
