<?php
App::uses('MeetupAppController', 'Meetup.Controller');

class MeetupEventsController extends MeetupAppController {
	
	public function beforeFilter() {
		$this->set('title_for_layout', 'Events');
	}
	
	public function index() {
		$meetupEvents = $this->MeetupEvent->find('all', array('conditions' => array('group_urlname' => 'SydPHP')));
		$this->set(compact('meetupEvents'));
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Could not find the requested Event'));
		}
		$this->MeetupEvent->recursive = 1;
		$meetupEvent = $this->MeetupEvent->read(null, $id);
		
		$meetupEvent['RSVP'] = $this->MeetupEvent->MeetupRSVP->find('first', array('conditions' => array('event_id' => $id)));
		$this->set(compact('meetupEvent'));
	}
	
}
