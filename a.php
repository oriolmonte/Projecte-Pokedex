<?php if(!isset($_GET['n'])) { ?>
<form action="pokemon.php" method="get">
    <p>n: <input type="text" name="n" /></p>
    <p>min: <input type="text" name="min" /></p>
    <p>max: <input type="text" name="max" /></p>
    <p><input type="submit" /></p>
</form>
<?php } else {
    $data = array();
    for ($i=0; $i < $_GET['n']; $i++) { 
        $data[$i] = rand($_GET['min'], $_GET['max']);
    }
    echo '[' . implode(', ', $data) . ']';
} ?> 