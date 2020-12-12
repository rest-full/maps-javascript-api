<?php


namespace GoogleMap;



/**
 * Class Marker
 * @package Google
 * @author zezinho2511
 */
class Marker
{
    /**
     * @var array
     */
    private array $coordinates = [];

    /**
     * @var array
     */
    private array $infoWindows = [];

    /**
     * @return array
     */
    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    /**
     * @param array $coordinate
     * @return $this
     */
    public function setCoordinates(array $coordinate): Marker
    {
        $this->coordinates[] = ['lat' => $coordinate[0], 'lng' => $coordinate[1]];
        return $this;
    }

    /**
     * @return array
     */
    public function getInfoWindows(): array
    {
        return $this->infoWindows;
    }

    /**
     * @param array $info
     * @return $this
     */
    public function setInfoWindows(array $info): Marker
    {
        $this->infoWindows[] = ['unidade' => '<b>' . $info[0] . '</b><p>' . $info[1] . '</p>'];
        return $this;
    }

}