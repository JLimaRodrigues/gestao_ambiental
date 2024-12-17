<?php 

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Model\Conexao;
use App\Model\ModelPadrao;

use Firebase\JWT\JWT;

class LoginController extends Controller {

    public function login(Request $request, Response $response)
    {
        return $this->view->render($response, 'login.html');
    }

    public function logar(Request $request, Response $response)
    {
        $data  = $request->getParsedBody();

        $login = $data['login'];
        $senha = $data['senha'];
        try {
            $conexao = Conexao::getInstancia();

            $resultado = (new ModelPadrao)->find($login, 'usuarios', 'usuario')[0];//tenho que resolver esse array 0 depois

            if(password_verify($senha, $resultado->senha)){

                //autenticacao deu certo
                $data     = new \DateTimeImmutable();
                $expiraEm = $data->modify('+600 seconds')->getTimestamp();
                $dominio  = "gestamb";

                $payload  = [
                    'iat' => $data->getTimestamp(),
                    'iss' => $dominio,
                    'nbf' => $data->getTimestamp(),
                    'exp' => $expiraEm,
                    'data' => [
                        'idUsuario' => $resultado->id,
                        'login'     => $resultado->usuario
                    ]
                ];

                $token = JWT::encode($payload, SECRET_KEY, 'HS256');

                $_SESSION['jwt'] = $token;
                // $_SESSION['cod_logado'] = $resultado->id; //vou usar o método de decoded do JWT para recuperar o id do usuário 

                return $response->withHeader('Location', $this->router->urlFor('inicio'))
                            ->withStatus(302);
            } else {
                throw new \Exception("Login/Senha Inválido(s)", 1);
            }
        } catch (\Exception $e) {
            $this->flash->addMessage('error', 'Autenticação Inválida.');

            return $response->withHeader('Location', $this->router->urlFor('login'))
                            ->withStatus(302);
        }
    }

    public function logout(Request $request, Response $response)
    {
        try {
                unset($_SESSION['jwt']);
                // unset($_SESSION['codUsuario']);

                $this->flash->addMessage('success', 'Logout feito com sucesso, obrigado por usar o sistema.');
                return $response->withHeader('Location', $this->router->urlFor('login'))
                            ->withStatus(302);
        } catch (\Exception $e) {
            $this->flash->addMessage('error', 'Usuário Inválido.');

            return $response->withHeader('Location', $this->router->urlFor('login'))
                            ->withStatus(302);
        }
    }
}