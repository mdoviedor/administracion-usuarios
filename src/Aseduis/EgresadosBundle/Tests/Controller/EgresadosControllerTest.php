<?php

namespace Aseduis\EgresadosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EgresadosControllerTest extends WebTestCase
{
    public function testCrear()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/egresados/crear');
    }

    public function testModificar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/egresados/modificar/{id}');
    }

    public function testEliminar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/egresados/eliminar/{id}');
    }

    public function testBuscar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/egresados/buscar');
    }

    public function testVer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/egresados/ver/{id}');
    }

}
