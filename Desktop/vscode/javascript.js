function num2Letters(number) {
  if (isNaN(number) || number < 0 || 999 < number) {
    return "Veuillez entrer un nombre entier compris entre 0 et 999.";
  }

  var units2Letters = [
      "",
      "un",
      "deux",
      "trois",
      "quatre",
      "cinq",
      "six",
      "sept",
      "huit",
      "neuf",
      "dix",
      "onze",
      "douze",
      "treize",
      "quatorze",
      "quinze",
      "seize",
      "dix-sept",
      "dix-huit",
      "dix-neuf"
    ],
    tens2Letters = [
      "",
      "dix",
      "vingt",
      "trente",
      "quarante",
      "cinquante",
      "soixante",
      "soixante",
      "quatre-vingt",
      "quatre-vingt"
    ];

  var units = number % 10,
    tens = ((number % 100) - units) / 10,
    hundreds = ((number % 1000) - (number % 100)) / 100;

  var unitsOut, tensOut, hundredsOut;

  if (number === 0) {
    return "zéro";
  } else {
    // Traitement des unités
    /*
      unitsOut =
        (units === 1 && tens > 0 && tens !== 8 ? "et-" : "") +
        units2Letters[units];*/

    console.log(
      "voici la valeur unit",
      units,
      "voici la valeur unitout",
      unitsOut
    );
    if (units === 1 && tens > 0 && tens !== 8) {
      unitsOut = "et-";
    } else {
      unitsOut = "";
    }
    //IMPOTTANT
    console.log("la valeur de unitout AVANT ", unitsOut);
    unitsOut += units2Letters[units];
    console.log("la valeur de unitout", unitsOut);

    // Traitement des dizaines
    console.log("voici les tens avant le if ", tens);
    if (tens === 1 && units > 0) {
      tensOut = units2Letters[10 + units];
      console.log("tens === 1 && units > 0   ->", tensOut);
      unitsOut = "";
    } else if (tens === 7 || tens === 9) {
      tensOut = tens2Letters[tens];
      console.log(
        "on est dans le else if tens === 7 || tens === 9 et on passe tens au tableau  -> ",
        tensOut
      );
      tensOut += "-";
      console.log(
        "ON a passé tens au tableau et donc on rajotue un tiret pck on rajoute systematiquement un tiret vu que units est superieur à 0   -> ",
        tensOut
      );
      tensOut +=
        (tens === 7 && units === 1 ? "et-" : "") + units2Letters[10 + units];
      console.log(
        " on est tj dans le else if et on dit SI tens === 7 && units === 1 alors rajoute et-  ->",
        tensOut
      );
      unitsOut = "";
      console.log(
        "du coup, on est dans les tensouts donc unitsout est égal à ",
        unitsOut
      );
    } else {
      tensOut = tens2Letters[tens];
      console.log("else  ->", tensOut);
    }

    tensOut += units === 0 && tens === 8 ? "s" : "";

    // Traitement des centaines

    hundredsOut =
      (hundreds > 1 ? units2Letters[hundreds] + "-" : "") +
      (hundreds > 0 ? "cent" : "") +
      (hundreds > 1 && tens == 0 && units == 0 ? "s" : "");

    // Retour du total
    console.log("voici la var hundredouts ", hundredsOut);
    console.log("voici la var tenouts ", tensOut);
    console.log("voici la var unitsouts ", unitsOut);

    return (
      hundredsOut +
      (hundredsOut && tensOut ? "-" : "") +
      tensOut +
      ((hundredsOut && unitsOut) || (tensOut && unitsOut) ? "-" : "") +
      unitsOut
    );
  }
}

var userEntry;

while (
  (userEntry = prompt(
    "Indiquez le nombre à écrire en toutes lettres (entre 0 et 999) :"
  ))
) {
  alert(num2Letters(parseInt(userEntry, 10)));
}
