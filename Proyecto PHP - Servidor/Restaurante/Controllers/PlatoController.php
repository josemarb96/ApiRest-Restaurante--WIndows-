<?php

require_once "Controller.php";

class PlatoController extends Controller
{
    public function manageGetVerb(Request $request)
    {

        $listaPlatos = null;
        $idPlato = null;
        $response = null;
        $code = null;

        if (isset($request->getUrlElements()[2]))
        {
            $idPlato = $request->getUrlElements()[2];
        }


        $listaPlatos = PlatoHandlerModel::getPlato($idPlato);

        if ($listaPlatos != null)
        {
            $code = '200';

        }
        else
        {

            if (PlatoHandlerModel::isValid($idPlato))
            {
                $code = '404';
            }
            else
            {
                $code = '400';
            }

        }

        $response = new Response($code, null, $listaPlatos, $request->getAccept());
        $response->generate();

    }

    public function managePostVerb(Request $request)
    {
        $response=null;
        $code=null;
        $resultado=null;
        $plato=null;
        $idPlato = $request->getBodyParameters()[0]->idPlato;
        $nombrePlato = $request->getBodyParameters()[0]->nombrePlato;
        $plato= new PlatoModel($idPlato,$nombrePlato);
        $resultado=PlatoHandlerModel::postPlato($plato);

        if ($request != null)
        {
            $code = '200';
        }
        else
        {
            $code = '400';
        }

        $response = new Response($code, null, $resultado, $request->getAccept());
        $response->generate();
    }

    public function manageDeleteVerb(Request $request)
    {
        $response=null;
        $code=null;
        $plato=null;
        $idPlato = null;
        if (isset($request->getUrlElements()[2]))
        {
            $idPlato = $request->getUrlElements()[2];
        }

        if($idPlato!=null)
            PlatoHandlerModel::deletePlato($idPlato);

        if ($request != null)
        {
            $code = '200';
        }
        else
        {
            $code = '400';
        }

        $response = new Response($code, null, null, $request->getAccept());
        $response->generate();
    }

    public function managePutVerb(Request $request)
    {
        $response=null;
        $code=null;
        $resultado=null;
        $plato=null;
        $idPlato = $request->getBodyParameters()[0]->idPlato;
        $nombrePlato = $request->getBodyParameters()[0]->nombrePlato;
        $plato= new PlatoModel($idPlato,$nombrePlato);
        $resultado=PlatoHandlerModel::putPlato($plato);

        if ($request != null)
        {
            $code = '200';
        }
        else
        {
            $code = '400';
        }

        $response = new Response($code, null, $resultado, $request->getAccept());
        $response->generate();
    }
}