<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Auth;
use Illuminate\Http\Request;
use Validator;

class BlogController extends Controller
{
    public function index(Request $request, $slug = null)
    {
        $blogCategory = null;
        if ($request->has('q')) {
            $q = $request->q;
            $blogArticles = BlogArticle::where([['title', 'like', '%' . $q . '%'], ['lang', getLang()]])
                ->OrWhere([['slug', 'like', '%' . $q . '%'], ['lang', getLang()]])
                ->OrWhere([['content', 'like', '%' . $q . '%'], ['lang', getLang()]])
                ->OrWhere([['short_description', 'like', '%' . $q . '%'], ['lang', getLang()]])
                ->with(['blogCategory', 'admin'])
                ->withCount(['comments' => function ($query) {
                    $query->where('status', 1);
                }])->orderbyDesc('id')->get();
        } elseif ($request->segment(3) == "category") {
            $blogCategory = BlogCategory::where([['lang', getLang()], ['slug', $slug]])->first();
            if ($blogCategory) {
                $blogCategory->increment('views');
                $blogArticles = BlogArticle::where([['lang', getLang()], ['category_id', $blogCategory->id]])->with(['blogCategory', 'admin'])->withCount(['comments' => function ($query) {
                    $query->where('status', 1);
                }])->orderbyDesc('id')->paginate(5);
                $blogCategory = $blogCategory->name;
            } else {
                return redirect()->route('blog.index');
            }
        } else {
            $blogArticles = BlogArticle::where('lang', getLang())->with(['blogCategory', 'admin'])->withCount(['comments' => function ($query) {
                $query->where('status', 1);
            }])->orderbyDesc('id')->paginate(5);
        }
        return view('frontend.blog.index', ['blogArticles' => $blogArticles, 'blogCategory' => $blogCategory]);
    }

    public function article($slug)
    {
        $blogArticle = BlogArticle::where([['lang', getLang()], ['slug', $slug]])->with(['blogCategory', 'admin'])->first();
        if ($blogArticle) {
            $blogArticle->increment('views');
            $blogArticleComments = BlogComment::where([['article_id', $blogArticle->id], ['status', 1]])->get();
            return view('frontend.blog.article', ['blogArticle' => $blogArticle, 'blogArticleComments' => $blogArticleComments]);
        } else {
            return redirect()->route('blog.index');
        }
    }

    public function comment(Request $request, $slug)
    {
        if (!Auth::check()) {
            toastr()->error(lang('Login is required to post comments', 'alerts'));
            return back();
        }
        $blogArticle = BlogArticle::where([['lang', getLang()], ['slug', $slug]])->first();
        if (is_null($blogArticle)) {
            toastr()->error(lang('Article not exists', 'alerts'));
            return back();
        }
        $validator = Validator::make($request->all(), [
            'comment' => ['required', 'string'],
            'g-recaptcha-response' => ['sometimes', 'required', 'captcha'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        $createComment = BlogComment::create([
            'user_id' => userAuthInfo()->id,
            'article_id' => $blogArticle->id,
            'comment' => $request->comment,
        ]);
        if ($createComment) {
            $title = __('New comment waiting review');
            $image = asset('images/icons/comment.png');
            $link = route('comments.index');
            adminNotify($title, $image, $link);
            toastr()->success(lang('Your comment is under review it will be published soon', 'alerts'));
            return back();
        }
    }
}
