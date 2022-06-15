<?php
if (isset($_POST["button"])) {
    $pokemon = getData();//prepare the string before the html document.
}

function getInput($isBulba) {
if ($isBulba)
{
    $input = 1;
}
else{
    $input = $_POST['pokemon'];
}

    return $input;
}

function getData() {
    $response1 = file_get_contents('https://pokeapi.co/api/v2/pokemon/'. getInput(isset($_POST["button"])));
    $data = json_decode($response1, true);
   // $pokeImage = $data1->sprites->front_default;

   // echo "<pre>";//will order the list
    $pokemon = ["id"=>id($data), "name"=>name($data), "image"=>image($data), "moves"=>moves($data)];//put functions inside a string
    return $pokemon;
}

function id($data1) {
    $pokeId = $data1['id'];
    return $pokeId;
}

function name($data1) {
    $pokeName = $data1['name'];
    return $pokeName;
}

function image($data1) {
    $img = $data1['sprites'];
    return $img;
}

function moves($data1) {
    $moves = $data1['moves'];
    for ($i = 0; $i <count($moves) && $i < 4; $i++) {
        $moves = $moves[$i];
    }
    return $moves;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>AJAX-Pok-dex</title>
</head>
<body>
<main>
    <div class="container">
        <div id="title">
            <h1>Poke-dex</h1>
        </div>

        <div id="poke-img">
            <img src="images/pokedex-img.png" alt="image of different Pokemons" title="Pokemon">
        </div>
        <div id="content">
            <div id="search">
                <form action="index.php" method="post">
                    <div class="field">
                        <label for="pokemon">Who are you looking for?</label>
                        <input type="text" name="pokemon" id="pokemon" placeholder="Enter name or ID" required>
                        <button type="submit" name="button" id="run">Look for Pokemon></button>
                    </div>
                </form>
            </div>
            <div id="found">

                <div id="pokePic">

                    <img src="<?php echo $pokemon['image'] ?>" alt="#">

                </div>
                <div id="pokeFound">
                    <div class="details">
                        <p><strong>ID:</strong><span class="id" ><?php echo $pokemon['id']?></span></p>
                        <p><strong>Name:</strong><span class="name" ><?php echo $pokemon['name']?></span></p>
                        <p><strong>Moves:</strong><br><span class="moves" ><?php echo $pokemon['moves']?></span></p>
                    </div>
                </div>
                <ul id="target"></ul>
                <div id="evoPics">

                </div>
            </div>
        </div>
    </div>

</main>

</body>
</html>
