<?php
namespace AppBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LeafletExtension extends AbstractExtension
{
//affichage de la map
    public function getFunctions()
    {
        return [
            new TwigFunction('leaflet_map',[$this,'leafletMapFunction']),
            new TwigFunction('marker_map',[$this,'markerMapFunction']),
        ];

    }

    public function leafletMapFunction($mapid)
    {
        $map = "<div id='$mapid'></div>
        <script>let mymap = L.map('$mapid').setView([48.8534, 2.3488], 13); 
        display_map(mymap);</script>";
        return $map;

    }
    
//affichage map+marqueurs


    public function markerMapFunction($marker)
    {
    $point = '
    {% for e in event %}
    display_marker(mymap, {{e.latitude}}, {{e.longitude}})
    {% endfor %}
    ';
    return $point;

    }





}