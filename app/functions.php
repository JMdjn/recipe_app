<?php
/**
 * 📝 On créé une fonction qui récupère toutes les données de toutes les recettes. On apprendre plus tard que dans ces cas ci il ne faut jamais récupérer toute la donnée d'un item.
 * Lit toutes les recettes du dossier spécifié et récupère leur contenu.
 * @return array Tableau de toutes les recettes.
 */
require 'config/database.php';


function getAllRecipes() {
    global $pdo;

    try {
        $sql = "SELECT r.id,r.name FROM recipes as r;";
        $query = $pdo->prepare($sql);
        $query->execute();

        $recipes = $query->fetchAll(PDO::FETCH_ASSOC);
        return $recipes;
    }  catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
        
    }
// function getAllRecipes() {
//     // 👩‍💻 Déclarer la variable $recipes comme un tableau vide pour stocker les données des recettes.
// $recipes = [];
//     // 👩‍💻 Utiliser la fonction `glob()` pour récupérer les noms de tous les fichiers JSON de recettes dans le dossier 'data/recettes/'.
// $recipeFiles = glob('data/recettes/*.json');

//     foreach ($recipeFiles as $recipeFile){
//         $content = file_get_contents($recipeFile);
//         $recipes[] = json_decode($content, true);
//     }
//     return $recipes;
// }
// $recipes = getAllRecipes();

/**
 * 
 * Lit une recette spécifique basée sur son ID et récupère son contenu.
 * @param int $id ID de la recette à lire.
 * @return array|null Tableau contenant les détails de la recette, null si non trouvée.
 */


        function readRecipe($recipeId) {
            global $pdo;

            try {
                $sql = "SELECT * FROM recipes WHERE id=$recipeId;";
                $query = $pdo->prepare($sql);
                $query->execute();
        
                $recipe = $query->fetchAll(PDO::FETCH_ASSOC);
                return $recipe;
            }  catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }


                    // $filePath = "data/recettes/{$recipeId}.json";
        
            // if (file_exists($filePath)) {
            //     $fileContent = file_get_contents($filePath); 
            //     return json_decode($fileContent, true);;
            // } else {
            //     return null; // La recette n'existe pas
            // }
            function insertRecipe($name, $description, $ingredients, $steps) {
                global $pdo;
            
                try {
                    $sql = "INSERT INTO recipes (name, description, ingredients, steps) VALUES (:name, :description, :ingredients, :steps)";
                    $query = $pdo->prepare($sql);
                    $query->bindParam(':name', $name, PDO::PARAM_STR);
                    $query->bindParam(':description', $description, PDO::PARAM_STR);
                    $query->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
                    $query->bindParam(':steps', $steps, PDO::PARAM_STR);
                    $query->execute();
                } catch (\PDOException $e) {
                    throw new \PDOException($e->getMessage(), (int)$e->getCode());
                }
            }
            

            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                $name = $_POST["name"];
                $description = $_POST["description"];
                $ingredients = $_POST["ingredients"];
                $steps = $_POST["steps"];
            

                insertRecipe($name, $description, $ingredients, $steps);
            }
?>