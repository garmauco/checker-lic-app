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

    public function validate(string $licenseKey): bool
    {
        // Aquí puedes implementar la lógica de validación de la clave de licencia.
        // Por ejemplo:
        $validLicenseKey = 'tu_clave_de_licencia_correcta';
        return $licenseKey === $validLicenseKey;
    }

    public function validateByProjectUrl(string $projectUrl): bool
    {
        $response = $this->httpClient->get('https://licenser.3mas1r.com/api/get_license_key.php?', [
            'query' => [
                'project_url' => $projectUrl,
            ],
        ]);

        $licenseKey = json_decode($response->getBody()->getContents(), true)['license_key'];

        $response = $this->httpClient->get('https://licenser.3mas1r.com/api/validate_license.php?', [
            'query' => [
                'license_key' => $licenseKey,
            ],
        ]);

        $licenseStatus = json_decode($response->getBody()->getContents(), true);
        return isset($licenseStatus['is_valid']) && $licenseStatus['is_valid'] == true;
    }
}



