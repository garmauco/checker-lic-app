<?php
namespace Garmauco\CheckerLicApp\Contracts;

interface LicenseValidatorInterface
{
    public function validate(string $licenseKey): array;
    public function validateByProjectUrl(string $projectUrl): bool;
}
?>