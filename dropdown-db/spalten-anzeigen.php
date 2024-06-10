<?php
if (session_id() == '') {
    session_start();
}
include_once 'helper/form_functions.php';
include_once 'helper/database_functions.php';
include_once 'conf.php';

$site = $_GET['site'];
$parts = explode("?", $site);
$ausgewaehlteTabelle = getUrlParam($parts[1]);

$querySpalten ='SHOW COLUMNS from ' . $ausgewaehlteTabelle;
$preparedStmt = $conn->prepare($querySpalten);
$preparedStmt->execute();
$spalten = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
    
}
?>

<form class="card p-5 shadow border-0" action="post">
  <div class="form-group">
<?php echo generateInputField($spalten); ?>
  </div>
  <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>

