<?php

namespace App\Http\Controllers;

use App\User;
use App\Banner;
use Illuminate\Http\Request;

class WebController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
    	$banners=Banner::where('state', '1')->orderBy('id', 'DESC')->get();
    	$implementers=User::where('type', '2')->where('state', '1')->limit(3)->get();
        return view('web.home', compact('banners', 'implementers'));
    }

    public function implementers() {
        
        $implementers=User::where('type', '2')->where('state', '1')->limit(6)->get();
        return view('web.implementers', compact('implementers'));
    }

    public function implementer($slug) {
    	$user=User::where('slug', $slug)->firstOrFail();
        return view('web.implementer', compact('user'));
    }
}