<?php

namespace Garmauco\CheckerLicApp;

use GuzzleHttp\Client;
use Garmauco\CheckerLicApp\Contracts\LicenseValidatorInterface;

class CheckerLicApp implements LicenseValidatorInterface
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    public function validate(string $licenseKey): array
    {
        $client = new Client(['http_errors' => false]);
        $response = $client->get('https://api-verification.3mas1r.com/validate_license.php?license_key=' . $licenseKey);

        $statuscode = $response->getStatusCode();
        $response = json_decode($response->getBody(), true);

        if ($statuscode === 200) {
            if ($response['is_valid'] === true) {
                return array('status' => true, 'url' => $response['redirect_url']);
            } else {
                return array('status' => false, 'url' => $response['redirect_url']);
            }
        } elseif ($statuscode === 404) {
            return array('status' => false, 'url' => 'https://not-licence.3mas1r.com');
        } else {
            return array('status' => false, 'url' => 'https://not-licence.3mas1r.com');
        }
    }

    public function validateByProjectUrl(string $projectUrl): bool
    {
        $response = $this->httpClient->get('https://api-verification.3mas1r.com/get_license_key.php?', [
            'query' => [
                'project_url' => $projectUrl,
            ],
        ]);

        $licenseKey = json_decode($response->getBody()->getContents(), true)['license_key'];

        $response = $this->httpClient->get('https://api-verification.3mas1r.com/validate_license.php?', [
            'query' => [
                'license_key' => $licenseKey,
            ],
        ]);

        $licenseStatus = json_decode($response->getBody()->getContents(), true);
        return isset($licenseStatus['is_valid']) && $licenseStatus['is_valid'] == true;
    }
}


