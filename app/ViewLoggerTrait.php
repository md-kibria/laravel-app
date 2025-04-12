<?php

namespace App;

use App\Models\View;
use Illuminate\Support\Facades\Auth;

trait ViewLoggerTrait
{
    function getMinimalUserAgent($userAgent)
    {
        preg_match('/(Windows NT \d+\.\d+|Mac OS X \d+_\d+|Linux)/i', $userAgent, $osMatch);
        preg_match('/(Chrome|Firefox|Safari|Edge|Opera)[\/ ]([\d.]+)/i', $userAgent, $browserMatch);

        $os = isset($osMatch[0]) ? str_replace(['Windows NT 10.0', 'Mac OS X'], ['Windows 10', 'macOS'], $osMatch[0]) : 'Unknown OS';
        $browser = isset($browserMatch[1]) ? $browserMatch[1] . ' ' . $browserMatch[2] : 'Unknown Browser';

        return "$browser ($os)";
    }

    public function storeViewData($pageId = 'home', $type = 'page', $serviceId = null, $postId = null, $orderId = null)
    {
        return View::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'ip_address' => request()->header('X-Forwarded-For') ?? request()->ip(),
            'user_agent' => $this->getMinimalUserAgent(request()->header('User-Agent')),
            'referrer' => request()->headers->get('referer'),
            'type' => $type,
            'page_id' => $pageId,
            'service_id' => $serviceId,
            'post_id' => $postId,
            'order_id' => $orderId,
        ]);
    }
}
