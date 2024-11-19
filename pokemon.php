<?php


function getPokemonData($pokemonNameOrId) {
    $apiUrl = "https://pokeapi.co/api/v2/pokemon/" . $pokemonNameOrId;
    $curl = curl_init($apiUrl);

    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($curl);
    $httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($response === false) {
        // If the request fails, get the error message
        $error = curl_error($curl);
        curl_close($curl);
        return [
            'error' => "Failed to connect to PokéAPI. Error: " . $error
        ];
    }

    // Check for a 404 Not Found (when the Pokémon doesn't exist)
    if ($httpStatusCode == 404) {
        return [
            'error' => "Pokémon not found. Please check the name or ID."
        ];
    }

    // Check for other HTTP errors
    if ($httpStatusCode >= 400) {
        return [
            'error' => "API returned an error. HTTP Status Code: " . $httpStatusCode
        ];
    }

    // If successful, decode the JSON
    $pokemonData = json_decode($response, true);

    if ($pokemonData === null) {
        return [
            'error' => "Failed to decode API response."
        ];
    }

    curl_close($curl);
    return $pokemonData;
}

$pokemonNameOrId = $_GET['pokemon'];
$globalPokemon = getPokemonData(pokemonNameOrId: $pokemonNameOrId);

function getImages(){
    global $globalPokemon;
    if (isset($globalPokemon['sprites'])) {
        $normalSprite = $globalPokemon['sprites']['other']['home']['front_default'];
        $shinySprite = $globalPokemon['sprites']['other']['home']['front_shiny'];
        if(!isset($normalSprite) || !isset($shinySprite)){
            $normalSprite = $globalPokemon['sprites']['other']['official-artwork']['front_default'];
            $shinySprite = $globalPokemon['sprites']['other']['official-artwork']['front_shiny'];
        }

        echo '<div class="photo-border">
                <div class="photo">
                    <img src='.$normalSprite.' alt="Normal Sprite" width="250" height="250"/>
                </div>
            </div>
            <div class="photo-border">
                <div class="photo">
                    <img src='.$shinySprite.' alt="Shiny Sprite" width="250" height="250"/>
                </div>
            </div>';
    } else {
        echo "<p>No images available.</p>";
    }
}
function getSprite(): void{
    global $globalPokemon;
    if (isset($globalPokemon['sprites'])) {
        $normalSprite = $globalPokemon['sprites']['other']['showdown']['front_default'];
        // Echo out the image elements
        echo "<img src='$normalSprite' alt='Normal Sprite' />";
    } else {
    }
}

function getStats(){
    global $globalPokemon;
    $stats = $globalPokemon['stats'];
    echo '
                <table class="statstable">
                    <tr>
                        <th colspan="2">Stats</th>
                    </tr>
                    <tr>
                        <td class="statname">HP</td>
                        <td class="statbar" id="hpBar"></td>
                        <td class="statValue" id="hpValue">'.$stats[0]['base_stat'].'</td>

                    </tr>
                    <tr>
                        <td class="statname">ATK</td>
                        <td class="statbar" id="atkBar"></td>
                        <td class="statValue" id="atkValue">'.$stats[1]['base_stat'].'</td>

                    </tr>
                    <tr>
                        <td class="statname">DEF</td>
                        <td class="statbar" id="defBar"></td>
                        <td class="statValue" id="defValue">'.$stats[2]['base_stat'].'</td>
                    </tr>
                    <tr>
                        <td class="statname">SP.ATK</td>
                        <td class="statbar" id="spatkBar"></td>
                        <td class="statValue" id="spatkValue">'.$stats[3]['base_stat'].'</td>
                    </tr>
                    <tr>
                        <td class="statname">SP.DEF</td>
                        <td class="statbar" id="spdefBar"></td>
                        <td class="statValue" id="spdefValue">'.$stats[4]['base_stat'].'</td>

                    </tr>
                    <tr>
                        <td class="statname">SPD</td>
                        <td class="statbar" id="spdBar"></td>
                        <td class="statValue" id="spdValue">'.$stats[5]['base_stat'].'</td>
                    </tr>                    
                </table>';
}

function getTypes(){
    global $globalPokemon;
    $types = $globalPokemon["types"];
    foreach ($types as $type) {
        switch ($type["type"]["name"]) {
            case "bug" : echo '<img class="typeImage" src="res/Types/typingBug.png"></img>'; break;
            case "dark" : echo '<img class="typeImage" src="res/Types/typingDark.png"></img>'; break;
            case "dragon" : echo '<img class="typeImage" src="res/Types/typingDragon.png"></img>'; break;
            case "electric" : echo '<img class="typeImage" src="res/Types/typingElectric.png"></img>'; break;
            case "fairy" : echo '<img class="typeImage" src="res/Types/typingFairy.png"></img>'; break;
            case "fighting" : echo '<img class="typeImage" src="res/Types/typingFighting.png"></img>'; break;
            case "fire" : echo '<img class="typeImage" src="res/Types/typingFire.png"></img>'; break;
            case "flying" : echo '<img class="typeImage" src="res/Types/typingFlying.png"></img>'; break;
            case "ghost" : echo '<img class="typeImage" src="res/Types/typingGhost.png"></img>'; break;
            case "grass" : echo '<img class="typeImage" src="res/Types/typingGrass.png"></img>'; break;
            case "ground" : echo '<img class="typeImage" src="res/Types/typingGround.png"></img>'; break;
            case "ice" : echo '<img class="typeImage" src="res/Types/typingIce.png"></img>'; break;
            case "normal" : echo '<img class="typeImage" src="res/Types/typingNormal.png"></img>'; break;
            case "poison" : echo '<img class="typeImage" src="res/Types/typingPoison.png"></img>'; break;
            case "psychic" : echo '<img class="typeImage" src="res/Types/typingPsychic.png"></img>'; break;
            case "rock" : echo '<img class="typeImage" src="res/Types/typingRock.png"></img>'; break;
            case "steel" : echo '<img class="typeImage" src="res/Types/typingSteel.png"></img>'; break;
            case "water" : echo '<img class="typeImage" src="res/Types/typingWater.png"></img>'; break;

        }
    }
}

function getMeasurements(){
    global $globalPokemon;
    echo '<div styles="Padding=10px">Height: ' . $globalPokemon['height'] / 10 . ' m</div>';
    echo '<div>Weight: '.$globalPokemon['weight'] / 10 .' kg</div>';
}

function getAbilities(){
    global $globalPokemon;
    echo '<table><tr>';
    $abilities = $globalPokemon['abilities'];
    foreach($abilities as $ability){
        echo '<td class="abilityname">'. ucfirst($ability['ability']['name']).'</td>';
    }
    echo '</tr><tr>';
    foreach($abilities as $ability){
        $apiUrl = $ability['ability']['url'];

        $curl = curl_init($apiUrl);
    
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
        $response = curl_exec($curl);
        $abilityData = json_decode($response, true);

        foreach($abilityData['flavor_text_entries'] as $data){
            if($data['language']['name'] == 'en'){
                echo '<td class="abilitytext">'.$data['flavor_text'].'</td>';
                break;        
            }
        }
    }
    echo '</tr></table>';
}
