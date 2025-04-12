<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    function getMinimalUserAgent($userAgent)
    {
        preg_match('/(Windows NT \d+\.\d+|Mac OS X \d+_\d+|Linux)/i', $userAgent, $osMatch);
        preg_match('/(Chrome|Firefox|Safari|Edge|Opera)[\/ ]([\d.]+)/i', $userAgent, $browserMatch);

        $os = isset($osMatch[0]) ? str_replace(['Windows NT 10.0', 'Mac OS X'], ['Windows 10', 'macOS'], $osMatch[0]) : 'Unknown OS';
        $browser = isset($browserMatch[1]) ? $browserMatch[1] . ' ' . $browserMatch[2] : 'Unknown Browser';

        return "$browser ($os)";
    }

    public function store()
    {
        $data = request()->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);

        $data['ip_address'] = request()->header('X-Forwarded-For') ?? request()->ip();
        $data['user_agent'] = $this->getMinimalUserAgent(request()->header('User-Agent'));

        Subscriber::create($data);

        return redirect()->back()->with('success', 'Successfully subscribed');
    }
}
