<?php

namespace App\Http\Controllers;

use App\User;
use App\Implementer;
use App\Testimonial;
use App\Http\Requests\ImplementerStoreRequest;
use App\Http\Requests\ImplementerUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImplementerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $implementers=User::where('type', '2')->orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.implementers.index', compact('implementers', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.implementers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImplementerStoreRequest $request) {
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
                $data=array('name' => request('name'), 'lastname' => request('lastname'), 'phone' => request('phone'), 'slug' => $slug, 'email' => request('email'), 'type' => '2');
                break;
            }
        }

        // Mover imagen a carpeta users y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $data['photo']=store_files($file, $slug, '/admins/img/users/');
        }

        $user=User::create($data);

        $data=array('title' => request('title'), 'ypo_chapter' => request('ypo_chapter'), 'service_area' => request('service_area'), 'address' => request('address'), 'lat' => request('lat'), 'lng' => request('lng'), 'experience' => request('experience'), 'ypo_link' => request('ypo_link'), 'eos_link' => request('eos_link'), 'facebook' => request('facebook'), 'twitter' => request('twitter'), 'linkedin' => request('linkedin'), 'user_id' => $user->id);
        $implementer=Implementer::create($data);

        if ($user && $implementer) {
            return redirect()->route('implementadores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Save successful', 'msg' => 'The implementer has been successfully registered.']);
        } else {
            return redirect()->route('implementadores.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Save failed', 'msg' => 'An error occurred durind the process, please try again.'])->withInputs();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        $user=User::where('slug', $slug)->firstOrFail();
        return view('admin.implementers.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $user=User::where('slug', $slug)->firstOrFail();
        return view('admin.implementers.edit', compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImplementerUpdateRequest $request, $slug) {
        $user=User::where('slug', $slug)->firstOrFail();
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'phone' => request('phone'), 'email' => request('email'));

        // Mover imagen a carpeta users y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $data['photo']=store_files($file, $slug, '/admins/img/users/');
        }

        $user->fill($data)->save();

        $data=array('title' => request('title'), 'ypo_chapter' => request('ypo_chapter'), 'service_area' => request('service_area'), 'address' => request('address'), 'lat' => request('lat'), 'lng' => request('lng'), 'experience' => request('experience'), 'ypo_link' => request('ypo_link'), 'eos_link' => request('eos_link'), 'facebook' => request('facebook'), 'twitter' => request('twitter'), 'linkedin' => request('linkedin'));
        $user->implementer->fill($data)->save();

        if ($user) {
            return redirect()->route('implementadores.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful edit', 'msg' => 'The implementer has been edited successfully.']);
        } else {
            return redirect()->route('implementadores.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred durind the process, please try again.']);
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
            return redirect()->route('implementadores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful removal', 'msg' => 'The implementer has been successfully removed.']);
        } else {
            return redirect()->route('implementadores.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed deletion', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }

    public function deactivate(Request $request, $slug) {
        $user=User::where('slug', $slug)->firstOrFail();
        $user->fill(['state' => "0"])->save();

        if ($user) {
            return redirect()->route('implementadores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful edit', 'msg' => 'The implementer has been successfully deactivated.']);
        } else {
            return redirect()->route('implementadores.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }

    public function activate(Request $request, $slug) {
        $user=User::where('slug', $slug)->firstOrFail();
        $user->fill(['state' => "1"])->save();

        if ($user) {
            return redirect()->route('implementadores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful edit', 'msg' => 'The implementer has been activated successfully.']);
        } else {
            return redirect()->route('implementadores.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }

    public function addImplementers($offset=NULL, $limit=NULL) {
        if (is_null($offset) && is_null($limit)) {
            $implementers=Implementer::join('users', 'users.id', '=', 'implementers.user_id')->select('users.slug', 'users.name', 'users.lastname', 'users.photo', 'implementers.lat', 'implementers.lng', 'implementers.title', 'implementers.ypo_chapter', 'implementers.service_area', 'implementers.address')->orderBy('lastname', 'ASC')->get();
        } else {
            if (!is_null($offset) && is_null($limit)) {
                $implementers=Implementer::join('users', 'users.id', '=', 'implementers.user_id')->select('users.slug', 'users.name', 'users.lastname', 'users.photo', 'implementers.lat', 'implementers.lng', 'implementers.title', 'implementers.ypo_chapter', 'implementers.service_area', 'implementers.address')->orderBy('lastname', 'ASC')->offset($offset)->get();
            } elseif (is_null($offset) && !is_null($limit)) {
                $implementers=Implementer::join('users', 'users.id', '=', 'implementers.user_id')->select('users.slug', 'users.name', 'users.lastname', 'users.photo', 'implementers.lat', 'implementers.lng', 'implementers.title', 'implementers.ypo_chapter', 'implementers.service_area', 'implementers.address')->orderBy('lastname', 'ASC')->limit($limit)->get();
            } else {
                $implementers=Implementer::join('users', 'users.id', '=', 'implementers.user_id')->select('users.slug', 'users.name', 'users.lastname', 'users.photo', 'implementers.lat', 'implementers.lng', 'implementers.title', 'implementers.ypo_chapter', 'implementers.service_area', 'implementers.address')->orderBy('lastname', 'ASC')->offset($offset)->limit($limit)->get();
            }
        }

        $total=Implementer::count();
        $offset=(!is_null($offset)) ? $offset : 0;
        $count=$implementers->count()+$offset;
        $last=($total<=$count) ? true : false;
        
        $implementers=$implementers->map(function($implementer) {
            return array("profile" => env('APP_URL').'/implementers/'.$implementer->slug, "name" =>  $implementer->name, "lastname" =>  $implementer->lastname, "photo" => env('APP_URL').'/admins/img/users/'.$implementer->photo, "lat" => $implementer->lat, "lng" => $implementer->lng, "title" =>  $implementer->title, "ypo_chapter" =>  $implementer->ypo_chapter, "service_area" =>  $implementer->service_area, "address" =>  $implementer->address);
        });
        return response()->json(["data" => $implementers, "last" => $last]);
    }

    public function search(Request $request) {
        $implementers=User::with('implementer')->where('slug', 'LIKE', '%'.Str::slug(request('search'), '-').'%')->where('type', '2')->get()->map(function($implementer) {
            return array("profile" => env('APP_URL').'/implementers/'.$implementer->slug, "name" =>  $implementer->name, "lastname" =>  $implementer->lastname, "photo" => env('APP_URL').'/admins/img/users/'.$implementer->photo, "lat" => $implementer['implementer']->lat, "lng" => $implementer['implementer']->lng, "address" =>  $implementer['implementer']->address);
        });

        return response()->json(["data" => $implementers]);
    }
}
