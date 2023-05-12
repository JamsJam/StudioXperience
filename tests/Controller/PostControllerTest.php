<?php

namespace App\Test\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private PostRepository $repository;
    private string $path = '/back/office/post/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Post::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Post index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'post[pricing]' => 'Testing',
            'post[share]' => 'Testing',
            'post[titre]' => 'Testing',
            'post[corps]' => 'Testing',
            'post[description]' => 'Testing',
            'post[keywords]' => 'Testing',
            'post[publishAt]' => 'Testing',
            'post[format]' => 'Testing',
            'post[categorie]' => 'Testing',
        ]);

        self::assertResponseRedirects('/back/office/post/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Post();
        $fixture->setPricing('My Title');
        $fixture->setShare('My Title');
        $fixture->setTitre('My Title');
        $fixture->setCorps('My Title');
        $fixture->setDescription('My Title');
        $fixture->setKeywords('My Title');
        $fixture->setPublishAt('My Title');
        $fixture->setFormat('My Title');
        $fixture->setCategorie('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Post');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Post();
        $fixture->setPricing('My Title');
        $fixture->setShare('My Title');
        $fixture->setTitre('My Title');
        $fixture->setCorps('My Title');
        $fixture->setDescription('My Title');
        $fixture->setKeywords('My Title');
        $fixture->setPublishAt('My Title');
        $fixture->setFormat('My Title');
        $fixture->setCategorie('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'post[pricing]' => 'Something New',
            'post[share]' => 'Something New',
            'post[titre]' => 'Something New',
            'post[corps]' => 'Something New',
            'post[description]' => 'Something New',
            'post[keywords]' => 'Something New',
            'post[publishAt]' => 'Something New',
            'post[format]' => 'Something New',
            'post[categorie]' => 'Something New',
        ]);

        self::assertResponseRedirects('/back/office/post/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getPricing());
        self::assertSame('Something New', $fixture[0]->getShare());
        self::assertSame('Something New', $fixture[0]->getTitre());
        self::assertSame('Something New', $fixture[0]->getCorps());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getKeywords());
        self::assertSame('Something New', $fixture[0]->getPublishAt());
        self::assertSame('Something New', $fixture[0]->getFormat());
        self::assertSame('Something New', $fixture[0]->getCategorie());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Post();
        $fixture->setPricing('My Title');
        $fixture->setShare('My Title');
        $fixture->setTitre('My Title');
        $fixture->setCorps('My Title');
        $fixture->setDescription('My Title');
        $fixture->setKeywords('My Title');
        $fixture->setPublishAt('My Title');
        $fixture->setFormat('My Title');
        $fixture->setCategorie('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/back/office/post/');
    }
}
