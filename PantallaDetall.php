<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DetailScreen</title>
    <link rel="stylesheet" href="PantallaDetall.css">
</head>
<body>
    <?php include "pokemon.php"; ?>
    <div>
        <div class="imagesHolder">
            <?php
                getImages();
            ?>
        </div>
        <div class="NameAndTyping">
            <p>
                <?php
                    echo $globalPokemon['name'];
                ?>
            </p>
            <div>Two images</div>
        </div>
        <div class="Habilities"></div>
        <div class="Stats">
            <table>
                <tr>
                    <?php
                        getStats();
                    ?>
                </tr>
            </table>
        </div>
        <div class="SoundButton">

        </div>

    </div>
</body>
</html>