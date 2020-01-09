<?php

class Configurazione {

  // variabili
  public $id;
  public $title;
  public $description;

  function __construct(/* parametri*/ $id, $title, $description ) {

    // valorizzazione variabili tramite parametri

    $this -> id = $id;
    $this -> title = $title;
    $this -> description = $description;
  }

  //funzioni utili

  public function __toString() {

    return /* rappresentazione testuale dell'oggetto */ "[" . $this-> id . "]" . 
                                                              $this-> title . "," . 
                                                              $this-> description ;
  }
}

// connessione al DB


// download di tutte le configurazioni

  //header('Content-Type: application/json');

  $server = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "HotelDB";

  $conn = new mysqli($server, $username, $password, $dbname);
  if ($conn -> connect_errno) {

    echo json_encode(-1);
    return;
  }

  $sql = "

      SELECT *
      FROM configurazioni

  ";

  $res = $conn -> query($sql);
  if ($res -> num_rows < 1) {

    echo json_encode(-2);
    return;
  }


$confs = [];
while($conf = $res -> fetch_assoc()) {

  $confs = new Configurazione($conf['id'],
                              $conf['title'],
                              $conf['description']);
}

foreach ($confs as $conf) {

  echo $conf;
}
