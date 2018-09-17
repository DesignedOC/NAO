// un bouton
// quand on clique dessus on a 4 divs qui s'affichent

//donner les valeurs au variable
var juliette = "Juliette a 20 ans";
var papa = "Papa a 58 ans";
var maman = "Maman a 56 ans";
var louis = "Louis a 24 ans";
//on place toutes les var dans prenoms
var prenoms = "";
prenoms += maman + ", " + louis + ", " + papa + ", " + juliette;

// on affiche les vars en les placant dans des divs + afficher leur valeur ds console log

//on creer le bouton directement en JS
var button = document.createElement("button");
button.innerHTML = "Cliquez ici";
var putDivIn = document.getElementById("divBouton");
putDivIn.appendChild(button);

//quand on click sur bouton, on affiche les divs ! ici fonction anonyme v
button.addEventListener("click", function() {
  document.getElementById("divOne").innerHTML = "Juliette";
  document.getElementById("divTwo").innerHTML = "Papa";
  document.getElementById("divThree").innerHTML = "Maman";
  document.getElementById("divFour").innerHTML = "Louis";
  console.log(prenoms);
});

// for
