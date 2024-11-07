<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getPokemonData($pokemonNameOrId) {
    $apiUrl = "https://pokeapi.co/api/v2/pokemon/" . $pokemonNameOrId;
    $maxRetries = 3; // Number of times to retry in case of 500 errors
    $retryDelay = 2; // Delay in seconds between retries
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
$globalPokemon = getPokemonData($pokemonNameOrId);

function getImages(){
    global $globalPokemon;
    if (isset($globalPokemon['sprites'])) {
        $normalSprite = $globalPokemon['sprites']['other']['official-artwork']['front_default'];
        $shinySprite = $globalPokemon['sprites']['other']['official-artwork']['front_shiny'];

        // Echo out the image elements
        echo "<img src='$normalSprite' alt='Normal Sprite' />";
        echo "<img src='$shinySprite' alt='Shiny Sprite' />";
    } else {
        echo "<p>No images available.</p>";
    }
}

function getStats(){
    global $globalPokemon;
    $stats = $globalPokemon['stats'];
    foreach ($stats as $stat) {
        $statName = ucfirst(str_replace('-', ' ', $stat['stat']['name']));
        $baseStat = $stat['base_stat'];
        echo "<tr><td>$statName</td>";
        echo "<td>$baseStat</td></tr>";
    }
}