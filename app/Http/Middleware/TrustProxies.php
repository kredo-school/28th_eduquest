<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request;

class TrustProxies extends Middleware
{
    protected $proxies = '*'; // ← すべてのプロキシを信頼！

    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}

