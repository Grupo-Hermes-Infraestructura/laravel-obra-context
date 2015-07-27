<?php

namespace Ghi\LaravelObraContext\Middleware;

use Closure;
use Laracasts\Flash\Flash;
use Ghi\Core\Contracts\Context;
use Illuminate\Contracts\Config\Repository;
use Redirect;

class RedirectIfContextNotSet
{
    /**
     * @var RedirectIfContextNotSet
     */
    private $context;

    /**
     * @var Flash
     */
    private $flash;

    /**
     * @var Repository
     */
    private $config;

    /**
     * @param Context $context
     * @param Flash $flash
     * @param Repository $config
     */
    function __construct(Context $context, Flash $flash, Repository $config)
    {
        $this->context = $context;
        $this->flash = $flash;
        $this->config = $config;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->context->notEstablished()) {
            Flash::error('Lo sentimos, debe seleccionar una obra para ver esta información!');

            return redirect()->guest(route('pages.obras'));
        }

        $this->setContext();

        return $next($request);
    }

    /**
     * Sets the datbase connection's database name for the current context
     */
    private function setContext()
    {
        $this->config->set('database.connections.cadeco.database', $this->context->getDatabaseName());
    }
}
