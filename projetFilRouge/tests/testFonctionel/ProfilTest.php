<?php

namespace App\Tests\funct;

class ProfilTest extends  WebTestCase
{
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function Testget_profils_all()
    {
        $this->client=$this->createAuthenticatedClient("admin1","passe123");
        $this->client->request('GET','/api/admin/profil');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    protected function createAuthenticatedClient(string $username, string $password)
    {
        $info=["username"=>$username, "password"=>$password];
        $this->client->request('POST','/api/login',[],[],
        ['CONTENT_TYPE'=>'application/json'],json_decode($info)
    );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $data = \json_decode($this->client->getResponse()->getContent(), true);
        $this->client->setServerParameter('HTTP_Authorization', \sprintf('Bearer %s', $data['token']));
        $this->client->setServerParameter('CONTENT_TYPE', 'application/json');

        return $this->client;
    }
}