<?php

namespace Produzentenstolz\Produzentenstolz\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class PsDataRepository
{

    /*
     * Get data from Produzentenstolz API
     * @param int $restaurantId
     */
    public function getPsData($restaurantId = 2): array
    {

        $endpoint = 'https://produzentenstolz.app/routeapi/restaurant/manufacturers/' . $restaurantId;
        $response = GeneralUtility::getUrl($endpoint, 0, ['ssl_verify' => false]);
        if ($response === false) {
            return 'Error: Unable to retrieve data';
        }

        $data = json_decode($response, true);
        return $data;

    }

}
