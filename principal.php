
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pokedex</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include "pokemon.php"; ?>

  <div class="screen">
    <div class="titlebar">        
    </div>
    <div class="maincontent">
        <div class="pokemonsprite">
            <div class="actualsprite">
                <?php getSprite() ?>
            </div>
        </div>
        <div class="pokemonlist">
          <?php
            $file = 'pokemon_names.txt';
            $handle = fopen($file, 'r');

            // Check if the file opened successfully
            if ($handle) {
                // Loop through the file line by line
                $i = 0;
                while (($line = fgets($handle)) !== false) {
                    $line = trim($line);
                    $i++;
                    echo '<div class="grid-item">'.$line.'</div>';
                }
                fclose($handle);
            } else {
                echo "Error: Could not open the file.";
            }
          ?>
          <script>
            // Get all div elements with class 'item'
            const divs = document.querySelectorAll('.grid-item');
            ///ORIOL TODO: Aixo es una inline function js que cliques un div i sen va a la pokedex entry, nomes hauria de carregar la imatge. 
            // Aixo es lo que hauria de fer el boto de veure detalls
            divs.forEach(div => {
                div.addEventListener('click', function() {
                    // Get the text content of the clicked div
                    const text = this.textContent.toLowerCase();

                    // Encode the text to safely use it in the URL
                    const encodedText = encodeURIComponent(text);
                    window.location.href = `principal.php?pokemon=${encodedText}`;
                });
            });
        </script>
        </div>
        <div class="pokeball">
            <img src="./res/imgPokeball.png" alt="Spinning Image" class="spinning-image">
        </div>
    </div>
    <div class="bottombar">
        <div class="bottomspacer"></div>
        <div class="searchbutton">
            <img src="./res/searchbutton.png">
        </div>
        <div class="bottomspacer"></div>
        <div class="bottomspacer"></div>
        <div class="bottomspacer"></div>
        <div class="bottomspacer"></div>
        <div class="bottomspacer"></div>
        <div class="checkbutton">
            <img src="./res/checkbutton.png">
        </div>
    </div>
  </div>
  <script src="principal.js"></script>
</body>

</html>

