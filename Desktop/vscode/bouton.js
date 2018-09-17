//faire le prompt
var prenoms = "";

while (true) {
  var prenom = prompt("Entrez les prénoms ici :");
  if (prenom) {
    prenoms += prenom + " ";
  } else {
    break;
  }
}

//ensuite faire un bouton qui dit quand on clique dessus ça affiche toutes les données de prenoms en liste
function myFunction() {
  document.getElementById("divOne").innerHTML = prenoms + ", ";
}
