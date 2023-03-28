
<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=aplicaciones', 'root', '');
    //echo 'Conectado';
} catch (PDOException $e) {
    print "¡Error de conexion!: " . $e->getMessage() . "<br/>";
    die();
}
?>
