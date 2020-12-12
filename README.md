# maps-javascript-api
 Map google with marker and infoWindows
 
 This component will render a map with its key and data to be inserted in the code, in addition to creating your own javascript without using a url to keep calling every time, check if in javascript the key is different and create, ms if you have already inserted it in javascript will skip that part.
 
 ## Usage
 ```php
<?php

use Google\Map;

include_once __DIR__ . '/vendor/autoload.php';

//Insert your google cloud platform key from the map here
$map = new Map('key google cloud platform');
//Center the map with latitude and longitude
$map->setGeolocationCenterMap(-14.235004, -51.92528);
//These are the data you will need for your map
$map->setMarker(
  [
    'coordinate' => [
      [-22.9230338, -43.2322364],
    ],
    'infoWindows' => [
      ['Rio Arte - Tijuca Saens Pena', 'R. Santo Afonso, 153 - Tijuca, Rio de Janeiro - RJ, 20511-170'],
    ]
  ]
);
//Rendering your map with your key in your javascript
echo $map->render();
```

set the width and height, if desired.
```php
$map->setWidthAndHeight(100,200);
```
## License

map javascript api is [MIT](http://opensource.org/licenses/MIT) licensed.
 
