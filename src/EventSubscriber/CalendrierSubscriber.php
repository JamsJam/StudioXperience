<?php

// namespace App\EventSubscriber;

// use App\Repository\CalendrierRepository;
// use Symfony\Component\EventDispatcher\EventSubscriberInterface;
// use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

// class CalendrierSubscriber implements EventSubscriberInterface
// {
//     public function onCalendrierController($event): void
//     {
//         // ...
//     }

//     public static function getSubscribedEvents(): array
//     {
//         return [
//             'CalendrierController' => 'onCalendrierController',
//         ];
//     }
// }
// src/EventSubscriber/CalendarSubscriber.php


namespace App\EventSubscriber;

use App\Repository\CalendrierRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendrierSubscriber implements EventSubscriberInterface
{
    private $CalendrierRepo;
    private $url;

    public function __construct(
        CalendrierRepository $CalendrierRepo,
        UrlGeneratorInterface $url
    ) {
        $this->CalendrierRepo = $CalendrierRepo;
        $this->url = $url;
    }

    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // Modify the query to fit to your entity and needs
        // Change post.beginAt by your start date property
        $posts = $this->CalendrierRepo
            ->createQueryBuilder('booking')
            ->where('booking.beginAt BETWEEN :start and :end OR booking.endAt BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult()
        ;

        foreach ($posts as $post) {
            // this create the events with your data (here post data) to fill calendar
            $postEvent = new Event(
                $post->getTitle(),
                $post->getBeginAt(),
                $post->getEndAt() // If the end date is null or not defined, a all day event is created.
                // $ressource(id) ?
                // $options(array) ?
            );

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

            $postEvent->setOptions([
                'backgroundColor' => 'red',
                'borderColor' => 'red',
            ]);
            $postEvent->addOption(
                'url',
                $this->url->generate('app_calendrier_show', [
                    'id' => $post->getId(),
                ])
            );

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($postEvent);
        }
    }
}