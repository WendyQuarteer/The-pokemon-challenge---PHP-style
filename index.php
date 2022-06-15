
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
                <form action="#" method="get">
                    <div class="field">
                        <label for="pokemon">Who are you looking for?</label>
                        <input type="text" name="pokemon" id="pokemon" placeholder="Enter name or ID" required>
                        <button type="button" name="button" id="run">Look for Pokemon></button>
                    </div>
                </form>
            </div>
            <div id="found">
                <?php
                if (isset($_GET["button"])) {
                    getData();
                    print_r("hi");
                }
                    function getData() { //concatenate the input (=string) with he API url.
                        $response1 = file_get_contents('https://pokeapi.co/api/v2/pokemon/pikachu'); //fetch the pokeAPI and await operator for promise.
                        $data1 = json_decode($response1, true);  //await promise to get data1.
                        print_r($data1["sprites"]);
                    }



                ?>
                <div id="pokePic">

                </div>
                <template id="pokeFound">
                    <div class="details">
                        <p><strong>ID:</strong><span class="id"></span></p>
                        <p><strong>Name:</strong><span class="name"></span></p>
                        <p><strong>Moves:</strong></br><span class="moves"></span></p>
                    </div>
                </template>
                <ul id="target"></ul>
                <div id="evoPics">

                </div>
            </div>
        </div>
    </div>

</main>
<script src="script.js"></script>
</body>
</html>
