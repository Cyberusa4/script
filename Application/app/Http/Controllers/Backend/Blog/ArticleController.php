<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\Language;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('lang')) {
            $language = Language::where('code', $request->lang)->firstOrFail();
            $articles = BlogArticle::where('lang', $language->code)->with(['blogCategory', 'admin'])->withCount('comments')->get();
            return view('backend.blog.articles.index', ['articles' => $articles, 'active' => $language->name]);
        } else {
            return redirect(url()->current() . '?lang=' . env('DEFAULT_LANGUAGE'));
        }
    }

    /**
     * Create a blog article slug using ajax request
     *
     * @return \Illuminate\Http\Response
     */
    public function slug(Request $request)
    {

        $slug = null;
        if ($request->content != null) {
            $slug = SlugService::createSlug(BlogArticle::class, 'slug', $request->content);
        }
        return response()->json(['slug' => $slug]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BlogCategory::orderbyDesc('id')->get();
        return view('backend.blog.articles.create', ['categories' => $categories]);
    }

    /**
     * Get categories by lang
     *
     * @return \Illuminate\Http\Response as JSON
     */
    public function getCategories($lang)
    {
        $categories = BlogCategory::where('lang', $lang)->pluck("name", "id");
        if ($categories->count() > 0) {
            return response()->json($categories);
        } else {
            return response()->json(['info' => __('No categories on this language')]);
        }
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
            'lang' => ['required', 'string', 'max:3'],
            'title' => ['required', 'string', 'max:255', 'min:2'],
            'slug' => ['required', 'unique:blog_articles', 'alpha_dash'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'category' => ['required', 'numeric'],
            'content' => ['required'],
            'short_description' => ['required', 'string', 'max:200', 'min:2'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        $category = BlogCategory::where('id', $request->category)->first();
        if ($category == null) {
            toastr()->error(__('Something went wrong please try again'));
            return back();
        }
        $lang = Language::where('code', $request->lang)->first();
        if ($lang == null) {
            toastr()->error(__('Language not exists'));
            return back();
        }
        if ($category->lang != $lang->code) {
            toastr()->error(__('Category and article must be in the same language'));
            return back();
        }
        $uploadImage = vImageUpload($request->file('image'), 'images/blog/articles/', '900x450');
        if ($uploadImage) {
            $create = BlogArticle::create([
                'lang' => $lang->code,
                'admin_id' => adminAuthInfo()->id,
                'title' => $request->title,
                'slug' => SlugService::createSlug(BlogArticle::class, 'slug', $request->title),
                'image' => $uploadImage,
                'category_id' => $category->id,
                'content' => $request->content,
                'short_description' => $request->short_description,
            ]);
            if ($create) {
                toastr()->success(__('Created Successfully'));
                return redirect(route('articles.index') . '?lang=' . $create->lang);
            }
        } else {
            toastr()->error(__('Upload error'));
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogArticle  $article
     * @return \Illuminate\Http\Response
     */
    public function show(BlogArticle $article)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogArticle  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogArticle $article)
    {
        $categories = BlogCategory::where('lang', $article->lang)->orderbyDesc('id')->get();
        return view('backend.blog.articles.edit', ['article' => $article, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogArticle  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogArticle $article)
    {
        $validator = Validator::make($request->all(), [
            'lang' => ['required', 'string', 'max:3'],
            'title' => ['required', 'string', 'max:255', 'min:2'],
            'slug' => ['required', 'alpha_dash', 'unique:blog_articles,slug,' . $article->id],
            'image' => ['mimes:png,jpg,jpeg', 'max:2048'],
            'category' => ['required', 'numeric'],
            'content' => ['required'],
            'short_description' => ['required', 'string', 'max:200', 'min:2'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back();
        }
        $category = BlogCategory::where('id', $request->category)->first();
        if ($category == null) {
            toastr()->error(__('Something went wrong please try again'));
            return back();
        }
        $lang = Language::where('code', $request->lang)->first();
        if ($lang == null) {
            toastr()->error(__('Language not exists'));
            return back();
        }
        if ($category->lang != $lang->code) {
            toastr()->error(__('Category and article must be in the same language'));
            return back();
        }
        if ($request->has('image')) {
            $uploadImage = vImageUpload($request->file('image'), 'images/blog/articles/', '900x450', null, $article->image);
        } else {
            $uploadImage = $article->image;
        }
        if ($uploadImage) {
            $update = $article->update([
                'lang' => $lang->code,
                'title' => $request->title,
                'slug' => $request->slug,
                'image' => $uploadImage,
                'category_id' => $category->id,
                'content' => $request->content,
                'short_description' => $request->short_description,
            ]);
            if ($update) {
                toastr()->success(__('Updated Successfully'));
                return back();
            }
        } else {
            toastr()->error(__('Upload error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogArticle  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogArticle $article)
    {
        removeFile($article->image);
        $article->delete();
        toastr()->success(__('Deleted Successfully'));
        return back();
    }
}
