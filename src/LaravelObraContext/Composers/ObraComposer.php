<?php

namespace Ghi\Http\Composers;

use Ghi\Core\Contracts\Context;
use Ghi\Core\Contracts\ObraRepository;
use Illuminate\Contracts\View\View;

class ObraComposer
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @var ObraRepository
     */
    private $repository;

    /**
     * @param Context $context
     * @param ObraRepository $repository
     */
    public function __construct(Context $context, ObraRepository $repository)
    {
        $this->context = $context;
        $this->repository = $repository;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('currentObra', $this->getCurrentObra());
    }

    /**
     * Obtiene la obra del contexto actual
     *
     * @return mixed
     */
    private function getCurrentObra()
    {
        if ($this->context->isEstablished()) {
            return $this->repository->getById($this->context->getId());
        }
        return null;
    }
}
