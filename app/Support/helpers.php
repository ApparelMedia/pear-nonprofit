<?php

if (! function_exists('json')) {
    /**
     * Return a new json response from the application.
     *
     * @param  string  $content
     * @param  int     $status
     * @param  array   $headers
     * @return \Symfony\Component\HttpFoundation\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    function json($content = '', $status = 200, array $headers = [])
    {
        $headersArr = array_merge(['Content-Type' => 'application/json'], $headers);
        $factory = new Laravel\Lumen\Http\ResponseFactory;
        return $factory->make($content, $status, $headersArr);
    }
}
