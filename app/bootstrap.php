<?php

/**
 * My Application bootstrap file.
 */
use Nette\Application\Routers\Route;



// Load Nette Framework
require LIBS_DIR . '/Nette/loader.php';

// Configure application
$configurator = new Nette\Config\Configurator;

// Enable Nette Debugger for error visualisation & logging
//$configurator->setDebugMode($configurator::AUTO);
$configurator->enableDebugger(__DIR__ . '/../log');

// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
	->addDirectory(APP_DIR)
	->addDirectory(LIBS_DIR)
	->register();

// Create Dependency Injection container from config.neon file
$configurator->addConfig(__DIR__ . '/config/config.neon');
$container = $configurator->createContainer();

Nette\Forms\Controls\CheckboxList::register();


// Setup router

$container->router[] = new Route('index.php', 'Homepage:default', Route::ONE_WAY);


$container->router[] = new Route('prihlaseni', array('presenter'=>'Sign','action'=>'in'));

$container->router[] = new Route('kontaktni-formular', array('presenter'=>'Homepage','action'=>'contact'));

$container->router[] = new Route('vyhledavani/[<s_search>][/<s_user>]', 'Search:default');

//$container->router[] = new Route('[<incompleteTasks-paginator-page [0-9]+>]', 'Homepage:default');

//$container->router[] = new Route('projekt/[<id [0-9]+>]/[<task_id>]', 'Task:detail');


//$container->router[] = new Route('projekt/[<id [0-9]+>]', 'Task:default');


$container->router[] = new Route('projekt/<id>',
                                 array('id'=>array(
                                Route::FILTER_IN =>function($id) use ($container){
                                        if(is_numeric($id)){
                                            return $id;
                                        }
                                        else{ 
                                            /** @var $tasklist \Nette\Table\Selection **/
                                            return $container->createTasklists()->where('uri',$id)->fetch()->id;
                                        }
                                 },
                                 Route::FILTER_OUT =>function($id) use ($container){
                                        if(!is_numeric($id)){
                                            return $id;
                                        }else{
                                            /** @var $tasklist \Nette\Table\Selection **/
                                            return $container->createTasklists()->get($id)->uri;
                                        }
                                 }),'presenter'=>'Task','action'=>'default'));
                                 
                                 
$container->router[] = new Route('projekt/<id>/<task_id>',
                                 array('id'=>array(
                                Route::FILTER_IN =>function($id) use ($container){
                                        if(is_numeric($id)){
                                            return $id;
                                        }
                                        else{ 
                                            /** @var $tasklist \Nette\Table\Selection **/
                                            return $container->createTasklists()->where('uri',$id)->fetch()->id;
                                        }
                                 },
                                 Route::FILTER_OUT =>function($id) use ($container){
                                        if(!is_numeric($id)){
                                            return $id;
                                        }else{
                                            /** @var $tasklist \Nette\Table\Selection **/
                                            return $container->createTasklists()->get($id)->uri;
                                        }
                                 }),'task_id'=>array(
                                 Route::FILTER_IN =>function($task_id) use ($container){
                                        if(is_numeric($task_id)){
                                            return $task_id;
                                        }
                                        else{ 
                                            /** @var $task \Nette\Table\Selection **/
                                            return $container->createTasks()->where('text',$task_id)->fetch()->id;
                                        }
                                 },
                                 Route::FILTER_OUT =>function($task_id) use ($container){
                                        if(!is_numeric($task_id)){
                                            return $task_id;
                                        }else{
                                            /** @var $task \Nette\Table\Selection **/
                                            return $container->createTasks()->get($task_id)->text;
                                        }
                                 }),'presenter'=>'Task','action'=>'detail'));
                                 
             
                                 
                                 
//$container->router[] = new Route('projekt/[<id [0-9]+>]/[<task_id [0-9]+>]', 'Task:detail');

                                 
 
$container->router[] = new Route('text/<id>',
                                 array('id'=>array(
                                Route::FILTER_IN =>function($id) use ($container){
                                        if(is_numeric($id)){
                                            return $id;
                                        }
                                        else{
                                            /** @var $tasklist \Nette\Table\Selection **/
                                            return $container->createCms()->where('nadpis',$id)->fetch()->id;
                                        }
                                 },
                                 Route::FILTER_OUT =>function($id) use ($container){
                                        if(!is_numeric($id)){
                                            return $id;
                                        }
                                        else{
                                            /** @var $tasklist \Nette\Table\Selection **/
                                            return $container->createCms()->get($id)->nadpis;
                                        }
                                 }),'presenter'=>'Cms','action'=>'default'));

$container->router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');

// Configure and run the application!
$container->application->run();
