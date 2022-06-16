<?php
if (isset($_POST["button"])) {
    $pokemon = getData();//prepare the string before the html document.
}

function getData()
{
    //if user input? use the user input. no user input? use bulba then run code
    if (isset($_POST['pokemon'])) {
        $userInput = $_POST['pokemon'];

    } else {//if no user-input
        $userInput = 1;
    }
    $response = @file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $userInput);
    //var_dump($response);
    if ($response) {
        $data = json_decode($response, true);
    } else if ($response = "bool(false)") {//if pokemon doesn't exist
        $response = @file_get_contents('https://pokeapi.co/api/v2/pokemon/bulbasaur');
        $data = json_decode($response, true);
    }
    $pokemon = ["id" => id($data), "name" => name($data), "image" => image($data), "moves" => moves($data)];//put functions inside a string
    return $pokemon;
}

// echo "<pre>";//will order the list

function id($data1)
{
    $pokeId = $data1['id'];
    return $pokeId;
}

function name($data1)
{
    $pokeName = $data1['name'];
    return $pokeName;
}

function image($data1)
{
    // $pokeImage = $data1->sprites->front_default;
    $img = $data1['sprites']['front_default'];
    return $img;
}

function prepareMoves($data1)
{
    $preparedMoves = [];
    if (count($data1["moves"]) === 1) {
        $preparedMoves[] = $data1["moves"][0]["move"]["name"];
    } else {
        for ($i = 0; $i < 4; $i++) {
            $preparedMoves[] = $data1["moves"][$i]["move"]["name"];
        }
    }
    return $preparedMoves;
}

function moves($data1)
{
    $x = prepareMoves($data1);
    //var_dump($x);
    for ($i = 0; $i < count($x) && $i < 4; $i++) {
        $movesArray[] = "<p>" . $x[$i] . "</p>";
    }
    //var_dump($movesArray);
    $implodedMoves = implode("", $movesArray);
    //var_dump($implodedMoves);
    return $implodedMoves;
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
            //<?php
            //$movesArray = [];
            //$movesArray[0] = "Hello";
            //$movesArray[1] = "Goodbye";
            //echo $movesArray[1];
            //?>
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
                    <img src="<?php echo $pokemon['image'] ?>" alt="pokemonImg">
                </div>
                <div id="pokeFound">
                    <div class="details">
                        <p><strong>ID:</strong><span class="id"><?php echo $pokemon['id'] ?></span></p>
                        <p><strong>Name:</strong><span class="name"><?php echo $pokemon['name'] ?></span></p>
                        <p><strong>Moves:</strong><br><span class="moves"><?php echo $pokemon['moves'] ?></span></p>
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
