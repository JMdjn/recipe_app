<?php
// 👩‍💻 Incluez les fonctions et le header
include 'templates/header.php';
require 'app/functions.php';
$recipes = getAllRecipes();
// 👩‍💻 Récuperez les recettes depuis le dossier data grâce à la fonction getAllRecipes
?>

<h1>Liste des Recettes</h1>
<ul>
    <?php
    foreach ($recipes as $recipe) {    
        echo "<li><a href='recipe.php?id=" . $recipe['id'] . "'>" . $recipe['name'] . "</a></li>";
    }
?>
</ul>

<h1>Ajouter une recette</h1>
<form action="" method ="post">
    <label for="name">Nom:</label>
    <input type="text" id= "name" name="name">
    <label for="description">Description:</label>
    <input type="text" id="description" name="description">
    <label for="ingredients">Ingrédients:</label>
    <input type="text" id="ingredients" name="ingredients">
    <label for="steps">Etapes:</label>
    <input type="text" id="steps" name= "steps">
    <button>Envoyer</button>
</form>
<?php
// 👩‍💻 Incluez le footer
include './templates/footer.php';
?>