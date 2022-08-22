<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
 */

Route::group(['middleware' => 'notInstalled', 'prefix' => 'admin', 'namespace' => 'Backend'], function () {
    Route::name('admin.')->namespace('Auth')->group(function () {
        Route::get('/', 'LoginController@redirectToLogin')->name('index');
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login.store');
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'ForgotPasswordController@sendResetLinkEmail');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.link');
        Route::post('password/reset/change', 'ResetPasswordController@reset')->name('password.reset.change');
        Route::post('logout', 'LoginController@logout')->name('logout');
    });
    Route::group(['middleware' => 'admin'], function () {
        Route::name('admin.')->middleware('demo')->group(function () {
            Route::prefix('dashboard')->group(function () {
                Route::get('/', 'DashboardController@index')->name('dashboard');
                Route::get('charts/users', 'DashboardController@usersChartData')->middleware('ajax.only');
                Route::get('charts/uploads', 'DashboardController@uploadsChartData')->middleware('ajax.only');
                Route::get('charts/earnings', 'DashboardController@earningsChartData')->middleware(['saas', 'ajax.only']);
            });
            Route::name('notifications.')->prefix('notifications')->group(function () {
                Route::get('/', 'NotificationController@index')->name('index');
                Route::get('view/{id}', 'NotificationController@view')->name('view');
                Route::get('readall', 'NotificationController@readAll')->name('readall');
                Route::delete('deleteallread', 'NotificationController@deleteAllRead')->name('deleteallread');
            });
            Route::name('users.')->prefix('users')->group(function () {
                Route::post('{id}/edit/change/avatar', 'UserController@changeAvatar');
                Route::delete('{id}/edit/delete/avatar', 'UserController@deleteAvatar')->name('deleteAvatar');
                Route::get('{id}/edit/logs', 'UserController@logs')->name('logs');
                Route::get('{id}/edit/logs/get/{log_id}', 'UserController@getLogs')->middleware('ajax.only');
                Route::post('{id}/edit/sentmail', 'UserController@sendMail')->name('sendmail');
                Route::get('logs/{ip}', 'UserController@logsByIp')->name('logsbyip');
            });
            Route::resource('users', 'UserController');
            Route::name('uploads.')->namespace('Uploads')->prefix('uploads')->group(function () {
                Route::get('secure/{id}', 'SecureUploadController@index')->name('secure');
                Route::name('users.')->prefix('users')->group(function () {
                    Route::get('/', 'UserUploadsController@index')->name('index');
                    Route::get('{shared_id}/view', 'UserUploadsController@view')->name('view');
                    Route::get('{shared_id}/download', 'UserUploadsController@downloadFile')->name('download');
                    Route::delete('{shared_id}/delete', 'UserUploadsController@destroy')->name('destroy');
                    Route::post('delete-selected', 'UserUploadsController@destroySelected')->name('destroy.selected');
                });
                Route::name('guests.')->prefix('guests')->group(function () {
                    Route::get('/', 'GuestUploadsController@index')->name('index');
                    Route::get('{shared_id}/view', 'GuestUploadsController@view')->name('view');
                    Route::get('{shared_id}/download', 'GuestUploadsController@downloadFile')->name('download');
                    Route::delete('{shared_id}', 'GuestUploadsController@destroy')->name('destroy');
                    Route::post('delete-selected', 'GuestUploadsController@destroySelected')->name('destroy.selected');
                });
            });
            Route::name('reports.')->prefix('reports')->group(function () {
                Route::get('/', 'FileReportController@index')->name('index');
                Route::get('{id}/view', 'FileReportController@view')->name('view');
                Route::post('{id}/view', 'FileReportController@markAsReviewed')->name('markAsReviewed');
                Route::delete('{id}/delete', 'FileReportController@destroy')->name('destroy');
            });
            Route::middleware('saas')->group(function () {
                Route::resource('subscriptions', 'SubscriptionController');
                Route::resource('transactions', 'TransactionController');
                Route::resource('plans', 'PlanController');
                Route::resource('coupons', 'CouponController');
            });
            Route::get('advertisements', 'AdvertisementController@index')->name('advertisements.index');
            Route::get('advertisements/{id}/edit', 'AdvertisementController@edit')->name('advertisements.edit');
            Route::post('advertisements/{id}', 'AdvertisementController@update')->name('advertisements.update');
        });
        Route::prefix('navigation')->namespace('Navigation')->name('admin.')->middleware('demo')->group(function () {
            Route::post('navbarMenu/sort', 'NavbarMenuController@sort')->name('navbarMenu.sort');
            Route::resource('navbarMenu', 'NavbarMenuController');
            Route::post('footerMenu/sort', 'FooterMenuController@sort')->name('footerMenu.sort');
            Route::resource('footerMenu', 'FooterMenuController');
        });
        Route::group(['prefix' => 'blog', 'namespace' => 'Blog', 'middleware' => ['demo', 'disable.blog']], function () {
            Route::get('categories/slug', 'CategoryController@slug')->name('categories.slug');
            Route::resource('categories', 'CategoryController');
            Route::get('articles/slug', 'ArticleController@slug')->name('articles.slug');
            Route::get('articles/categories/{lang}', 'ArticleController@getCategories')->middleware('ajax.only');
            Route::resource('articles', 'ArticleController');
            Route::get('comments', 'CommentController@index')->name('comments.index');
            Route::get('comments/{id}/view', 'CommentController@viewComment')->middleware('ajax.only');
            Route::post('comments/{id}/update', 'CommentController@updateComment')->name('comments.update');
            Route::delete('comments/{id}', 'CommentController@destroy')->name('comments.destroy');
        });
        Route::group(['prefix' => 'settings', 'namespace' => 'Settings', 'middleware' => 'demo'], function () {
            Route::name('admin.settings.')->group(function () {
                Route::view('/', 'backend.settings.index')->name('index');
                Route::get('general', 'GeneralController@index')->name('general');
                Route::post('general/update', 'GeneralController@update')->name('general.update');
                Route::name('upload.')->prefix('upload')->middleware('noSaas')->group(function () {
                    Route::get('/', 'UploadController@index')->name('index');
                    Route::get('{id}', 'UploadController@edit')->name('edit');
                    Route::post('{id}', 'UploadController@update')->name('update');
                });
                Route::name('storage.')->prefix('storage')->group(function () {
                    Route::get('/', 'StorageController@index')->name('index');
                    Route::get('edit/{id}', 'StorageController@edit')->name('edit');
                    Route::post('edit/{id}', 'StorageController@update')->name('update');
                    Route::post('connect/{provider}', 'StorageController@storageTest')->name('test');
                    Route::post('default/{id}', 'StorageController@setDefault')->name('default');
                });
                Route::get('smtp', 'SmtpController@index')->name('smtp');
                Route::post('smtp/update', 'SmtpController@update')->name('smtp.update');
                Route::post('smtp/test', 'SmtpController@test')->name('smtp.test');
                Route::resource('extensions', 'ExtensionController', ['only' => ['index', 'edit', 'update']]);
                Route::resource('gateways', 'GatewayController', ['only' => ['index', 'edit', 'update']])->middleware('saas');
                Route::name('mailtemplates.')->prefix('mailtemplates')->group(function () {
                    Route::get('/', 'MailTemplateController@redirect')->name('index');
                    Route::post('settings/update', 'MailTemplateController@updateSettings')->name('settings.update');
                    Route::get('{lang}', 'MailTemplateController@index')->name('show');
                    Route::get('{lang}/{group}', 'MailTemplateController@index')->name('show.group');
                    Route::post('{lang}/{group}', 'MailTemplateController@update')->name('update');
                });
                Route::resource('taxes', 'TaxController')->middleware('saas');
            });
            Route::get('pages/slug', 'PageController@slug')->name('pages.slug');
            Route::resource('pages', 'PageController');
            Route::resource('admins', 'AdminController');
            Route::prefix('languages')->group(function () {
                Route::post('{id}/default', 'LanguageController@setDefault')->name('language.default');
                Route::post('{id}/update', 'LanguageController@translateUpdate')->name('translates.update');
                Route::get('translate/{code}', 'LanguageController@translate')->name('language.translate');
                Route::get('translate/{code}/{group}', 'LanguageController@translate')->name('language.translate.group');
            });
            Route::resource('languages', 'LanguageController');
            Route::resource('seo', 'SeoController');
        });
        Route::name('admin.additional.')->prefix('additional')->namespace('Additional')->middleware('demo')->group(function () {
            Route::get('cache', 'CacheController@index')->name('cache');
            Route::get('custom-css', 'CustomCssController@index')->name('css');
            Route::post('custom-css/update', 'CustomCssController@update')->name('css.update');
            Route::get('popup-notice', 'PopupNoticeController@index')->name('notice');
            Route::post('popup-notice/update', 'PopupNoticeController@update')->name('notice.update');
        });
        Route::name('admin.')->prefix('others')->namespace('Others')->middleware('demo')->group(function () {
            Route::resource('slideshow', 'SlideShowController');
            Route::resource('features', 'FeatureController');
            Route::resource('faq', 'FaqController');
            Route::get('download-page', 'DownloadPageController@index');
            Route::post('download-page', 'DownloadPageController@update')->name('download.page');
        });
        Route::name('admin.')->prefix('account')->namespace('Account')->middleware('demo')->group(function () {
            Route::get('details', 'SettingsController@detailsForm')->name('account.details');
            Route::get('security', 'SettingsController@securityForm')->name('account.security');
            Route::post('details/update', 'SettingsController@detailsUpdate')->name('account.details.update');
            Route::post('security/update', 'SettingsController@securityUpdate')->name('account.security.update');
        });
    });
});

