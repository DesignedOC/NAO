alert("hey
function askNumber() {
    var strin, number;
  
    while (true) {
      string = prompt("Entrez un nombre entier positif");
      number = parseInt(string);
  
      if (!isNaN(number)) {
        // C'est bien un nombre
        return number;
      }
    }
  }
  
  alert("Le nombre est : " + askNumber());
  