<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'KidLearn')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/bootstrap.css')); ?>" rel="stylesheet">
</head>
<body>
<div id="app">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <?php echo e(config('app.name', 'KidLearn')); ?>

            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03"
                    aria-controls="navbarColor03" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <!-- Left Side Of Navbar -->
            

            



            <!-- Authentication Links -->
            <?php if(auth()->guard()->guest()): ?>
                <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Autentificare')); ?></a>
                        </li>
                        <?php if(Route::has('register')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Înregistrare')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
            <?php else: ?>
                <?php if(Auth::user()->role == 'Profesor' || Auth::user()->role == 'Administrator'): ?>
                    <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-0">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('students.index')); ?>"><?php echo e(__('Elevi')); ?></a>
                            </li>
                            <li>
                                <a class="nav-link" href="<?php echo e(route('studentClasses.index')); ?>"><?php echo e(__('Clase')); ?></a>
                            </li>
                            
                            
                            
                            
                            
                            
                            <li>
                                <a class="nav-link" href="<?php echo e(route('subjects.index')); ?>"><?php echo e(__('Materii')); ?></a>
                            </li>
                            <li>
                                <a class="nav-link" href="<?php echo e(route('questions.index')); ?>"><?php echo e(__('Exerciții')); ?></a>
                            </li>
                            <li>
                                <a class="nav-link" href="<?php echo e(route('studentAnswers.index')); ?>"><?php echo e(__('Răspunsuri')); ?></a>
                            </li>
                            
                            
                            


                        </ul>

                        <ul class="navbar-nav ml-auto">

                            <form class="form-inline my-2 my-lg-0" action="<?php echo e(route(('searchStudent'))); ?>" method="POST"
                                  role="search">
                                <?php echo e(csrf_field()); ?>

                                <input class="form-control mr-sm-2" type="text" placeholder="Caută" name="searchName">
                                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Caută</button>
                            </form>
                            <?php endif; ?>



                            <?php if(Auth::user()->role == 'Elev'): ?>
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo e(route('students.index')); ?>"><?php echo e(__('Elevi')); ?></a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="<?php echo e(route('questions.index')); ?>"><?php echo e(__('Exerciții')); ?></a>
                                    </li>
                                    <li>
                                        <a class="nav-link"
                                           href="<?php echo e(route('studentAnswers.index')); ?>"><?php echo e(__('Răspunsuri')); ?></a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav ml-auto"></ul>
                            <?php endif; ?>

                            <?php if(Auth::user()->role == 'Administrator'): ?>
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo e(route('admin.index')); ?>"><?php echo e(__('Utilizatori')); ?></a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav ml-auto"></ul>
                            <?php endif; ?>


                            <ul class="navbar-nav ml-auto">






                                <li class="nav-item">
                                    <?php if(Auth::user()->role == 'Elev'): ?>
                                        <a class="nav-link" href="<?php echo e(route('changePassword')); ?>"><?php echo e(Auth::user()->name); ?></a>
                                        <?php else: ?>
                                        <a class="nav-link" href="#"><?php echo e(Auth::user()->name); ?></a>
                                        <?php endif; ?>

                                </li>
                                <li class="nav-item">

                                    <a class="nav-link" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"><?php echo e(__('Ieși din cont')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                          style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </li>
                            </ul>

                        </ul>

                    <?php endif; ?>


            </div>
        </div>
    </nav>


    <main class="py-4">
        <?php echo $__env->yieldContent('content'); ?>
    </main>


    
    
    
    
    

    
    

    
    

    
    
    
    
    
    
    

    
    
    
    
    
    
    

    
    
    
    
    
    
    

    

    

    


    
</div>
</body>
</html>

<?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/layouts/app.blade.php ENDPATH**/ ?>