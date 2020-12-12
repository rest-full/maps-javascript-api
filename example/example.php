<?php

use GoogleMap\Map;

include_once __DIR__ . '/../vendor/autoload.php';

define('DS', "/");
define('DS_REVERSE', '\\');
define('ROOT', dirname(__DIR__) . DS);
define('URL', $_SERVER['REQUEST_SCHEME'] . ":" . DS . DS . $_SERVER['SERVER_NAME'] . DS);

$map = new Map('AIzaSyA_kfjzV_HqFt1ri2d_L-AzIfbpDKJ0C3Y',5,true);
$map->setGeolocationCenterMap(-14.235004, -51.92528)->setMarker(
  [
    'coordinates' => [
      [-22.9230338, -43.2322364],
      [-22.9537457, -43.1940387],
      [-22.902006, -43.1099385],
      [-23.0039068, -43.3182482],
      [-23.0010864, -43.3904259],
      [-22.9070683, -43.1775715]
    ],
    'infoWindows' => [
      ['Data X - Tijuca', 'Rua Santo Afonso, 131 - Sala 201 - Rio de Janeiro, RJ - 20511-170'],
      ['Data X - Botafogo', 'Rua Real Grandeza, 108 - Sala 119 - Rio de Janeiro, RJ - 22281-033'],
      ['Data X - Niterói', 'Rua Mem de Sá, 111 - Sala 1101 - Niterói, RJ - 24220-260'],
      ['Data X - Downtown', 'Av. das Américas, 500 - Bloco 13 - Loja 124 - Rio de Janeiro, RJ - 26220-442'],
      ['Data X - Sun Plaza', 'Av. das Américas, 7.935 - Sala 225 - Bloco A - Rio de Janeiro, RJ - 22793-081'],
      ['Data X - Centro', 'Av. Rio Branco, 156 - Sala 2.316 - Rio de Janeiro, RJ - 20043-900']
    ]
  ]
);
echo $map->render('maps-javascript-api');