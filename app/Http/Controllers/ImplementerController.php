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
        $implementers=User::where('type', 2)->orderBy('id', 'DESC')->get();
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
    public function store(CaretakerStoreRequest $request) {
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
                $locality=Locality::where('id', request('locality_id'))->firstOrFail();
                $education=Education::where('slug', request('education_id'))->firstOrFail();
                $available=Available::where('slug', request('available_id'))->firstOrFail();
                $data=array('name' => request('name'), 'lastname' => request('lastname'), 'slug' => $slug, 'birthday' => date('Y-m-d', strtotime(request('birthday'))), 'email' => request('email'), 'password' => Hash::make(request('password')), 'locality_id' => $locality->id, 'education_id' => $education->id, 'available_id' => $available->id);
                break;
            }
        }

        // Mover imagen a carpeta users y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $data['photo']=store_files($file, $slug, '/admins/img/users/');
        }

        $people=User::create($data);
        $implementer=Caretaker::create(['people_id' => $people->id]);

        foreach (request('task_id') as $task_slug) {
            $task=Task::where('slug', $task_slug)->first();
            if (!is_null($task)) {
                CaretakerTask::create(['caretaker_id' => $implementer->id, 'task_id' => $task->id]);
            }
        }

        if ($implementer) {
            return redirect()->route('implementadores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El implementador ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('implementadores.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        $people=People::where('slug', $slug)->firstOrFail();
        return view('admin.implementers.show', compact('people'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $people=People::where('slug', $slug)->firstOrFail();
        return view('admin.implementers.edit', compact("people"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImplementerUpdateRequest $request, $slug) {
        $people=User::where('slug', $slug)->firstOrFail();
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'birthday' => date('Y-m-d', strtotime(request('birthday'))), 'locality_id' => $locality->id, 'education_id' => $education->id, 'available_id' => $available->id);

        // Mover imagen a carpeta users y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $data['photo']=store_files($file, $slug, '/admins/img/users/');
        }

        $people->fill($data)->save();

        CaretakerTask::where('caretaker_id', $people->caretaker->id)->delete();
        foreach (request('task_id') as $task_slug) {
            $task=Task::where('slug', $task_slug)->first();
            if (!is_null($task)) {
                CaretakerTask::create(['caretaker_id' => $people->caretaker->id, 'task_id' => $task->id]);
            }
        }

        if ($people) {
            return redirect()->route('implementadores.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El implementador ha sido editado exitosamente.']);
        } else {
            return redirect()->route('implementadores.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
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
        $implementer=User::where('slug', $slug)->firstOrFail();
        $implementer->delete();

        if ($implementer) {
            return redirect()->route('implementadores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El implementador ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('implementadores.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $implementer=User::where('slug', $slug)->firstOrFail();
        $implementer->fill(['state' => "0"])->save();

        if ($implementer) {
            return redirect()->route('implementadores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El implementador ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('implementadores.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {
        $implementer=User::where('slug', $slug)->firstOrFail();
        $implementer->fill(['state' => "1"])->save();

        if ($implementer) {
            return redirect()->route('implementadores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El implementador ha sido activado exitosamente.']);
        } else {
            return redirect()->route('implementadores.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
