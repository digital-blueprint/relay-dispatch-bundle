<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseDispatchController extends AbstractController
{
    /**
     * Request::get() is internal starting with Symfony 5.4, so we duplicate a subset of the logic we need here.
     *
     * @param mixed $default
     *
     * @return mixed
     */
    public static function requestGet(Request $request, string $key, $default = null)
    {
        if ($request->query->has($key)) {
            return $request->query->all()[$key];
        }

        if ($request->request->has($key)) {
            return $request->request->all()[$key];
        }

        return $default;
    }
}
