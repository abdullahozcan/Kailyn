<?php
namespace Controllers;

use Core\Request;

class UserController
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handleRequest()
    {
        // GET parametresini al
        $userId = $this->request->get('id');
        
        // POST parametresini al
        $userName = $this->request->post('name');
        
        // Tüm istek parametrelerini al
        $allParams = $this->request->all();
        
        // İstek metodunu kontrol et
        if ($this->request->isMethod('POST')) {
            // POST isteği ile gelen JSON verisini al
            $jsonBody = $this->request->getBodyJson();
        }

        // Bir başlık değerini al
        $userAgent = $this->request->getHeader('HTTP_USER_AGENT');

        // İşlem sonuçlarını yazdır
        echo "User ID: " . $userId . "\n";
        echo "User Name: " . $userName . "\n";
        echo "All Params: " . print_r($allParams, true) . "\n";
        echo "JSON Body: " . print_r($jsonBody, true) . "\n";
        echo "User Agent: " . $userAgent . "\n";
    }
}