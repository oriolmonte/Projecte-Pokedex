<?php
// Set the output file where Pokémon names will be written
$outputFile = 'pokemon_names.txt';
echo "Current directory: " . getcwd() . "<br>";

// Open the file for writing (or create it if it doesn't exist)
$handle = fopen($outputFile, 'w'); // 'w' mode will overwrite the file

if ($handle) {
    // Loop through the Pokémon IDs from 1 to 1000
    for ($pokemonId = 1; $pokemonId <= 1024; $pokemonId++) {
        // Build the API URL for the current Pokémon
        $apiUrl = "https://pokeapi.co/api/v2/pokemon/{$pokemonId}";
        $curl = curl_init($apiUrl);
        

        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
        $response = curl_exec($curl);
        $httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        if ($response === false) {
            // If the request fails, output an error message
            echo "Failed to retrieve data for Pokémon ID {$pokemonId}\n";
            continue;
        }

        // Decode the JSON response into an associative array
        $pokemonData = json_decode($response, true);

        if (isset($pokemonData['name'])) {
            // Extract the Pokémon's name
            $pokemonName = ucfirst($pokemonData['name']); // Capitalize the name for better formatting

            // Write the Pokémon name to the file, followed by a newline
            fwrite($handle, $pokemonName . PHP_EOL);
            echo "Written: {$pokemonName}\n"; // Output the name to the console (for feedback)
        } else {
            // If no name is found, output an error
            echo "No name found for Pokémon ID {$pokemonId}\n";
        }
    }

    // Close the file after writing
    fclose($handle);
    echo "Finished writing Pokémon names to {$outputFile}\n";
} else {
    // If the file can't be opened, output an error
    echo "Failed to open file for writing.\n";
}
?>