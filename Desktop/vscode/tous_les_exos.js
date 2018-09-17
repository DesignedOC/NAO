// On demande à l'utilisateur d'écrire un nombre. et on lui dire si c'est pair ou impair.
// On lui demande ça 15 fois.

for (var i = 0, number; i < 15; i++) {
  number = parseInt(prompt("ecrire un nombre :"));
  if (number % 2 === 0) {
    console.log(number + " is even");
  } else {
    console.log(number + " is odd");
  }
}
/*___________________________________________________________________________________________________________*/

var numberA = 42;
var numberB = 1337;

var biggest = whoIsTheBiggest(numberA, numberB);

function whoIsTheBiggest(a, b) {
  if (b > a) {
    return b;
  } else {
    return a;
  }
}

/*___________________________________________________________________________________________________________*/

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

/*___________________________________________________________________________________________________________*/

// Qd j'appelle maFonction je passe directement la valeur. On a age en parametre, et ici on lui donne sa valeur.
// Pas besoin de créer une valeur age hors de la fonction puis d'appeler ensuite maFonction(age). Comme ça c'est bon :
function maFonction(age) {
  alert("Votre âge est : " + age);
}

maFonction(parseInt(prompt("Quel est votre age ? ")));

/*___________________________________________________________________________________________________________*/

// La var proceed sert uniquement à faire répéter la boucle, donc on répète le prompt. On dit que si qqch est écrit
// dans ce prompt, alors on place dans la var nicks , et sinon oon arrête la boucle en méttant proceed à false.
// En arretant la boucle on va Empêcher le prompt de se réafficher
// On se sert de proceed car ici on a pas d'autres condition pour répéter la boucle
// Je me demandais pk pas un confirm(prompt()) -> pck confirm va pas dans une boucle, en cliquant sur OK ça arrête l'execution
// on a prenomS qui va incrémenter tous les prenom, mais faut l'initialiser avec "" pr dire que c'est un string, sinon on a un undefined

var varTrue = true,
  prenom,
  prenoms = "";

while (varTrue) {
  prenom = prompt("entrez votre prénom et ceux de vos frères et soeurs : ");

  if (prenom) {
    prenoms += prenom + " ";
  } else {
    varTrue = false;
    alert("Tous les prénoms sont : " + prenoms);
  }
}

/*___________________________________________________________________________________________________________*/
var question = confirm("Avez vous un chien ?");
var finReponse;

if (question) {
  finReponse = "oui";
} else {
  finReponse = "non";
}
/*___________________________________________________________________________________________________________*/
alert("Votre réponse est " + finReponse);
var nom = "azaz";

// Une var a une valeur qui est un obadministration@panda-events.comet qui a des propriétés, des méthodes et un construct

var nombre1 = 4;
var nombre2 = 5;
var nombre3 = "5";
var nombre4 = "5";

// Pourquoi ça retourne true quand dans la console je tappe juste le nom de la var ?
// Parce qu'en JS tout est objet donc ça te retourne le type d'objet que c'est

var result = nombre2 !== nombre3;

if (confirm("kk")) {
  alert("fk");
} else {
  alert("deso");
}
