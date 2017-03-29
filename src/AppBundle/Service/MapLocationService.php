<?php

namespace AppBundle\Service;


/**
 * Map location service.
 */
class MapLocationService
{
    const DEFAULT_RANGE = 25;
    const GOOGLE_API_KEY = 'AIzaSyDMPI2wts0Emdfmg1eZ7dknFBzeiD4joO8';
    const GOOGLE_API_URL = 'https://maps.googleapis.com/maps/api/geocode/json?';
    const DIVING_SITES_API = 'http://api.divesites.com/?mode=sites';

    /**
     * @param string $country
     * @param string $location
     * @param string $range
     *
     * @return array()
     */
    public function getGeoLocation($country, $location = null, $range = null)
    {
        $criteria = array();
        if (!is_null($location)) { $criteria[] = $location; }
        $criteria[] = $country;
        $range = (is_null($range)) ? static::DEFAULT_RANGE : $range;

        $criteria = str_replace(' ', ',+', $criteria);
        $address = implode(',+' , $criteria);

        $url = (static::GOOGLE_API_URL . 'address=' . $address . '&key=' . static::GOOGLE_API_KEY);

        $request = $this->callApi($url);
        $geoLocation = $request->results[0];

        $location = '&lat=' . $geoLocation->geometry->location->lat . '&lng=' . $geoLocation->geometry->location->lng . '&dist=' . $range;

        $diveSites = $this->callApi(static::DIVING_SITES_API . $location);

        return $this->sortDiveSites($diveSites->sites);
    }

    /**
     * @param array $diveSites
     *
     * @return array
     */
    private function sortDiveSites($diveSites)
    {
        $array = array();
        foreach ($diveSites as $diveSite) {
            $array[$diveSite->name] = array(
                'lat' => $diveSite->lat,
                'lng' =>$diveSite->lng,
                'distance' => $diveSite->distance
            );
        }
        ksort($array, 2);

        return $array;
    }

    /**
     * @param string $url
     *
     * @return string
     */
    private function callApi($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        $response = curl_exec($ch);

        return json_decode($response);
    }
}
