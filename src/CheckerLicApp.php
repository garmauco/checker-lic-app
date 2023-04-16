<?php

namespace Garmauco\CheckerLicApp;

use Garmauco\CheckerLicApp\Contracts\LicenseValidatorInterface;

class CheckerLicApp implements LicenseValidatorInterface
{
    public function validate(string $licenseKey): bool
    {
        // Aquí puedes implementar la lógica de validación de la clave de licencia.
        // Por ejemplo:
        $validLicenseKey = 'tu_clave_de_licencia_correcta';
        return $licenseKey === $validLicenseKey;
    }
}