<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Image;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $pageTitle = 'Global Settings';
        $timezones = json_decode(file_get_contents(resource_path('views/admin/components/timezone.json')));
        return view('admin.setting.general', compact('pageTitle','timezones'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:40',
            'cur_text' => 'required|string|max:40',
            'cur_sym' => 'required|string|max:40',
            'base_color' => 'nullable', 'regex:/^[a-f0-9]{6}$/i',
            'theme_two_base_color' => 'nullable', 'regex:/^[a-f0-9]{6}$/i',
            'theme_three_base_color' => 'nullable', 'regex:/^[a-f0-9]{6}$/i',
            'theme_four_base_color' => 'nullable', 'regex:/^[a-f0-9]{6}$/i',
            'theme_five_base_color' => 'nullable', 'regex:/^[a-f0-9]{6}$/i',
            'theme_five_secondary_color' => 'nullable', 'regex:/^[a-f0-9]{6}$/i',
            'timezone' => 'required',
        ]);

        $general = GeneralSetting::first();
        $general->site_name = $request->site_name;
        $general->cur_text = $request->cur_text;
        $general->cur_sym = $request->cur_sym;

        $general->base_color = $request->base_color??$general->base_color;
        $general->theme_two_base_color = $request->theme_two_base_color??$general->theme_two_base_color;
        $general->theme_three_base_color = $request->theme_three_base_color??$general->theme_three_base_color;
        $general->theme_four_base_color = $request->theme_four_base_color??$general->theme_four_base_color;

        $general->theme_five_base_color = $request->theme_five_base_color??$general->theme_five_base_color;
        $general->theme_five_secondary_color = $request->theme_five_secondary_color??$general->theme_five_secondary_color;


        $general->kv = $request->kv ? 1 : 0;
        $general->ev = $request->ev ? 1 : 0;
        $general->en = $request->en ? 1 : 0;
        $general->sv = $request->sv ? 1 : 0;
        $general->sn = $request->sn ? 1 : 0;
        $general->force_ssl = $request->force_ssl ? 1 : 0;
        $general->secure_password = $request->secure_password ? 1 : 0;
        $general->registration = $request->registration ? 1 : 0;
        $general->agree = $request->agree ? 1 : 0;
        $general->rtl = $request->rtl;
        $general->save();

        $timezoneFile = config_path('timezone.php');
        $content = '<?php $timezone = '.$request->timezone.' ?>';
        file_put_contents($timezoneFile, $content);
        $notify[] = ['success', 'General Settings has been updated successfully'];
        return back()->withNotify($notify);
    }

    public function logoIcon()
    {
        $pageTitle = 'Logo & Favicon';
        return view('admin.setting.logo_icon', compact('pageTitle'));
    }

    public function logoIconUpdate(Request $request)
    {
        $request->validate([
            'logo' => ['image',new FileTypeValidate(['jpg','jpeg','png'])],
            'favicon' => ['image',new FileTypeValidate(['png'])],
        ]);
        if ($request->hasFile('logo')) {
            try {
                $path = getFilePath('logoIcon');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->logo)->save($path . '/logo.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the logo'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('logo_white')) {
            try {
                $path = getFilePath('logoIcon');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->logo_white)->save($path . '/logo_white.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the logo'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('favicon')) {
            try {
                $path = getFilePath('logoIcon');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                $size = explode('x', getFileSize('favicon'));
                Image::make($request->favicon)->resize($size[0], $size[1])->save($path . '/favicon.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the favicon'];
                return back()->withNotify($notify);
            }
        }
        $notify[] = ['success', 'Logo & favicon has been updated successfully'];
        return back()->withNotify($notify);
    }

}
