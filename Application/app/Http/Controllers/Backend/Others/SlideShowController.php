<?php

namespace App\Http\Controllers\Backend\Others;

use App\Http\Controllers\Controller;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use Validator;

class SlideShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slideshows = Slideshow::all();
        return view('backend.others.slideshow.index', ['slideshows' => $slideshows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.others.slideshow.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'integer', 'min:1', 'max:2'],
            'source' => ['required', 'integer', 'min:1', 'max:2'],
            'duration' => ['required', 'integer', 'min:1', 'max:100'],
            'file' => ['required'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        if ($request->source == 1) {
            $file = $request->file('file');
            $fileType = $file->getClientOriginalExtension();
            if ($request->type == 1) {
                $allowedTypes = ['jpg', 'jpeg', 'png'];
            } elseif ($request->type == 2) {
                $allowedTypes = ['mp4', 'webm'];
            } else {
                toastr()->error(__('Slide show type error'));
                return back();
            }
            if (!in_array($fileType, $allowedTypes)) {
                toastr()->error(__('File type not allowed'));
                return back();
            }
            $request->file = ($fileType == "mp4" or $fileType == "webm") ? vFileUpload($file, 'uploads/slideshow/') : vImageUpload($file, 'uploads/slideshow/', '2560x1600');
        } elseif ($request->source == 2) {
            if (filter_var($request->file, FILTER_VALIDATE_URL) === false) {
                toastr()->error(__('Invalid source URL'));
                return back();
            }
        } else {
            toastr()->error(__('Invalid source'));
            return back();
        }
        $create = Slideshow::create([
            'type' => $request->type,
            'source' => $request->source,
            'file' => $request->file,
            'duration' => $request->duration,
        ]);
        if ($create) {
            toastr()->success(__('Created Successfully'));
            return redirect()->route('admin.slideshow.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function show(Slideshow $slideshow)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function edit(Slideshow $slideshow)
    {
        return view('backend.others.slideshow.edit', ['slideshow' => $slideshow]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slideshow $slideshow)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'integer', 'min:1', 'max:2'],
            'source' => ['required', 'integer', 'min:1', 'max:2'],
            'duration' => ['required', 'integer', 'min:1', 'max:100'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        if ($request->source == 1) {
            if ($request->has('file') && !is_null($request->file)) {
                $file = $request->file('file');
                $fileType = $file->getClientOriginalExtension();
                if ($request->type == 1) {
                    $allowedTypes = ['jpg', 'jpeg', 'png'];
                } elseif ($request->type == 2) {
                    $allowedTypes = ['mp4', 'webm'];
                } else {
                    toastr()->error(__('Slide show type error'));
                    return back();
                }
                if (!in_array($fileType, $allowedTypes)) {
                    toastr()->error(__('Invalid file type'));
                    return back();
                }
                if ($fileType == "mp4" || $fileType == "webm") {
                    $request->file = vFileUpload($file, 'uploads/slideshow/', null, $slideshow->file);
                } else {
                    $request->file = vImageUpload($file, 'uploads/slideshow/', '2560x1600', null, $slideshow->file);
                }
            } else {
                $request->file = $slideshow->file;
            }
        } elseif ($request->source == 2) {
            if ($request->has('file') && !is_null($request->file)) {
                if (filter_var($request->file, FILTER_VALIDATE_URL) === false) {
                    toastr()->error(__('Invalid source URL'));
                    return back();
                }
                if ($slideshow->source == 1) {
                    removeFile($slideshow->file);
                }
            } else {
                $request->file = $slideshow->file;
            }
        } else {
            toastr()->error(__('Invalid source'));
            return back();
        }
        $update = $slideshow->update([
            'type' => $request->type,
            'source' => $request->source,
            'file' => $request->file,
            'duration' => $request->duration,
        ]);
        if ($update) {
            toastr()->success(__('Updated Successfully'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slideshow $slideshow)
    {
        if ($slideshow->source == 1) {
            removeFile($slideshow->file);
        }
        $slideshow->delete();
        toastr()->success(__('Deleted Successfully'));
        return back();
    }
}
