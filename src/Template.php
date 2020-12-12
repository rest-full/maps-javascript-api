<?php

namespace GoogleMap;

/**
 * Class Template
 * @package Google
 * @author zezinho2511
 */
class Template
{
    /**
     * @var array|string[]
     */
    private array $template = [
      'div' => '<div id="map_canvas"></div>',
      'link' => '<script%s></script>',
      'block' => '<script>%s</script>'
    ];

    /**
     * @param Map $map
     * @param string $file
     * @return string
     */
    public function render(Map $map, string $file): string
    {
        $script = 'var map;' . PHP_EOL;
        $script .= 'var geolocations = Object.values(' . json_encode(
            $map->getMarker()->getCoordinates(),
            JSON_FORCE_OBJECT
          ) . ');' . PHP_EOL;
        $script .= 'var infoWindows = Object.values(' . json_encode(
            $map->getMarker()->getInfoWindows(),
            JSON_FORCE_OBJECT
          ) . ');' . PHP_EOL;
        $script .= 'var divMap = document.getElementById("map_canvas");' . PHP_EOL;
        $script .= 'divMap.style.width="' . $map->getStyle('width') . '";' . PHP_EOL;
        $script .= 'divMap.style.height="' . $map->getStyle('height') . '";' . PHP_EOL;
        $script .= 'initMap(divMap,geolocations,infoWindows);' . PHP_EOL;
        $script .= 'function initMap(divMap, geolocations, infoWindows) {' . PHP_EOL;
        $script .= 'map = new google.maps.Map(divMap, {' . PHP_EOL;
        $script .= 'zoom: ' . $map->getZoom() . ',' . PHP_EOL;
        $script .= 'center: ' . $map->getGeolocationCenterMap() . ',' . PHP_EOL;
        $script .= 'mapTypeId: google.maps.MapTypeId.ROADMAP' . PHP_EOL;
        $script .= '});' . PHP_EOL;
        $script .= 'if (geolocations.length > 0) {' . PHP_EOL;
        $script .= 'for (var i = 0; i < geolocations.length; i++) {' . PHP_EOL;
        $script .= 'var marker = new google.maps.Marker({' . PHP_EOL;
        $script .= 'position: geolocations[i],' . PHP_EOL;
        $script .= 'map: map,' . PHP_EOL;
        $script .= '});' . PHP_EOL;
        $script .= 'map.setCenter(marker.getPosition());' . PHP_EOL;
        $script .= 'if (infoWindows.length > 0) {' . PHP_EOL;
        $script .= 'var infoWindow = new google.maps.InfoWindow();' . PHP_EOL;
        $script .= 'var content = infoWindows[i].unidade;' . PHP_EOL;
        $script .= 'google.maps.event.addListener(marker, "click", (function (marker, content, infoWindow) {' . PHP_EOL;
        $script .= 'return function () {' . PHP_EOL;
        $script .= 'infoWindow.setContent(content);' . PHP_EOL;
        $script .= 'infoWindow.open(map, marker);' . PHP_EOL;
        $script .= '};' . PHP_EOL;
        $script .= '})(marker, content, infoWindow));' . PHP_EOL;
        $script .= '}' . PHP_EOL;
        $script .= '}' . PHP_EOL;
        $script .= '}' . PHP_EOL;
        $script .= '}';
        return $this->template['div'] . PHP_EOL . sprintf(
            $this->template['link'],
            ' src="'.$file.'"'
          ) . PHP_EOL . sprintf(
            $this->template['block'],
            $script
          );
    }
}