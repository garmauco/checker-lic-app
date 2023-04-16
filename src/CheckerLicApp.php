<?php

namespace Garmauco\CheckerLicApp;

use Garmauco\CheckerLicApp\Contracts\LicenseValidatorInterface;
use GuzzleHttp\Client;

class CheckerLicApp implements LicenseValidatorInterface
{

    public function validate(string $licenseKey): bool
    {
        $client = new Client(['http_errors' => false]);
        $response = $client->get('https://licenser.3mas1r.com/api.php?license_key=' . $licenseKey);
        $statuscode = $response->getStatusCode();
        $response = json_decode($response->getBody(), true);

        if ($statuscode === 200) {
            return $response['is_valid'];
        } elseif ($statuscode === 404) {
            return false;
        } else {
            return false;
        }
    
    }
}