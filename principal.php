<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pokedex</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<script src="extraPrincipalFunctions.js"></script>
<audio id="button-press">
  <source src="res/button.wav" type="audio/mpeg">
</audio>
<?php include "pokemon.php"; ?>
  <div class="screen">
    <div class="titlebar">        
    </div>
    <div class="maincontent">
        <div class="pokemonsprite">
            <div class="actualsprite">
            </div>
        </div>
        <div class="pokemonlist">
          <?php include "extraPrincipalFunctions.php";
              LoadPokemonNames();
          ?>
          <script>
                SetDivsClick();
                LoadFirstPokemonSprite();
          </script>
        </div>
        <div class="pokeball">
            <img src="./res/imgPokeball.png" alt="Spinning Image" class="spinning-image">
        </div>
    </div>
    <div class="bottombar">
        <div class="bottomspacer"></div>
        <div class="searchbutton" id="searchButtonDiv">
            <img src="./res/searchbutton.png" id="searchButton">
            <script>
                SetSearcherClick();
            </script>
        </div>
        <div class="bottomspacer"></div>
        <input type="text" class="searcher" id="pokemonSearcher" name="pokemonSearcher">
        <script>                
            SetCurrentSearchValue();
        </script>
        <div class="bottomspacer"></div>
        <div class="checkbutton" id="informationButton">
            <img src="./res/checkbutton.png">
            <script>           
               PlayClickSound();

              SetCheckPokemonClick();
            </script>
        </div>
    </div>
  </div>
  <script src="principal.js"></script>
</body>

</html>

