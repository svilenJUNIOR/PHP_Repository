<?php
    session_start();
    include "../Config/DbContext.php";

    if (isset($_SESSION["UserId"])){
    echo "
    <h1> write something funny here so we can have a little bit of a laugh</h1>
    <form method='POST'>
    <textarea cols='50' rows='10' name='Joke'></textarea>
    <button type='submit' name='Submit'>press</button>
    </form>
    ";
    echo "<a href='logout.php'>log out</a>";


    if (isset($_POST["Submit"])){
        $Joke = filter_input(INPUT_POST, "Joke", FILTER_SANITIZE_SPECIAL_CHARS);

        if (!empty($Joke)) {
            $sql = "INSERT INTO jokes (text) VALUES ('$Joke')";

            if (mysqli_query($connectionString, $sql)) header("Location: WelcomePage.php");
            else Echo "Error ". mysqli_error($connectionString);
        }
    }

    $query = "SELECT text FROM jokes";
    $result = mysqli_query($connectionString, $query);
    $jokes = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo "<br>";
    
    for ($index = 0; $index < count($jokes);  $index++){
        print_r($jokes[$index]["text"]);
        echo "<br>";
    }
}
?>