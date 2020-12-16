<?php

namespace App\Http\Controllers;

use App\Task;
use App\Available;
use App\Education;
use App\Province;
use App\Locality;
use App\People;
use App\Caretaker;
use App\CaretakerTask;
use App\Http\Requests\CaretakerStoreRequest;
use App\Http\Requests\CaretakerUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CaretakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $caretakers=People::where('type', 1)->orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.caretakers.index', compact('caretakers', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $provinces=Province::orderBy('name', 'ASC')->get();
        $tasks=Task::orderBy('id', 'DESC')->get();
        $availables=Available::orderBy('id', 'DESC')->get();
        $educations=Education::orderBy('id', 'DESC')->get();
        return view('admin.caretakers.create', compact('provinces', 'tasks', 'availables', 'educations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CaretakerStoreRequest $request) {
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

        $people=People::create($data);
        $caretaker=Caretaker::create(['people_id' => $people->id]);

        foreach (request('task_id') as $task_slug) {
            $task=Task::where('slug', $task_slug)->first();
            if (!is_null($task)) {
                CaretakerTask::create(['caretaker_id' => $caretaker->id, 'task_id' => $task->id]);
            }
        }

        if ($caretaker) {
            return redirect()->route('cuidadores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El cuidador ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('cuidadores.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
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
        return view('admin.caretakers.show', compact('people'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $people=People::where('slug', $slug)->firstOrFail();
        $provinces=Province::orderBy('name', 'ASC')->get();
        $localities=(!is_null($people->locality()->withTrashed()->first())) ? Locality::where('province_id', $people->locality()->withTrashed()->first()->province_id)->orderBy('name', 'ASC')->get() : [] ;
        $tasks=Task::orderBy('id', 'DESC')->get();
        $availables=Available::orderBy('id', 'DESC')->get();
        $educations=Education::orderBy('id', 'DESC')->get();
        return view('admin.caretakers.edit', compact("people", "provinces", "localities", "tasks", "availables", "educations"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CaretakerUpdateRequest $request, $slug) {
        $people=People::where('slug', $slug)->firstOrFail();
        $locality=Locality::where('id', request('locality_id'))->firstOrFail();
        $education=Education::where('slug', request('education_id'))->firstOrFail();
        $available=Available::where('slug', request('available_id'))->firstOrFail();
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
            return redirect()->route('cuidadores.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El cuidador ha sido editado exitosamente.']);
        } else {
            return redirect()->route('cuidadores.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
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
        $caretaker=People::where('slug', $slug)->firstOrFail();
        $caretaker->delete();

        if ($caretaker) {
            return redirect()->route('cuidadores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El cuidador ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('cuidadores.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $caretaker=People::where('slug', $slug)->firstOrFail();
        $caretaker->fill(['state' => "0"])->save();

        if ($caretaker) {
            return redirect()->route('cuidadores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El cuidador ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('cuidadores.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {
        $caretaker=People::where('slug', $slug)->firstOrFail();
        $caretaker->fill(['state' => "1"])->save();

        if ($caretaker) {
            return redirect()->route('cuidadores.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El cuidador ha sido activado exitosamente.']);
        } else {
            return redirect()->route('cuidadores.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
