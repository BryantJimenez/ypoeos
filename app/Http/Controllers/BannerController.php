<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\BannerStoreRequest;
use App\Http\Requests\BannerUpdateRequest;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $banners=Banner::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.banners.index', compact('banners', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerStoreRequest $request)
    {
        // Validación para que no se repita el slug
        $slug="banner";
        $num=0;
        while (true) {
            $count2=Banner::where('slug', $slug)->count();
            if ($count2>0) {
                $slug="banner-".$num;
                $num++;
            } else {
                if (request('button')==1) {
                    $pre_url=request('pre_url');
                    $url=str_replace(['https://', 'http://'], "", request('url'));
                    if (!empty(request('target'))) {
                        $target=request('target');
                    } else {
                        $target="0";
                    }
                } else {
                    $pre_url=NULL;
                    $target="0";
                    $url=NULL;
                }
                $data=array('title' => request('title'), 'slug' => $slug, 'text' => request('text'), 'button' => request('button'), 'button_text' => request('button_text'), 'pre_url' => $pre_url, 'url' => $url, 'target' => $target, 'state' => request('state'));
                break;
            }
        }

        // Mover imagen a carpeta banners y extraer nombre
        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $data['image']=store_files($file, $slug, '/admins/img/banners/');
        }

        $banner=Banner::create($data);

        if ($banner) {
            return redirect()->route('banners.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Save successful', 'msg' => 'The banner has been successfully registered.']);
        } else {
            return redirect()->route('banners.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Save failed', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $banner=Banner::where('slug', $slug)->firstOrFail();
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(BannerUpdateRequest $request, $slug) {

        $banner=Banner::where('slug', $slug)->firstOrFail();
        if (request('button')==1) {
            $pre_url=request('pre_url');
            $url=str_replace(['https://', 'http://'], "", request('url'));
            if (!empty(request('target'))) {
                $target=request('target');
            } else {
                $target="0";
            }
        } else {
            $pre_url=NULL;
            $target="0";
            $url=NULL;
        }

        $data=array('title' => request('title'), 'slug' => $slug, 'text' => request('text'), 'button' => request('button'), 'button_text' => request('button_text'), 'pre_url' => $pre_url, 'url' => $url, 'target' => $target, 'state' => request('state'));

        // Mover imagen a carpeta banners y extraer nombre
        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $data['image']=store_files($file, $slug, '/admins/img/banners/');
        }

        $banner->fill($data)->save();

        if ($banner) {
            return redirect()->route('banners.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful edit', 'msg' => 'The banner has been edited successfully.']);
        } else {
            return redirect()->route('banners.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }

    public function destroy($slug)
    {
        $banner=Banner::where('slug', $slug)->firstOrFail();
        $banner->delete();

        if ($banner) {
            return redirect()->route('banners.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful removal', 'msg' => 'The banner has been successfully removed.']);
        } else {
            return redirect()->route('banners.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed deletion', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $banner = Banner::where('slug', $slug)->firstOrFail();
        $banner->fill(['state' => "0"])->save();

        if ($banner) {
            return redirect()->route('banners.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful edit', 'msg' => 'The banner has been successfully deactivated.']);
        } else {
            return redirect()->route('banners.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }

    public function activate(Request $request, $slug) {
        $banner = Banner::where('slug', $slug)->firstOrFail();
        $banner->fill(['state' => "1"])->save();

        if ($banner) {
            return redirect()->route('banners.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful edit', 'msg' => 'The banner has been activated successfully.']);
        } else {
            return redirect()->route('banners.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }
}
