<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SeoController extends Controller
{
    public function index()
    {
        $seo = Seo::all();
        return view('admin.seo.index', compact('seo'));
    }

    public function create()
    {
        return view('admin.seo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string|max:255',
            'page_title' => 'required|string|max:255',
            'seo_title' => 'required|string|max:255',
            'locale' => 'nullable|string|max:10',
            'page_type' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'site_name' => 'nullable|string|max:255',
            'ogimage' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp',
            'twitter_card' => 'nullable|string|max:255',
            'twitter_site' => 'nullable|string|max:255',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string',
            'twitter_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp',
            // 'short_slug' => 'nullable|string|max:255',
        ]);

        $seo = new Seo;

        // Upload OG image (field name: ogimage)
        if ($request->hasFile('ogimage')) {
            $file = $request->file('ogimage');
            $imageName = 'og-' . time() . '.' . $file->extension();
            $file->move(public_path('uploads/seo'), $imageName);
            $seo->ogimage = $imageName;
        }

        // Upload Twitter image
        if ($request->hasFile('twitter_image')) {
            $file = $request->file('twitter_image');
            $twitterImageName = 'twitter-' . time() . '.' . $file->extension();
            $file->move(public_path('uploads/seo'), $twitterImageName);
            $seo->twitter_image = $twitterImageName;
        }

        $page_slug = Str::slug($request['meta_title']);
        $seo->meta_title = $request['meta_title'];
        $seo->page_slug = $page_slug;
        $seo->meta_description = $request['meta_description'];
        $seo->meta_keyword = $request['meta_keyword'];
        $seo->page_title = $request['page_title'];
        $seo->seo_title = $request['seo_title'];
        $seo->locale = $request['locale'];
        $seo->page_type = $request['page_type'];
        $seo->type = $request['type'];
        $seo->url = $request['url'];
        $seo->site_name = $request['site_name'];
        $seo->twitter_card = $request['twitter_card'];
        $seo->twitter_site = $request['twitter_site'];
        $seo->twitter_title = $request['twitter_title'];
        $seo->twitter_description = $request['twitter_description'];

        $seo->save();

        return redirect('seo')->with('success', 'SEO entry created successfully.');
    }

    public function edit($id)
    {
        $seo = Seo::findOrFail($id);
        return view('admin.seo.edit', compact('seo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string|max:255',
            'page_title' => 'required|string|max:255',
            'seo_title' => 'required|string|max:255',
            'locale' => 'nullable|string|max:10',
            'page_type' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'site_name' => 'nullable|string|max:255',
            'ogimage' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp',
            'twitter_card' => 'nullable|string|max:255',
            'twitter_site' => 'nullable|string|max:255',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string',
            'twitter_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp',
            // 'short_slug' => 'nullable|string|max:255',
        ]);

        $seo = Seo::find($id);

        // Upload/replace OG image
        if ($request->hasFile('ogimage')) {
            // delete old file if exists
            if ($seo->ogimage) {
                $oldPath = public_path('uploads/seo/' . $seo->ogimage);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $file = $request->file('ogimage');
            $imageName = 'og-' . time() . '.' . $file->extension();
            $file->move(public_path('uploads/seo'), $imageName);
            $seo->ogimage = $imageName;
        }

        // Upload/replace Twitter image
        if ($request->hasFile('twitter_image')) {
            if ($seo->twitter_image) {
                $oldPath = public_path('uploads/seo/' . $seo->twitter_image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $file = $request->file('twitter_image');
            $twitterImageName = 'twitter-' . time() . '.' . $file->extension();
            $file->move(public_path('uploads/seo'), $twitterImageName);
            $seo->twitter_image = $twitterImageName;
        }

        $page_slug = Str::slug($request['meta_title']);
        $seo->meta_title = $request['meta_title'];
        $seo->page_slug = $page_slug;
        $seo->meta_description = $request['meta_description'];
        $seo->meta_keyword = $request['meta_keyword'];
        $seo->page_title = $request['page_title'];
        $seo->seo_title = $request['seo_title'];
        $seo->locale = $request['locale'];
        $seo->page_type = $request['page_type'];
        $seo->type = $request['type'];
        $seo->url = $request['url'];
        $seo->site_name = $request['site_name'];
        $seo->twitter_card = $request['twitter_card'];
        $seo->twitter_site = $request['twitter_site'];
        $seo->twitter_title = $request['twitter_title'];
        $seo->twitter_description = $request['twitter_description'];

        $seo->save();

        return redirect('seo')->with('success', 'SEO entry updated successfully.');
    }

    public function destroy($id)
    {

        $seo = Seo::find($id);
        if ($seo->og_image && File::exists(public_path($seo->og_image))) {
            File::delete(public_path($seo->og_image));
        }
        if ($seo->twitter_image && File::exists(public_path($seo->twitter_image))) {
            File::delete(public_path($seo->twitter_image));
        }

        $seo->delete();
        return redirect('seo')->with('success', 'SEO entry deleted successfully');
    }
}
