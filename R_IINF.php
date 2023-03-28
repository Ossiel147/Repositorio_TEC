<?php
include_once 'conexion.php';
$sql = 'SELECT * FROM repositorio_iinf';
$sentencia = $pdo->prepare($sql);
$sentencia->execute();

$resultado = $sentencia->fetchAll();
$ppp = 4;
$tprog = $sentencia->rowCount();
$paginas = $tprog / $ppp;
$paginas = ceil($paginas);
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Repositorio</title>
</head>

<body>
  <?php
  if (!$_GET) {
    header('Location:R_IINF.php?pagina=1');
  }
  if ($_GET['pagina'] - 1 >= $paginas || $_GET['pagina'] - 1 < 0) {
    header('Location:R_IINF.php?pagina=1');
  }

  $iniciar = ($_GET['pagina'] - 1) * $ppp;

  $sql_ctrl = 'SELECT * FROM repositorio_iinf LIMIT :iniciar,:nprog';
  $sentencia_prog = $pdo->prepare($sql_ctrl);
  $sentencia_prog->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
  $sentencia_prog->bindParam(':nprog', $ppp, PDO::PARAM_INT);
  $sentencia_prog->execute();

  $resultado_prog = $sentencia_prog->fetchAll();
  ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-gray" style="background-color: rgba(169, 169, 169, 0.543);">
    <div class="container-fluid">
      <a class="navbar-brand" href="Index.php"><img src="img/logo-tecrio-removebg-preview.png" width="50" class="img-fluid" alt="">Tecnologico Superior de Rioverde</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Index.php">Inicio</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Carreras
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="R_ISC.php">Ingenieria en sistemas computacionales</a></li>
              <li><a class="dropdown-item" href="#">Ingenieria en informatica</a></li>
              <li><a class="dropdown-item" href="R_IGE.php">Ingenieria en gestion empresarial</a></li>
              <li><a class="dropdown-item" href="R_IINO.php">Ingenieria en inovacion</a></li>
              <li><a class="dropdown-item" href="R_IIND.php">Ingenieria industrial</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="https://rioverde.tecnm.mx/">Pagina Oficial TECNM</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-xxl ">
    <hr color="black" class="container-xxl" />
  </div>
  <div class="container-xxl d-flex justify-content-center">
    <div>
      <img src="img/logo-tecnm-removebg-preview.png" width="200" class="img-fluid" alt="">
    </div>
    <div class="container-xxl justify-content-center">
      <center>
        <h1>Repositorio</h1>
      </center>
      <center>
        <h2>Aplicaciones para el alumnado de<br>Ingenieria en sistemas computacionales</h2>
      </center>
    </div>
    <div>
      <img src="img/logo-tecrio-removebg-preview.png" width="200" class="img-fluid" alt="">
    </div>
  </div>
  <!--  -->
  <div class="container-xxl justify-content-center">
    <table id="tablax" class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Link descarga</th>
          <th scope="col">Link video</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($resultado_prog as $ctrl) : ?>
          <tr>
            <th scope="row"><?php echo $ctrl['id'] ?></th>
            <!-- <td><?php echo $icono[$i] ?></td>
            <td> <img src="<?php echo $icono[$i] ?>" ></td> -->
            <td><?php echo $ctrl['nombre'] ?></td>
            <td class="link-primary" href="<?php echo $ctrl['Link_descarga'] ?>"><?php echo $ctrl['Link_descarga'] ?></td>
            <td class="link-primary" href="<?php echo $ctrl['Link_video'] ?>"><?php echo $ctrl['Link_video'] ?></td>
          </tr>
        <?php endforeach; ?>
        </tr>
      </tbody>
    </table>
  </div>
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?> ">
        <a class="page-link" href="R_IINF.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a>
      </li>
      <?php for ($i = 0; $i < $paginas; $i++) : ?>
        <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>"><a class="page-link" href="R_IINF.php?pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
      <?php endfor; ?>
      <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
        <a class="page-link" href="R_IINF.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Suiguiente</a>
      </li>
    </ul>
  </nav>


  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>