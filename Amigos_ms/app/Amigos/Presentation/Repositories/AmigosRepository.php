<?php
 
namespace App\Amigos\Presentation\Repositories;
 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\AmigosController;
use Exception;
 
class AmigosRepository
{
 
    function all(Request $request, Response $response)
    {
        $controller = new AmigosController();
        $amigos = $controller->getAmigos();
        $response->getBody()->write($amigos);
        return $response->withHeader("Content-Type", "application/json");
    }
 
    function create(Request $request, Response $response)
    {
        $bodyRequest = $request->getBody()->getContents();
        $data = json_decode($bodyRequest, true);
        $controller = new AmigosController();
        $amigo = $controller->guardarAmigo($data);
        $response->getBody()->write($amigo);
        return $response->withHeader("Content-Type", "application/json");
    }
 
    function detail(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $controller = new AmigosController();
            $amigo = $controller->getAmigo($id);
            $resp->getBody()->write($amigo->toJson());
            return $resp->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $code = ($ex->getCode() == 1) ? 404 : 400;
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus($code);
        }
    }
 
    function update(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $data = json_decode($req->getBody()->getContents(), true);
            $controller = new AmigosController();
            $amigo = $controller->modificarAmigo($id, $data);
            $resp->getBody()->write($amigo->toJson());
            return $resp->withStatus(200)->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $code = ($ex->getCode() == 1) ? 404 : 400;
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus($code);
        }
    }
 
    function delete(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $controller = new AmigosController();
            $controller->borrarAmigo($id);
            $resp->getBody()->write(json_encode(['msg' => 'Amigo borrado']));
            return $resp->withStatus(200)->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $code = ($ex->getCode() == 1) ? 404 : 400;
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus($code);
        }
    }
}