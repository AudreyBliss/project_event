<?php
namespace AppBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LeafletExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('leaflet_map',[$this,'leafletMapFunction']),

        ];

    }

    public function leafletMapFunction($mapid)
    {
        $map = "<div id='$mapid'></div>";
        return $map;

    }


}