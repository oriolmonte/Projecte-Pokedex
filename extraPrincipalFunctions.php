<?php
function LoadPokemonNames(){
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
}
