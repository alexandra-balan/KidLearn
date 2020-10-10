<?php $__env->startSection('main'); ?>
    <div><?php if(session()->get('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?></div>
    <div class="row">
        <div class="col-sm-12">


            <br>


 <?php if(count($students)): ?>

                        <table class="table table-hover">
                            <thead>
                            <tr class="table-primary">
                                <td>Elevi</td>
                                <td>Scor</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            <div class="container">
                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="table-active">
                                <td><?php echo e($student->name); ?> </td>
                                <td><?php echo e($student->score); ?> </td>
                                <?php if(Auth::user()->id == $student->user_id || Auth::user()->role == 'Profesor'): ?>
                                    <td>
                                        <a href="<?php echo e(route('students.show',$student->id)); ?>" class="btn btn-primary">Detalii</a>
                                    </td>
                                    <?php endif; ?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     <?php endif; ?>


     <?php if(count($questions)): ?>
                 <table class="table table-hover">
                     <thead>
                     <tr class="table-primary">
                         <td>Intrebari</td>
                         <td colspan="2"></td>
                     </tr>
                     </thead>
                     <tbody>
                     <div class="container">
         <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <tr class="table-active">
                 <td><?php echo e(substr($question->question, 0,150)); ?> </td>
                 <td>        <a href="<?php echo e(route('questions.show', $question->id)); ?>" class="card-link">Citește mai mult</a>
                 </td>
             </tr>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     <?php endif; ?>



            <div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/students/searchResult.blade.php ENDPATH**/ ?>