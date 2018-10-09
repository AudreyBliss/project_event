namespace AppBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LeafletExtension extends AbstractExtension;
{

    public funtion getFunction()
    {
        return [
            new TwigFunction('map',[$mapFunction]),

        ];

    }

    public function mapFunction(mapid)
    {
        $map = <div id="mapid"></div>;
        return $map;

    }


}