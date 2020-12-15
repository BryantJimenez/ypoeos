<?php

namespace App\Http\Controllers;

use App\People;
use App\Reset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LoginCustomRequest;
use App\Http\Requests\RegisterCustomRequest;
use App\Http\Requests\RecoveryCustomRequest;
use App\Http\Requests\ResetCustomRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\ResetPasswordCustomNotification;
use DateTime;

class AuthController extends Controller
{
	public function loginForm() {
		return view('web.auth.login');
	}

	public function login(LoginCustomRequest $request) {
		$user=People::where('email', request('email'))->first();
		if (!is_null($user)) {
			if ($user->state==0) {
				return redirect()->back()->with(['error.login' => 'Este usuario no tiene permitido ingresar.'])->withInput();
			} elseif(Hash::check(request('password'), $user->password)) {
				if ($request->session()->has('user')) {
					$request->session()->forget('user');
				}
				
				$request->session()->push('user', $user);
				return redirect()->route('home');
			}
		}
		
		return redirect()->back()->with(['error.login' => 'Las credenciales no coinciden.'])->withInput();
	}

	public function registerForm() {
		return view('web.auth.register');
	}

	public function register(RegisterCustomRequest $request) {
		$count=People::where('name', request('name'))->where('lastname', request('lastname'))->count();
		$slug=Str::slug(request('name')." ".request('lastname'), '-');
		if ($count>0) {
			$slug=$slug."-".$count;
		}

        // Validación para que no se repita el slug
		$num=0;
		while (true) {
			$count2=People::where('slug', $slug)->count();
			if ($count2>0) {
				$slug=Str::slug(request('name')." ".request('lastname'), '-')."-".$num;
				$num++;
			} else {
				$data=array('name' => request('name'), 'lastname' => request('lastname'), 'slug' => $slug, 'email' => request('email'), 'password' => Hash::make(request('password')));
				break;
			}
		}

		$people=People::create($data);

		if ($people) {
			$user=People::where('email', request('email'))->first();
			$request->session()->push('user', $user);
			return redirect()->route('home');
		} else {
			return redirect()->back()->with(['error.register' => 'Ha ocurrido un problema, intentelo nuevamente.'])->withInputs();
		}
	}

	public function recoveryForm() {
		return view('web.auth.recovery');
	}

	public function recovery(RecoveryCustomRequest $request) {
		$user=People::where('email', request('recovery'))->first();
		if (!is_null($user)) {
			
			$token=str_replace("=", "", encrypt(rand(1000000, 9999999)));
			$data=array('email' => $user->email, 'token' => $token);
			$reset=Reset::create($data);

			$user->notify(new ResetPasswordCustomNotification($token));
			return redirect()->back()->with(['success.recovery' => 'El correo ha sido enviado exitosamente']);
		}
		
		return redirect()->back()->with(['error.recovery' => 'Este usuario no existe.'])->withInput();
	}

	public function resetForm(Request $request, $slug, $token) {
		$people=People::where('slug', $slug)->firstOrFail();
		$reset=Reset::where('email', $people->email)->orderBy('created_at', 'DESC')->first();

		if (!is_null($reset) && $token==$reset->token) {
			$date=new DateTime($reset->created_at->format('Y-m-d H:i:s'));
			$date->modify('+30 minute');

			if ($date->format('d-m-Y H:i:s')>date('d-m-Y H:i:s')) {
				return view('web.auth.reset', compact('slug', 'token'));
			}
		}
		
		abort(403);
	}

	public function reset(ResetCustomRequest $request, $slug, $token) {
		$people=People::where('slug', $slug)->firstOrFail();
		$people->fill(['password' => Hash::make(request('password'))])->save();
		if ($people) {
			return redirect()->route('ingresar')->with(['success.reset' => 'La contraseña ha sido actualizada exitosamente.']);
		} else {
			return redirect()->back()->with(['error.reset' => 'Ha ocurrido un problema durante el proceso, intentelo nuevamente.'])->withInput();
		}
	}

	public function logout(Request $request) {
		if ($request->session()->has('user')) {
			$request->session()->forget('user');
		}

		return redirect()->back();
	}
}