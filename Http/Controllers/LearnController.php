<?php

namespace Modules\Learn\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Learn\Entities\Learn;

class LearnController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $items = Learn::all();

        return view('learn::index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('learn::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $learn = Learn::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'slug' => $request->slug,
                'short_text' => $request->short_text,
                'type' => $request->type,
                'body' => $request->body,
                'image' => (isset($request->image)?file_store($request->image, 'assets/uploads/learns/images/','photo_'):null),
                'video' => (isset($request->video)?file_store($request->video, 'assets/uploads/learns/videos/','video_'):null)
            ]);

            return redirect()->route('learn.index')->with('flash_message', 'با موفقیت ثبت شد');
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('learn::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Learn $learn)
    {
        return view('learn::edit', compact('learn'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Learn $learn)
    {
        try {
            $learn->title = $request->title;
            $learn->slug = $request->slug;
            $learn->short_text = $request->short_text;
            $learn->type = $request->type;
            $learn->body = $request->body;
            if (isset($request->image)) {
                $learn->image = file_store($request->image, 'assets/uploads/learn/images/', 'photo_');
            }
            if (isset($request->video)) {
                $learn->video = file_store($request->video, 'assets/uploads/learn/videos/', 'video_');
            }
            $learn->save();

            return redirect()->route('learn.index')->with('flash_message', 'با موفقیت بروزرسانی شد');
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Learn $learn)
    {
        try {
            $learn->delete();

            return redirect()->back()->with('flash_message', 'با موفقیت حذف شد');
        }catch (\Exception $e){
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }
}
