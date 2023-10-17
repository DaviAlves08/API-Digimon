<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <a href="#"><img class="banner" src="images/digimon_Banner.png" alt="banner digimon"></a>

  <form action='#' method='GET'>
    <div class='mb-3 mt-5 d-flex justify-content-center'>
      <label for='' class='form-label pe-2 pt-1'>Pesquisar Digimon</label>
      <input class="me-3" type='text' name='nome' id='nome'>
      <button type='submit' class='btn btn-primary ps-2'>Pesquisar</button>
    </div>

    <?php

    $dados = json_decode(file_get_contents("https://digimon-api.vercel.app/api/digimon"));

    echo '<div class="row">';
    if (empty($_GET['nome'])) {
      foreach ($dados as $digimon) {
        echo
        "<div class='col mt-5 d-flex justify-content-center'>
        <div class='card' style='width: 18rem;'>
          <img src=$digimon->img class='card-img-top' alt='...'>
          <div class='card-body'>
            <h5 class='card-title'>Nome: $digimon->name</h5>
            <p class='card-text'>Level: $digimon->level</p>
          </div>
        </div>
      </div>";
      }
    } else {
      $digimon = $_GET['nome'];

      $digimons = json_decode(@file_get_contents("https://digimon-api.vercel.app/api/digimon/name/" . $digimon));
      if (empty($digimons)) {
        echo '<div class="col-md-12 mt-5 text-center">';
        echo '<p>Nenhum Digimon encontrado com o nome ' . $digimon . '</p>';
        echo '</div>';
      }
      if (is_array($digimons) || is_object($digimons)) {
        foreach ($digimons as $dados) {
          echo
          "<div class='mb-5 mt-5 d-flex justify-content-center'>
            <div class='card' style='width: 18rem;'>
              <img src=$dados->img class='card-img-top' alt='...'>
              <div class='card-body'>
                <h5 class='card-title'>$dados->name</h5>
                <p class='card-text'>$dados->level</p>
              </div>
            </div>
        </div>";
        }
      }
    }
    echo '</div>';
    ?>
</body>
</html>