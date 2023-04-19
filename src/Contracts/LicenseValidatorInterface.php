<?php
namespace Garmauco\CheckerLicApp\Contracts;

interface LicenseValidatorInterface
{
    public function validate(string $licenseKey): bool;
    public function validateByProjectUrl(string $projectUrl): bool;
}
?>