/*
|--------------------------------------------------------------------------
| Frontend Routs With Laravel Localization
|--------------------------------------------------------------------------
 */

Route::get('secure/file/{id}', 'Frontend\File\SecureController@index')->name('secure.file');
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localizationRedirect', 'localeSessionRedirect', 'UserStatusCheck', 'notInstalled']], function () {
    Route::namespace ('Frontend\Gateways')->prefix('ipn')->name('ipn.')->group(function () {
        Route::get('paypal_express', 'PaypalExpressController@ipn')->name('paypal_express');
        Route::get('stripe_checkout', 'StripeCheckoutController@ipn')->name('stripe_checkout');
    });
    Auth::routes(['verify' => true]);
    Route::group(['namespace' => 'Frontend\User\Auth'], function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::get('login/{provider}', 'LoginController@redirectToProvider')->name('provider.login');
        Route::get('login/{provider}/callback', 'LoginController@handleProviderCallback')->name('provider.callback');
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::middleware(['disable.registration'])->group(function () {
            Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
            Route::post('register', 'RegisterController@register')->middleware('check.registration');
            Route::get('register/complete/{token}', 'RegisterController@showCompleteForm')->name('complete.registration');
            Route::post('register/complete/{token}', 'RegisterController@complete')->middleware('check.registration');
        });
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
        Route::get('password/confirm', 'ConfirmPasswordController@showConfirmForm')->name('password.confirm');
        Route::post('password/confirm', 'ConfirmPasswordController@confirm');
        Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
        Route::post('email/verify/email/change', 'VerificationController@changeEmail')->name('change.email');
        Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
        Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');
    });
    Route::group(['namespace' => 'Frontend\User\Auth', 'middleware' => ['auth', 'verified']], function () {
        Route::get('checkpoint/2fa/verify', 'CheckpointController@show2FaVerifyForm')->name('2fa.verify');
        Route::post('checkpoint/2fa/verify', 'CheckpointController@verify2fa');
    });
    Route::group(['prefix' => 'filemanager', 'namespace' => 'Frontend\Filemanager', 'middleware' => ['auth', 'verified', '2fa.verify', 'isSubscribed']], function () {
        Route::name('filemanager.')->group(function () {
            Route::get('/', 'FilesController@index')->name('index');
            Route::get('/search', 'FilesController@searchOnFiles')->name('searchOnFiles')->middleware('ajax.only');
            Route::get('load/files', 'FilesController@loadIndexFileEntries')->name('index.load.files')->middleware('ajax.only');
            Route::get('load/folders', 'FilesController@loadSidebarFolders')->name('index.load.folders')->middleware('ajax.only');
            Route::group(['namespace' => 'Actions'], function () {
                Route::post('createFolder', 'CreateFolderController@createFolder')->name('createFolder');
                Route::get('share/{shared_id}', 'ShareFileController@share')->name('share')->middleware('ajax.only');
                Route::post('rename/{id}', 'RenameController@rename')->name('rename')->middleware('ajax.only');
                Route::get('protection/{id}', 'ProtectionController@getProtectionForm')->middleware('ajax.only');
                Route::post('protection/{id}', 'ProtectionController@update')->name('protection')->middleware('ajax.only');
            });
            Route::name('recent.')->prefix('recent')->group(function () {
                Route::get('/', 'RecentFilesController@index')->name('index');
                Route::get('load/files', 'RecentFilesController@loadRecentFiles')->name('load.files')->middleware('ajax.only');
            });
            Route::name('trash.')->prefix('trash')->group(function () {
                Route::delete('single/{id}', 'TrashController@moveSingleFileToTrash')->name('single');
                Route::delete('multiple', 'TrashController@moveMultipleFileToTrash')->name('multiple');
                Route::get('/', 'TrashController@index')->name('index');
                Route::get('load/files', 'TrashController@loadTrashFileEntries')->name('load.files')->middleware('ajax.only');
                Route::delete('{id}/delete', 'TrashController@delete')->name('delete');
                Route::delete('empty', 'TrashController@emptyTrash')->name('empty');
                Route::post('{id}/restore', 'TrashController@restore')->name('restore');
                Route::post('restore/all', 'TrashController@restoreAll')->name('restore.all');
            });
            Route::get('{folder}', 'FilesController@showFolder')->name('showFolder');
            Route::get('{folder}/search', 'FilesController@searchOnFolder')->name('searchOnFolder')->middleware('ajax.only');
            Route::get('{folder}/load/files', 'FilesController@loadFolderFileEntries')->name('showFolder.load')->middleware('ajax.only');
        });

    });
    Route::group(['prefix' => 'user', 'namespace' => 'Frontend\User', 'middleware' => ['auth', 'verified', '2fa.verify']], function () {
        Route::get('/', function () {
            return redirect()->route('filemanager.index');
        })->name('user');
        Route::name('user.')->group(function () {
            Route::middleware('saas')->group(function () {
                Route::get('plans', 'PlanController@index')->name('plans');
                Route::get('checkout/{checkout_id}', 'CheckoutController@index')->name('checkout.index');
                Route::post('checkout/{checkout_id}/coupon/apply', 'CheckoutController@applyCoupon')->name('checkout.coupon.apply');
                Route::post('checkout/{checkout_id}/coupon/remove', 'CheckoutController@removeCoupon')->name('checkout.coupon.remove');
                Route::post('checkout/{checkout_id}/proccess', 'CheckoutController@proccess')->name('checkout.proccess');
            });
            Route::middleware('isSubscribed')->group(function () {
                Route::prefix('notifications')->group(function () {
                    Route::get('/', 'NotificationController@index')->name('notifications');
                    Route::get('view/{id}', 'NotificationController@view')->name('notifications.view');
                    Route::get('readall', 'NotificationController@readAll')->name('notifications.readall');
                });
                Route::middleware('saas')->group(function () {
                    Route::get('subscription', 'SubscriptionController@index')->name('subscription');
                    Route::get('subscription/transaction/{transaction_id}', 'SubscriptionController@transaction')->name('transaction');
                });
                Route::prefix('settings')->group(function () {
                    Route::get('/', 'SettingsController@index')->name('settings');
                    Route::post('details/update', 'SettingsController@detailsUpdate')->name('settings.details.update');
                    Route::post('details/mobile/update', 'SettingsController@mobileUpdate')->name('settings.details.mobile.update');
                    Route::get('password', 'SettingsController@password')->name('settings.password');
                    Route::post('password/update', 'SettingsController@passwordUpdate')->name('settings.password.update');
                    Route::get('2fa', 'SettingsController@towFactor')->name('settings.2fa');
                    Route::post('2fa/enable', 'SettingsController@towFactorEnable')->name('settings.2fa.enable');
                    Route::post('2fa/disabled', 'SettingsController@towFactorDisable')->name('settings.2fa.disable');
                });
            });
        });
    });
    Route::group(['namespace' => 'Frontend', 'middleware' => ['verified', '2fa.verify']], function () {
        Route::post('upload', 'UploadController@upload');
        Route::post('plan/{id}/{type}', 'SubscribeController@subscribe')->name('subscribe')->middleware('saas');
        Route::get('cookie/accept', 'ExtraController@cookie')->middleware('ajax.only');
        Route::get('popup/close', 'ExtraController@popup')->middleware('ajax.only');
        Route::middleware('isSubscribed')->group(function () {
            Route::get('/', 'HomeController@index')->name('home');
            Route::get('contact-us', 'PageController@contact')->name('contact');
            Route::post('contact-us/send', 'PageController@contactSend');
            Route::get('page/{slug}', 'PageController@pages')->name('page');
            Route::name('blog.')->prefix('blog')->middleware('disable.blog')->group(function () {
                Route::get('/', 'BlogController@index')->name('index');
                Route::get('category/{slug}', 'BlogController@index')->name('category');
                Route::get('article/{slug}', 'BlogController@article')->name('article');
                Route::post('article/{slug}/comment', 'BlogController@comment')->name('article.comment');
            });
            Route::get('faq', 'PageController@faq')->name('faq');
            Route::name('file.')->namespace('File')->group(function () {
                Route::get('{shared_id}/password', 'PasswordController@index');
                Route::post('{shared_id}/password', 'PasswordController@unlock')->name('password');
                Route::get('{shared_id}/preview', 'PreviewController@index')->name('preview');
                Route::get('{shared_id}/file', 'DownloadController@index')->name('download');
                Route::post('{shared_id}/download/create', 'DownloadController@createDownloadLink');
                Route::get('{shared_id}/download', 'DownloadController@download')->name('download.approval');
                Route::post('{shared_id}/file/report', 'DownloadController@reportFile')->name('report');
            });
        });
    });
});
