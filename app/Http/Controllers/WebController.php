<?php

namespace App\Http\Controllers;

use App\User;
use App\Banner;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\SendMessageRequest;
use App\Http\Requests\RequestCallRequest;
use App\Notifications\SendMessageNotification;
use App\Notifications\RequestCallNotification;

class WebController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $setting=Setting::where('id', 1)->firstOrFail();
    	$banners=Banner::where('state', '1')->orderBy('id', 'DESC')->get();
    	$implementers=User::where('type', '2')->where('state', '1')->orderBy('id', 'DESC')->limit(4)->get();
        return view('web.home', compact('setting', 'banners', 'implementers'));
    }

    public function implementers() {
        $implementers=User::where('type', '2')->where('state', '1')->orderBy('id', 'DESC')->limit(6)->get();
        return view('web.implementers', compact('implementers'));
    }

    public function implementer($slug) {
    	$user=User::where('slug', $slug)->firstOrFail();
        return view('web.implementer', compact('user'));
    }

    public function sendMessage(SendMessageRequest $request, $slug) {
        $user=User::where('slug', $slug)->firstOrFail();
        $user->name=request('name');
        $user->company=request('company');
        $user->email_contact=request('email');
        $user->phone=request('phone');
        $user->message=request('message');
        $user->notify(new SendMessageNotification());

        if ($user) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Successfully Sent', 'msg' => 'The message has been sent successfully.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed Sent', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }

    public function requestCall(RequestCallRequest $request, $slug) {
        $user=User::where('slug', $slug)->firstOrFail();
        $user->name=request('name');
        $user->phone=request('phone');
        $user->notify(new RequestCallNotification());

        if ($user) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Successfully Sent', 'msg' => 'The message has been sent successfully.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed Sent', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }
}