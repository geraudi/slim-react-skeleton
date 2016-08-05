<?php

/*
 * Original file : https://github.com/tuupola/slim-jwt-auth
 *
 * Retreive jwt and add in request attribute.
 *
 */

namespace Lib\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Lib\Helper\JwtHelper;

class JwtIntercept
{

    /**
     * Stores all the options passed to the rule
     */
    private $options = [
        "secure" => true,
        "relaxed" => ["localhost", "127.0.0.1"],
        "environment" => ["HTTP_AUTHORIZATION", "REDIRECT_HTTP_AUTHORIZATION"],
        "algorithm" => ["HS256", "HS512", "HS384"],
        "header" => "Authorization",
        "regexp" => "/Bearer\s+(.*)$/i",
        "cookie" => "token",
        "attribute" => "token",
        "path" => null,
        "passthrough" => null,
        "callback" => null,
        "error" => null
    ];

    /** @var JwtHelper  */
    protected $jwtHelper;

    public function __construct(JwtHelper $jwtHelper)
    {
        $this->jwtHelper = $jwtHelper;
    }

    /**
     * Call the middleware
     *
     * @param \Psr\Http\Message\RequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param callable $next
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        $decoded = null;

        $token = $this->fetchToken($request);
        if ($token) {
            $decoded = $this->jwtHelper->decodeToken($token);
        }

        if ($decoded && $attribute = $this->jwtHelper->getRequestAttribute()) {
            $request = $request->withAttribute($attribute, $decoded);
        }

        return $next($request, $response);
    }

    /**
     * Fetch the access token
     *
     * @param \Psr\Http\Message\RequestInterface $request
     * @return string|null Base64 encoded JSON Web Token or null if not found.
     */
    public function fetchToken(RequestInterface $request)
    {
        /* If using PHP in CGI mode and non standard environment */
        $server_params = $request->getServerParams();
        $header = "";

        /* Check for each given environment */
        foreach ((array) $this->options["environment"] as $environment) {
            if (isset($server_params[$environment])) {
                $header = $server_params[$environment];
            }
        }

        /* Nothing in environment, try header instead */
        if (empty($header)) {
            $headers = $request->getHeader($this->options["header"]);
            $header = isset($headers[0]) ? $headers[0] : "";
        }

        /* Try apache_request_headers() as last resort */
        if (empty($header) && function_exists("apache_request_headers")) {
            $headers = apache_request_headers();
            $header = isset($headers[$this->options["header"]]) ? $headers[$this->options["header"]] : "";
        }

        if (preg_match($this->options["regexp"], $header, $matches)) {
            return $matches[1];
        }

        /* Bearer not found, try a cookie. */
        $cookie_params = $request->getCookieParams();

        if (isset($cookie_params[$this->options["cookie"]])) {
            return $cookie_params[$this->options["cookie"]];
        };

        return false;
    }

}
