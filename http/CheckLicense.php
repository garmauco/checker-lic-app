<?php

namespace Garmauco\CheckerLicApp\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Garmauco\CheckerLicApp\Contracts\LicenseValidatorInterface;

class CheckLicense
{
    protected $licenseValidator;

    public function __construct(LicenseValidatorInterface $licenseValidator)
    {
        $this->licenseValidator = $licenseValidator;
    }

    public function handle(Request $request, Closure $next)
    {
        $licenseKey = env('LICENSE_CLIENT_API_KEY');

        if (!$this->licenseValidator->validate($licenseKey)) {
            return redirect('https://3mas1r.com/');
        }

        return $next($request);
    }
}
