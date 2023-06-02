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
                if (!(Route::currentRouteName() == 'login' || Route::currentRouteName() == 'authentificaton' || Route::currentRouteName() == 'password.rest'
                    || Route::currentRouteName() == 'oneci.update.password' || Route::currentRouteName() == 'abonnees.*' || Route::currentRouteName() == 'abonnees.*'
                    || Route::currentRouteName() == 'admin_home' || Route::currentRouteName() == 'rapport' || Route::currentRouteName() == 'setting'
                    || Route::currentRouteName() == 'user' || Route::currentRouteName() == 'add.user' || Route::currentRouteName() == 'update.user'
                    || Route::currentRouteName() == 'rapport.search' || Route::currentRouteName() == 'operateur.search.export' || Route::currentRouteName() == 'rapport.export'
                    || Route::currentRouteName() == 'rapport.import' || Route::currentRouteName() == 'abonnees.exportation' || Route::currentRouteName() == 'logout.importation'
                    || Route::currentRouteName() == 'abonnes.validation' || Route::currentRouteName() == 'abonnees.validation.search' || Route::currentRouteName() == 'abonnees.validation.update')) {
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
