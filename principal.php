<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pokedex</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<audio id="button-press">
  <source src="res/button.m4a" type="audio/mpeg">
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
          <?php
            $file = 'pokemon_names.txt';
            $handle = fopen($file, 'r');
            $toSearchBy = $_GET['searchBy'];
            $pokemonArray = [];

            // Check if the file opened successfully
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    $line = trim($line);
                    if(!empty($toSearchBy)){
                        if(str_starts_with(strtolower(trim($line)), $toSearchBy)){
                            echo "<div class='grid-item'>{$line}</div>";    
                        }                    
                    }
                    else{
                        echo "<div class='grid-item'>{$line}</div>";
                    }
                }
                fclose($handle);
            } else {
                echo "Error: Could not open the file.";
            }
          ?>
            <script>
                const container = document.querySelector(".actualsprite");
                const divs = document.querySelectorAll('.grid-item');
                divs.forEach(div => {
                    div.addEventListener('click', function() {
                        const text = this.textContent.toLowerCase();

                        const encodedText = encodeURIComponent(text);
                        var apiUrl = "https://pokeapi.co/api/v2/pokemon/" + encodedText;
                        window.selectedPokemon = encodedText;
                        async function getPokemonData (){
                            const response = await fetch(apiUrl);
                            if(!response.ok) throw new Error("No response");
                            const data = await response.json();

                            container.innerHTML = "";
                            const img = document.createElement('img');
                            var imgLink = data.sprites.front_default;
                            if(imgLink == null)
                                imgLink = data.sprites.other["official-artwork"].front_default;
                            img.src = imgLink;
                            img.alt = data.name + " front image";
                            container.appendChild(img);
                        }
                        getPokemonData();
                        // //carreguem la pagina amb el pokemon demanat
                        // window.location.href = `principal.php?pokemon=${encodedText}`;
                    });
                });    
                const img = document.createElement('img');
                const firstPokemon = document.querySelector('.grid-item');
                fetch("https://pokeapi.co/api/v2/pokemon/" + firstPokemon.textContent.toLowerCase())
                    .then(response => response.json())
                    .then(data => img.src = data.sprites.front_default)
                    .then(container.appendChild(img))
                    .catch(error => console.error('Error:', error));
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

                function carregaPagina(pagina){
                    window.location.href = pagina;
                }

                var searchButtonDiv = document.getElementById("searchButtonDiv")
                var searchButton =document.getElementById("searchButton");
                searchButtonDiv.addEventListener('click', function() {
                    document.getElementById("button-press").play() ;

                    var inputValue = document.getElementById("pokemonSearcher").value.trim();
                    var newHref = `principal.php?searchBy=${encodeURIComponent(inputValue)}`;
                    
                    const urlParams = new URLSearchParams(window.location.search);
                    
                    const currentPokemon = urlParams.get('searchBy');

                    if(!(!currentPokemon && inputValue==""))
                    {
                        if (inputValue && inputValue !== currentPokemon) {
                            setTimeout(()=>{carregaPagina(newHref)}, 750);
                        } else if (!inputValue) {
                            // If the input is empty, redirect to the main page without parameters
                           setTimeout(()=>{carregaPagina('principal.php')}, 750);
                        }
                        
                    }
                });
                searchButtonDiv.addEventListener('mousedown', function() {
                    searchButton.src = "./res/searchbuttonpressed.png";
                });
                searchButtonDiv.addEventListener('mouseup', function() {
                    searchButton.src = "./res/searchbutton.png";
                });
        </script>
        </div>
        <div class="bottomspacer"></div>
        <input type="text" class="searcher" id="pokemonSearcher" name="pokemonSearcher">
        <script>                
            const searcherInput =document.getElementById("pokemonSearcher");
                
            const urlParams = new URLSearchParams(window.location.search);

            const currentPokemon = urlParams.get('searchBy');
            if(currentPokemon !== ""){
                searcherInput.value =currentPokemon;
            }
        </script>
        <div class="bottomspacer"></div>
        <div class="checkbutton">
            <img src="./res/checkbutton.png">
        </div>
    </div>
  </div>
  <script src="principal.js"></script>
</body>

</html>

