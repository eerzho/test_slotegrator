<?php

namespace Tests\BaseTest;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    private Client $client;
    private Response $response;

    private array $defaultHeaders = [
        'Content-Type' => 'application/json',
        'Accept'       => 'application/json'
    ];

    protected function setUp(): void
    {
        ob_start();
        include 'drop-migrations.php';
        include 'run-migrations.php';
        include 'run-seeders.php';
        ob_end_clean();

        $this->client = new Client([
            'base_uri' => APP_URL
        ]);
    }

    /**
     * @param string $url
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getJson(string $url, array $headers = [])
    {
        return $this->sendRequest('GET', $url, [], $headers);
    }

    /**
     * @param string $url
     * @param array  $body
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function postJson(string $url, array $body = [], array $headers = [])
    {
        return $this->sendRequest('POST', $url, $body, $headers);
    }

    /**
     * @param string $url
     * @param array  $body
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function putJson(string $url, array $body = [], array $headers = [])
    {
        return $this->sendRequest('PUT', $url, $body, $headers);
    }

    /**
     * @param string $url
     * @param array  $body
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pathcJson(string $url, array $body = [], array $headers = [])
    {
        return $this->sendRequest('PATCH', $url, $body, $headers);
    }

    /**
     * @param string $url
     * @param array  $body
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteJson(string $url, array $body = [], array $headers = [])
    {
        return $this->sendRequest('DELETE', $url, $body, $headers);
    }

    /**
     * @param int   $expectedCode
     * @param array $expectedBody
     */
    protected function compareResult(int $expectedCode, array $expectedBody = [])
    {
        $this->assertEquals($expectedCode, $this->response->getStatusCode());
        if (count($expectedBody)) {
            $actualBody = json_decode($this->response->getBody()->getContents(), true);
            $this->assertEquals($expectedBody, $actualBody);
        }
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getAuthToken(string $email, string $password)
    {
        $response = $this->postJson('auth/login', [
            'email'    => $email,
            'password' => $password,
        ]);

        return json_decode($response->getBody(), true)['data']['token'];
    }

    /**
     * @param string $method
     * @param string $url
     * @param array  $body
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function sendRequest(string $method, string $url, array $body = [], array $headers = [])
    {
        try {
            $request = new Request(
                $method,
                $url,
                array_merge($this->defaultHeaders, $headers),
                json_encode($body)
            );

            return $this->response = $this->client->send($request);
        } catch (ClientException $exception) {
            return $this->response = $exception->getResponse();
        }
    }
}