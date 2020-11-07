<?
return array(
  'user/login' => 'user/login',
  'user/logout' => 'user/logout',
  'tasks/edit/([0-9]+)' => 'task/update/$1',
  'tasks/delete/([0-9]+)' => 'task/delete/$1',
  'tasks/create' => 'task/create',
  'sort/([_a-z]+)/([A-Z]+)/page-([0-9]+)' => 'task/index/$1/$2/$3',
  'sort/([_a-z]+)/([A-Z]+)' => 'task/index/$1/$2',
  'page-([0-9]+)' => 'task/index/id/DESC/$1',
  'tasks/completed/([0-9]+)' => 'task/completed/$1',
  '' => 'task/index'
);