<?php
namespace AppBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LeafletExtension extends AbstractExtension
{

    public function getFunction()
    {
        return [
            new TwigFunction('map',[$this,'mapFunction']),

        ];

    }

    public function mapFunction($mapid)
    {
        $map = "<div id='$mapid'></div>";
        return $map;

    }


}