<?php

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\{
    ResponseFactoryInterface,
    ResponseInterface,
    ServerRequestInterface
};
use Psr\Http\Server\{
    MiddlewareInterface,
    RequestHandlerInterface
};
use Psr\Log\LoggerInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Slim\Flash\Messages;

class AuthMiddleware implements MiddlewareInterface
{
    private ResponseFactoryInterface $responseFactory;
    private string $secretKey;
    private LoggerInterface $logger;
    private Messages $flash;

    public function __construct(ResponseFactoryInterface $responseFactory, string $secretKey, ContainerInterface $container)
    {
        $this->responseFactory = $responseFactory;
        $this->secretKey       = $secretKey;
        $this->logger          = $container->get('logger');
        $this->flash           = $container->get('flash');
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $this->responseFactory->createResponse();

        if (is_null($_SESSION['jwt'])) {
            $this->logger->warning("Falha na autenticação: Token ausente ou formato inválido.", ['header' => $authHeader]);
            $this->flash->addMessage('error', 'Tempo de sessão expirado.');
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        $jwt = $_SESSION['jwt'];

        try {
            // Decodificar e validar o token JWT
            $decoded = JWT::decode($jwt, new Key($this->secretKey, 'HS256'));

            // Inserir o token decodificado no atributo da requisição
            $request = $request->withAttribute('user', $decoded);

        } catch (\Exception $e) {
            // Registrar o erro no log
            $this->logger->error("Erro ao validar o token JWT: {$e->getMessage()}", [
                // 'exception' => $e,
                // 'token' => $jwt
            ]);
            $this->flash->addMessage('error', 'Tempo de sessão expirado.');

            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        // Continuar o pipeline de middleware
        return $handler->handle($request);
    }
}
