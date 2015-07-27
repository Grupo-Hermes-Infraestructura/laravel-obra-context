<?php

namespace Ghi\LaravelObraContext;

use Auth;
use Illuminate\Routing\Controller;
use Ghi\Core\Contracts\UserRepository;

class ObrasController extends Controller
{
    /**
     *
     */
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra una lista de obras asociadas con el usuario
     *
     * @param UserRepository $repository
     * @return \Illuminate\View\View
     */
    public function index(UserRepository $repository)
    {
        $obras = $repository->getObras(auth()->id());
        $obras->setPath('obras');

        return view('obras.index')->withObras($obras);
    }
}
