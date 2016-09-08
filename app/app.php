<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/hangman.php';

    session_start();
    if (empty($_SESSION['target_word'])) {
      $_SESSION['target_word'] = "";
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));


    $app->get('/', function() use($app){
      return $app['twig']->render('hangman.html.twig', array());
    });

    $app->get('/startplay', function() use($app){
      $current_game = Game::getTarget();
      $current_game->takeGuess();
      return $app['twig']->render('play.html.twig', array('game' => Game::getTarget()));
    });

    $app->post('/guess', function() use($app){
      $newguess = $_POST['takeGuess'];
      return $app['twig']->render('guess.html.twig', array('game' => Game::getTarget(), 'guessletter' => $newguess));

    });

    $app->get('/random', function() use($app){
      $words_array = ["dog", "cat", "fish", "fennec", "camel"];
      $target_word = rand (0, 4);
      $newGame = new Game($words_array[$target_word]);
      $newGame->save();
      return $app['twig']->render('random.html.twig', array('targetword' => $newGame));
    });


    return $app;
 ?>
