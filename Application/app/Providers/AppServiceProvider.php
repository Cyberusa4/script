<?php

namespace App\Providers;

use App\Models\AdminNotification;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\FileEntry;
use App\Models\FileReport;
use App\Models\FooterMenu;
use App\Models\Language;
use App\Models\NavbarMenu;
use App\Models\Plan;
use App\Models\SeoConfiguration;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserNotification;
use Config;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if (env('VIRONEER_SYSTEMSTATUS')) {

            $this->app->bind('path.public', function () {
                return base_path() . '/../';
            });

            Paginator::useBootstrap();
            Config::set('laravellocalization.supportedLocales', getSupportedLocales());

            view()->composer('*', function ($view) {
                $view->with(['settings' => settings(), 'additionals' => additionals()]);
            });

            if (request()->segment(1) != "admin") {

                if (settings('website_force_ssl_status')) {
                    $this->app['request']->server->set('HTTPS', true);
                }

                view()->composer('*', function ($view) {
                    $languages = Language::all();
                    $view->with('languages', $languages);
                });

                view()->composer(['frontend.configurations.metaTags', 'frontend.home'], function ($view) {
                    $lang = LaravelLocalization::getCurrentLocale();
                    $SeoConfiguration = SeoConfiguration::where('lang', $lang)->with('language')->first();
                    $view->with('SeoConfiguration', $SeoConfiguration);
                });

                view()->composer(['frontend.filemanager.includes.sidebar', 'frontend.user.layouts.single'], function ($view) {
                    $countPlans = Plan::all()->count();
                    $trashedFileEntries = FileEntry::where('user_id', userAuthInfo()->id)->notExpired()->onlyTrashed()->count();
                    $view->with(['countPlans' => $countPlans, 'trashedFileEntries' => $trashedFileEntries]);
                });

                view()->composer(['frontend.global.includes.notification-menu', 'frontend.user.layouts.single'], function ($view) {
                    $userNotifications = UserNotification::where('user_id', userAuthInfo()->id)->orderbyDesc('id')->limit(20)->get();
                    $unreadUserNotifications = UserNotification::where([['status', 0], ['user_id', userAuthInfo()->id]])->get()->count();
                    $unreadUserNotificationsAll = $unreadUserNotifications;
                    if ($unreadUserNotifications > 9) {
                        $unreadUserNotifications = "9+";
                    }
                    $view->with([
                        'userNotifications' => $userNotifications,
                        'unreadUserNotifications' => $unreadUserNotifications,
                        'unreadUserNotificationsAll' => $unreadUserNotificationsAll,
                    ]);
                });

                view()->composer(['frontend.user.layouts.auth', 'frontend.user.layouts.single', 'frontend.includes.footer'], function ($view) {
                    $footerMenuLinks = FooterMenu::where('lang', getLang())->orderBy('sort_id', 'asc')->get();
                    $view->with('footerMenuLinks', $footerMenuLinks);
                });

                view()->composer('frontend.includes.navbar', function ($view) {
                    if (request()->routeIs('home')) {
                        $navbarLinks = NavbarMenu::where([['lang', getLang()], ['page', 0]])->orderBy('sort_id', 'asc')->get();
                    } else {
                        $navbarLinks = NavbarMenu::where([['lang', getLang()], ['page', 1]])->orderBy('sort_id', 'asc')->get();
                    }
                    $navbarMenuLinks = $navbarLinks;
                    $view->with('navbarMenuLinks', $navbarMenuLinks);
                });

                view()->composer('frontend.includes.blogSidebar', function ($view) {
                    $recentBlogArticles = BlogArticle::where('lang', getLang())->orderbyDesc('views')->limit(5)->get();
                    $blogCategories = BlogCategory::where('lang', getLang())->orderbyDesc('views')->limit(10)->get();
                    $view->with(['recentBlogArticles' => $recentBlogArticles, 'blogCategories' => $blogCategories]);
                });
            }

            if (request()->segment(1) == "admin") {

                view()->composer('*', function ($view) {
                    $adminLanguages = Language::all();
                    $view->with('adminLanguages', $adminLanguages);
                });

                view()->composer('backend.includes.header', function ($view) {
                    $adminNotifications = AdminNotification::orderbyDesc('id')->limit(20)->get();
                    $unreadAdminNotifications = AdminNotification::where('status', 0)->get()->count();
                    $unreadAdminNotificationsAll = $unreadAdminNotifications;
                    if ($unreadAdminNotifications > 9) {
                        $unreadAdminNotifications = "9+";
                    }
                    $view->with([
                        'adminNotifications' => $adminNotifications,
                        'unreadAdminNotifications' => $unreadAdminNotifications,
                        'unreadAdminNotificationsAll' => $unreadAdminNotificationsAll,
                    ]);
                });
                view()->composer('backend.includes.sidebar', function ($view) {
                    $unviewedUsersCount = User::where('admin_has_viewed', 0)->count();
                    $usersUnviewedUsersCount = FileEntry::where('admin_has_viewed', 0)->withTrashed()->userEntry()->notFolder()->notExpired()->count();
                    $guestsUnviewedUsersCount = FileEntry::where('admin_has_viewed', 0)->guestEntry()->notFolder()->notExpired()->count();
                    $unviewedFileReports = FileReport::where('admin_has_viewed', 0)->fileEntryActive()->count();
                    $commentsNeedsAction = BlogComment::where('status', 0)->get()->count();
                    $unviewedSubscriptions = Subscription::where('admin_has_viewed', 0)->count();
                    $unviewedTransactionsCount = Transaction::where('admin_has_viewed', 0)->whereIn('status', [2, 3])->count();
                    $view->with([
                        'unviewedUsersCount' => $unviewedUsersCount,
                        'usersUnviewedUsersCount' => $usersUnviewedUsersCount,
                        'guestsUnviewedUsersCount' => $guestsUnviewedUsersCount,
                        'unviewedFileReports' => $unviewedFileReports,
                        'commentsNeedsAction' => $commentsNeedsAction,
                        'unviewedSubscriptions' => $unviewedSubscriptions,
                        'unviewedTransactionsCount' => $unviewedTransactionsCount,
                    ]);
                });
            }
        }
    }
}
