<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminContollerTest extends WebTestCase
{

    /*
    //=====================ajout Partenaire============//
     public function testAjoutP()
    {
        $client = static::createClient([],
            ['PHP_AUTH_USER' => 'mayajolie',
            'PHP_AUTH_PW' => 'mayajolie', ]
        );
        $crawler = $client->request('POST', '/api/admin',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '{  "raisonSocial":"mayaService","ninea": "maya215","adresse": "Parcelle","telephone": 33918451,"etat": "debloquer","username":"maya","password":"maya", "profit":"admin", "nom":"ngom","prenom":"abdoulaye", "tel": "776418887", "adre":"kounoune", "email":"j@gmail.com", "status":"bloquer", "solde":"75000"}');
        $rep = $client->getResponse();
        var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }/*
    //=======================lister Partenaire==================//
     public function testIndex()
    {
        $client = static::createClient([],
            ['PHP_AUTH_USER' => 'mayajolie',
            'PHP_AUTH_PW' => 'mayajolie', ]
        );

        $crawler = $client->request('GET', '/api/partenaires');
        $rep = $client->getResponse();
        $this->assertSame(200, $client->getResponse()->getStatuscode());
    }
    //================test ajout partenaire fausse====================//
    public function testAddPartenaire()
    {
        $client = static::createClient([],
            ['PHP_AUTH_USER' => 'mayajolie',
            'PHP_AUTH_PW' => 'mayajolie', ]
        );
        $crawler = $client->request('POST', '/api/admin',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '{"raisonSocial":"ngomSA","ninea": "","adresse": "Mermoz","telephone": ,"etat": "debloquer"}');
        $rep = $client->getResponse();
        var_dump($rep);
        $this->assertSame(400, $client->getResponse()->getStatusCode());
    } 
    //========================ajout Compt Bancaire ====================//
    public function testAddComptBok()
    {
        $client = static::createClient([],
            ['PHP_AUTH_USER' => 'mayajolie',
            'PHP_AUTH_PW' => 'mayajolie', ]
        );
        $crawler = $client->request('POST', '/api/comptB',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '{
            "partenaire": "47"
        }');
        $rep = $client->getResponse();
        var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }
    //=============================Compte bancaire fausse===============//
    public function testAddComptB()
    {
        $client = static::createClient([],
            ['PHP_AUTH_USER' => 'mayajolie',
            'PHP_AUTH_PW' => 'mayajolie', ]
        );
        $crawler = $client->request('POST', '/api/comptB',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '{"numeroCompte":"1247856552",
          "solde":,
         "partenaire": "8"
        }');
        $rep = $client->getResponse();
        var_dump($rep);
        $this->assertSame(400, $client->getResponse()->getStatusCode());
    }*/
    //===================================faire un depot =======================//
     public function testAddDepotOK()
    {
        $client = static::createClient([],
            ['PHP_AUTH_USER' => 'bsokhna',
            'PHP_AUTH_PW' => 'bsokhna', ]
        );
        $crawler = $client->request('POST', '/api/depot',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '{"montant": "7500",
          "caissier": "50",
          "numeroCompt": "20190805114302"
        }');
        $rep = $client->getResponse();
        var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    } /*
    //======================depot fausse============================//
      public function testAddDepot()
    {
        $client = static::createClient([],
            ['PHP_AUTH_USER' => 'mayajolie',
            'PHP_AUTH_PW' => 'mayajolie', ]
        );
        $crawler = $client->request('POST', '/api/depot',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '{"montant": "800000",
          "caissier": "25",
          "numeroCompt": "20190803194514"
        }');
        $rep = $client->getResponse();
        var_dump($rep);
        $this->assertSame(400, $client->getResponse()->getStatusCode());
    } 
    //=====================Ajout caisier=========================//
    public function testCaisier()
    {
        $client = static::createClient([],
            ['PHP_AUTH_USER' => 'mayajolie',
            'PHP_AUTH_PW' => 'mayajolie', ]
        );
        $crawler = $client->request('POST', '/api/register',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '{ 
            "username":"juniorlaye",
            "password":"juniorlaye",
            "profit":"caisier",
            "nom":"ngom",
            "prenom":"abdoulaye",
            "telephone": "776418887",
            "adresse":"kounoune",
            "email":"j@gmail.com",
            "etat":"bloquer"
        }');
        $rep = $client->getResponse();
        var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    } 
    //================ajout user==================//
     public function testUser()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/admin',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '{ 
            "username":"maya",
            "password":"maya",
            "profit":"user",
            "nom":"fall",
            "prenom":"sokhna",
            "tel": "776854721",
            "adre":"kounoune",
            "email":"mj@gmail.com",
            "status":"bloquer",
        }');
        $rep = $client->getResponse();
        var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }   */
} 
