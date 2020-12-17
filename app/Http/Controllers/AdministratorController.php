<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $admins=User::where('type', 1)->orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.administrators.index', compact('admins', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.administrators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreRequest $request) {
        $count=User::where('name', request('name'))->where('lastname', request('lastname'))->count();
        $slug=Str::slug(request('name')." ".request('lastname'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=User::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name')." ".request('lastname'), '-')."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'lastname' => request('lastname'), 'phone' => request('phone'), 'slug' => $slug, 'email' => request('email'), 'password' => Hash::make(request('password')));
                break;
            }
        }

        // Mover imagen a carpeta admins y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $data['photo']=store_files($file, $slug, '/admins/img/admins/');
        }

        $admin=User::create($data);

        if ($admin) {
            return redirect()->route('administradores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Save successful', 'msg' => 'The administrator has been successfully registered.']);
        } else {
            return redirect()->route('administradores.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Save failed', 'msg' => 'An error occurred durind the process, please try again.'])->withInputs();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        $admin=User::where('slug', $slug)->firstOrFail();
        return view('admin.administrators.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $admin=User::where('slug', $slug)->firstOrFail();
        return view('admin.administrators.edit', compact("admin"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest $request, $slug) {

        $admin=User::where('slug', $slug)->firstOrFail();
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'state' => request('state'), 'phone' => request('phone'));

        // Mover imagen a carpeta admins y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $data['photo']=store_files($file, $slug, '/admins/img/admins/');
        }

        $admin->fill($data)->save();

        if ($admin) {
            return redirect()->route('administradores.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful edit', 'msg' => 'The administrator has been edited successfully.']);
        } else {
            return redirect()->route('administradores.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $user=User::where('slug', $slug)->firstOrFail();
        $user->delete();

        if ($user) {
            return redirect()->route('administradores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful removal', 'msg' => 'The administrator has been successfully removed.']);
        } else {
            return redirect()->route('administradores.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed deletion', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $admin = User::where('slug', $slug)->firstOrFail();
        $admin->fill(['state' => "0"])->save();

        if ($admin) {
            return redirect()->route('administradores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful edit', 'msg' => 'The administrator has been successfully deactivated.']);
        } else {
            return redirect()->route('administradores.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }

    public function activate(Request $request, $slug) {

        $admin = User::where('slug', $slug)->firstOrFail();
        $admin->fill(['state' => "1"])->save();

        if ($admin) {
            return redirect()->route('administradores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful edit', 'msg' => 'The administrator has been activated successfully.']);
        } else {
            return redirect()->route('administradores.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }
}
