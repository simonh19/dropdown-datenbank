<?php
if (session_id() == '') {
    session_start();
}
include_once 'helper/form_functions.php';
include_once 'helper/database_functions.php';
include_once 'conf.php';

$tablesQuery = "SELECT concat(Table_SCHEMA,'.',Table_name) as label,Table_name as value
    FROM INFORMATION_SCHEMA.TABLES
    where Table_SCHEMA = 'bestellsystem';";
$preparedStmt = $conn->prepare($tablesQuery);
$preparedStmt->execute();
$tables = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $ausgewaehlteTabelle = getPostParameter("tabellen","");
    header("Location: index.php?site=spalten-anzeigen?edit_id=" . $ausgewaehlteTabelle );
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">BS Linz 2</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="index.php">Startseite</a>
        </div>
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="index.php?site=">Link 1</a>
        </div>
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="index.php?site=">Link 2</a>
        </div>
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="index.php?site=">Link 3</a>
        </div>
    </div>
</nav>
<div class="card border-0 p-4 container d-flex align-items-center flex-column mt-4 gap-4">
    <?php
        
        if (isset($_GET["site"])) {
            $fullUrl = $_GET["site"];
            if (str_contains($fullUrl, "?")) {
                $separator = "?";
                $parts = explode($separator, $fullUrl);
                $_GET['urlParam'] = $parts;
                $site = $parts[0];
                include_once($site . ".php");
            } else {
                include_once($fullUrl . ".php");
            }
        } else{
            echo tablesDropdown($tables);
        }
    ?>
</div>
</body>
</html>