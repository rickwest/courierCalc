<?php

namespace AppBundle\DistanceGenerator;

use AppBundle\Entity\Location;

interface DistanceGeneratorInterface {

    /**
     * @param Location $start
     * @param Location $via
     * @param Location $destination
     * @return array [$distance, $duration]
     */
    public function getDistance(Location $start, Location $via, Location $destination);
}