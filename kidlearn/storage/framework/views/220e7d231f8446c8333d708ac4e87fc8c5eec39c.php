<?php $__env->startSection('main'); ?>
    <div><?php if(session()->get('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-sm-12">

            <h1 class="display-3">Exercitii</h1>


            <br>
            <br>


            <div class="container">
                <form method="GET" action="<?php echo e(route('questions.index')); ?>" >
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group form-row justify-content-lg-start">
                        <span style="margin-left: 1em;"></span>
                        <select class="form-control col-sm-3" name="filter">
                            <option value="">--Filtrează--</option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span style="margin-left: 3em;"></span>
                        <select class="form-control col-sm-3" name="sorter">
                            <option value="">--Sortează--</option>
                            <option value="descScor">Cel mai mare punctaj</option>
                            <option value="ascScor">Cel mai mic punctaj</option>
                        </select>
                        <span style="margin-left: 2em;"></span>
                        <button type="submit" class="btn btn-primary">Aplică</button>

                    </div>
                </form>
                <br>
                <div class="row">
                    <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-4">
                            <div class="card-deck">
                                <div class="card border-secondary mb-3" style="max-width: 20rem;">
                                    <div class="card-header">
                                        <?php echo e($question->subject->subject); ?>

                                    </div>

                                    <div class="card-body" style="height: 7rem;">


                                        
                                        
                                        
                                        <p class="card-text"
                                           style="
                                           display: -webkit-box;
                                            -webkit-line-clamp: 3;
                                            -webkit-box-orient: vertical;
                                            overflow:hidden;
                                            text-overflow: ellipsis;
                                          ">
                                            <b><?php echo e($question->question); ?></b>
                                        </p>
                                    </div>


                                    <div class="card-footer text-muted ">
                                        <a href="<?php echo e(route('questions.show', $question->id)); ?>" class="card-link">Citește mai mult</a>
                                        <?php if(Auth::user()->role == 'Elev' ): ?>
                                        <a href="<?php echo e(route('createStudentAnswer', $question->id)); ?>" class="card-link">Răspunde</a>
                                        <?php endif; ?>
                                        <span class="badge badge-pill badge-secondary">Punctaj
                                            maxim: <?php echo e($question->max_points); ?>

                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>



    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    <br> <br>
    <?php echo $questions->appends(['sorter' => $sorter, 'filter' => $filter])->render(); ?>

    <br>
    <?php if(Auth::user()->role == 'Profesor'): ?>
    <td>
        <a href="<?php echo e(route('questions.create')); ?>" class="btn btn-primary">Adaugă o întrebare</a>
    </td>
<?php endif; ?>
    <div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/questions/index.blade.php ENDPATH**/ ?>