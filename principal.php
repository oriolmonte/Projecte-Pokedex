<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fixed Size Page</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="screen">
    <div class="titlebar">        
    </div>
    <div class="maincontent">
        <div class="pokemonsprite">
            <p>aaa</p>
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
        </div>
        <div class="pokeball">
            <img src="./res/pokeball.png" alt="Spinning Image" class="spinning-image">
        </div>
    </div>
    <div class="bottombar">
        <p>aaa</p>
    </div>
  </div>
  <script src="principal.js"></script>
</body>

</html>
