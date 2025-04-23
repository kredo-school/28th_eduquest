<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * 信頼するプロキシ（Herokuはすべて信頼してOK）
     *
     * @var array|string|null
     */
    protected $proxies = '*';

    /**
     * 信頼するヘッダー
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
