<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
    <link rel="stylesheet" href="stylesdetall.css">
</head>
<div class="screen">
    <?php include "pokemon.php"; ?>
    <script src="extraDetallFunctions.js"></script>

    <div class = "primerafila">
        <!-- #region fotos-->
        <div class="photo-container">
        <?php getImages(); ?>
        </div>  
        <!-- #endregion -->
        <!-- #region panell superior-->
        <div class = "topbarpanel">
            <div class="topbarspacer">
            </div>
            <div class="topbarbuttoncontainer">
                <div class="buttonback" id="backButton">    
                </div>    
                <div class="buttonserebii" id="serebiiButton">    

                    <!--enllaç a serebii /nompokemon-->
                </div>    
                <script>setButtonClicks();</script>
            </div>
            <div class="topbarspacer">
            </div>
        </div>
        <!-- #endregion -->
    </div>
    
    <div class="segonafila">
        <div class="columna1">
        <!-- #region name -->
            <div class="nompokemon">
                <?php 
                    global $globalPokemon;
                    echo ucfirst($globalPokemon["name"]);
                ?>
            </div>
        <!--#endregion-->
        <!-- #region dades pokemon-->
            <div class="dadespokemon">
                <div class="pokemontagline">                    
                </div>
                <div class="dadespokemoncontainer">
                    <div class="types">
                        <?php 
                            getTypes();
                        ?>
                    </div>
                    <div class="measurements">
                        <?php 
                            getMeasurements();
                        ?>
                    </div>
                    <div class="evolutions"></div>
                </div>
                <div class="abilitiessection">
                    <?php 
                        getAbilities(); 
                    ?>
                </div>
            </div>
        <!-- #endregion -->
        </div>
        <div class="columna2">
            <!-- #region stats -->
            <div class="statsgrid">
                <?php 
                    getStats();
                ?>
                <script>GenerateBars();</script>
            </div>
            <!-- #endregion -->
        </div>
    </div>

</div>
</html>
