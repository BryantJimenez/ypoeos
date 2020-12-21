<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Http\Requests\SettingUpdateRequest;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit() {
        $setting=Setting::where('id', 1)->firstOrFail();
        return view('admin.settings.edit', compact("setting"));
    }

    public function update(SettingUpdateRequest $request) {
        $setting=Setting::where('id', 1)->firstOrFail();
        $setting->fill($request->all())->save();

        if ($setting) {
            return redirect()->route('ajustes.edit')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful edit', 'msg' => 'The settings has been edited successfully.']);
        } else {
            return redirect()->route('ajustes.edit')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred durind the process, please try again.']);
        }
    }
}
