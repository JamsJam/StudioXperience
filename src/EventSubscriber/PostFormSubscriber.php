<?php

namespace App\EventSubscriber;

use App\Kernel;
use DateTimeImmutable;
use App\Entity\Calendrier;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\Persistence\ObjectManager;
use App\Repository\CalendrierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostFormSubscriber implements EventSubscriberInterface
{




    public static function getSubscribedEvents(): array
    {
        return [
            // FormEvents::POST_SUBMIT => ['onFormSubmit', 10],
            // FormEvents::PRE_SET_DATA => ['onPreSetData', 10],
            // KernelEvents::REQUEST => ['onKernelRequest', 10],
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

    public function onPreSetData(RequestEvent $event, FormEvent $formEvent): void
    {
        dd($event, $formEvent);
        $requestLocation = $event->getRequest()->getPathInfo();
        // if($requestLocation === "/back/office/post/new"){
            dd($event, "evenement REQUEST déclenché");
            return;
        // }
        
        

    }

    private function getArticleForme($request)
    {
        $form = $request->query->get('format');
        return $form;
    }

    private function getVideoForme($request)
    {
        
        // return $form;
    }

}
