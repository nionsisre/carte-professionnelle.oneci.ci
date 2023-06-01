<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use DipeshSukhia\LaravelHtmlMinify\LaravelHtmlMinifyFacade;
use Illuminate\Support\Facades\Route;

class LaravelMinifyHtml
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        // check if environment is production
        if(env('APP_ENV') === "production") {
            if ($this->isResponseObject($response) && $this->isHtmlResponse($response) && Config::get('htmlminify.default')) {
                if (!Route::is('login') && !Route::is('authentificaton') && !Route::is('password.*')
                    && !Route::is('oneci.update.password') && !Route::is('abonnees.*') && !Route::is('abonnees.*')
                    && !Route::is('admin_home') && !Route::is('rapport') && !Route::is('setting')
                    && !Route::is('user') && !Route::is('add.user') && !Route::is('update.user')
                    && !Route::is('rapport.search') && !Route::is('operateur.search.export') && !Route::is('rapport.export')
                    && !Route::is('rapport.import') && !Route::is('abonnees.*') && !Route::is('logout')) {
                    $response->setContent(LaravelHtmlMinifyFacade::htmlMinify($response->getContent()));
                }
            }
        }
        return $response;
    }

    protected function isResponseObject($response)
    {
        return is_object($response) && $response instanceof Response;
    }

    protected function isHtmlResponse(Response $response)
    {
        return strtolower(strtok($response->headers->get('Content-Type'), ';')) === 'text/html';
    }
}
