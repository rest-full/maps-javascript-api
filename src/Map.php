<?php


namespace GoogleMap;

use MatthiasMullie\Minify\JS;

/**
 * Class Map
 * @package Google
 * @author zezinho2511
 */
class Map
{

    /**
     * @var int
     */
    private int $zoom;

    /**
     * @var array
     */
    private array $style = [];

    private string $file;

    /**
     * @var string
     */
    private string $geolocationCenter = '';

    /**
     * @var Marker
     */
    private Marker $marker;

    /**
     * Map constructor.
     * @param string $key
     * @param int $zoom
     * @param bool $example
     */
    public function __construct(string $key, int $zoom = 5, bool $example = false)
    {
        $file = $example ? ROOT . 'example' . DS . 'webroot' : ROOT . 'webroot';
        $file .= DS . 'js' . DS . 'map.js';
        $this->zoom = $zoom;
            $js = new JS();
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/js?key=' . $key);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            $js->add(trim(curl_exec($ch)));
            curl_close($ch);
            unlink($file);
            $js->minify($file);
        $this->file = $file;
        return $this;
    }

    /**
     * @return string
     */
    public function getStyle(string $data): string
    {
        if ($data === 'width') {
            if (array_key_exists('width', $this->style) === false) {
                return 'auto';
            }
        } elseif ($data == 'height') {
            if (array_key_exists('height', $this->style) === false) {
                return '300px';
            }
        }
        return $this->style[$data];
    }

    /**
     * @param int $width
     * @param int $height
     * @return $this
     */
    public function setWidthAndHeight(int $width = 0, int $height = 0): Map
    {
        if ($width != 0) {
            $this->style['width'] = $width . 'px';
        }
        if ($height != 0) {
            $this->style['height'] = $height . 'px';
        }
        return $this;
    }

    public function setGeolocationCenterMap(float $lat, float $lng): Map
    {
        $this->geolocationCenter = "{lat:{$lat}, lng:{$lng}}";
        return $this;
    }

    /**
     * @return string
     */
    public function getGeolocationCenterMap(): string
    {
        return $this->geolocationCenter;
    }

    /**
     * @return int
     */
    public function getZoom(): int
    {
        return $this->zoom;
    }

    /**
     * @return Marker
     */
    public function getMarker(): Marker
    {
        return $this->marker;
    }

    /**
     * @param array $datas
     * @return $this
     */
    public function setMarker(array $datas): Map
    {
        $this->marker = new Marker();
        for ($a = 0; $a < count($datas['coordinates']); $a++) {
            $this->marker->setCoordinates($datas['coordinates'][$a]);
            if (isset($datas['infoWindows'][$a])) {
                $this->marker->setInfoWindows($datas['infoWindows'][$a]);
            }
        }
        return $this;
    }

    /**
     * @param string $base
     * @return string
     */
    public function render(string $base = ''): string
    {
        if (empty($base)) {
            $newBase = DS.'webroot';
        } else {
            $newBase = str_replace(DS, DS_REVERSE, $base);
        }
        $file = URL . substr($this->file, stripos($this->file, $newBase));
        if(!empty($base)){
            $file=str_replace($newBase, $base, $file);
        }
        return (new Template())->render($this, $file);
    }
}