<?php

namespace Ghi\LaravelObraContext\Controllers;

use Auth;
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

        return view('ghi::obras')->withObras($obras);
    }
}
