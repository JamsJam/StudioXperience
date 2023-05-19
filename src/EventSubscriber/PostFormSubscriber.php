<?php

namespace App\EventSubscriber;

use DateTimeImmutable;
use App\Entity\Calendrier;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\Persistence\ObjectManager;
use App\Repository\CalendrierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostFormSubscriber implements EventSubscriberInterface
{


    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::POST_SUBMIT => ['onFormSubmit', 10],
        ];
    }
    
    public function onFormSubmit(FormEvent $event): void
    {
        //  dd($event, "evenement SUBMIT déclenché");

        $calendar = new Calendrier();
        $form = $event->getForm()->getData();
        $formData = $event->getData(); 

        // $calendar
        //     ->setTitle($form->getTitre())
        //     ->setBeginAt(DateTimeImmutable::createFromMutable($event->getForm()->get('publishAt')->getData()));
        // $this->manager->getRepository(CalendrierRepository::class)->save($calendar);



 
        // $response = new RedirectResponse("http://localhost:8000/back/office/post/new", 302,["form" => $form, "calendar"=>$calendar] );
        //  $response->send();

    }



}
