<?php

namespace App\Http\Controllers;

use App\User;
use App\Implementer;
use App\Testimonial;
use App\Http\Requests\TestimonialStoreRequest;
use App\Http\Requests\TestimonialUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $testimonials=Testimonial::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.testimonials.index', compact('testimonials', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $implementers=User::where('type', '2')->get();
        return view('admin.testimonials.create', compact('implementers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialStoreRequest $request) {
        // Validación para que no se repita el slug
        $num=0;
        $slug=Str::slug("testimonial ".request('name'), '-');
        while (true) {
            $count=Testimonial::where('slug', $slug)->count();
            if ($count>0) {
                $slug=Str::slug("testimonial ".request('name')." ".$num, '-');
                $num++;
            } else {
                $implementer=User::where('slug', request('implementer_id'))->firstOrFail();
                $data=array('name' => request('name'), 'slug' => $slug, 'title' => request('title'), 'testimonial' => request('testimonial'), 'implementer_id' => $implementer->implementer->id);
                break;
            }
        }

        $testimonial=Testimonial::create($data);

        if ($testimonial) {
            return redirect()->route('testimonios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Save successful', 'msg' => 'The testimonial has been successfully registered.']);
        } else {
            return redirect()->route('testimonios.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Save failed', 'msg' => 'An error occurred durind the process, please try again.'])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $testimonial=Testimonial::where('slug', $slug)->firstOrFail();
        $implementers=User::where('type', '2')->get();
        return view('admin.testimonials.edit', compact("testimonial", "implementers"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonialUpdateRequest $request, $slug) {
        $testimonial=Testimonial::where('slug', $slug)->firstOrFail();
        $implementer=User::where('slug', request('implementer_id'))->firstOrFail();
        $data=array('name' => request('name'), 'title' => request('title'), 'testimonial' => request('testimonial'), 'implementer_id' => $implementer->implementer->id);

        $testimonial->fill($data)->save();

        if ($testimonial) {
            return redirect()->route('testimonios.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful edit', 'msg' => 'The testimonial has been edited successfully.']);
        } else {
            return redirect()->route('testimonios.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred durind the process, please try again.']);
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
        $testimonial=Testimonial::where('slug', $slug)->firstOrFail();
        $testimonial->delete();

        if ($testimonial) {
            return redirect()->route('testimonios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful removal', 'msg' => 'The testimonial has been successfully removed.']);
        } else {
            return redirect()->route('testimonios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed deletion', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }

    public function deactivate(Request $request, $slug) {
        $testimonial=Testimonial::where('slug', $slug)->firstOrFail();
        $testimonial->fill(['state' => "0"])->save();

        if ($testimonial) {
            return redirect()->route('testimonios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful edit', 'msg' => 'The testimonial has been successfully deactivated.']);
        } else {
            return redirect()->route('testimonios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }

    public function activate(Request $request, $slug) {
        $testimonial=Testimonial::where('slug', $slug)->firstOrFail();
        $testimonial->fill(['state' => "1"])->save();

        if ($testimonial) {
            return redirect()->route('testimonios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful edit', 'msg' => 'The testimonial has been activated successfully.']);
        } else {
            return redirect()->route('testimonios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }
}
