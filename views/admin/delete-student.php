<?php

  require_once '../../init.php';
  $dots = '../../';

  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : exit();
  
  Component::header(['title' => 'حذف تلميذ']);

  $id = filter($_GET['id'], 'int');
  
  @$student = (new Student)->find($id);
?>
<div class="container mt-5">
  <div class="card shadow w-50 mx-auto">   
    <div class="card-header text-center text-primary">
    حذف تلميذ
    </div> 
    <div class="card-body">
      <div class="d-flex align-items-center justify-content-center mt-4 flex-column">
        <h5 class="text-center mb-4">هل تريد حقاً حذف  "<?=@$student->fullName?>" ؟ </h5>
          <form action="http://myschool.great-site.net/src/functions/deleteStudent" method="post">
            <input type="hidden" name="id" value="<?=@$student->id?>">
            <button class="btn btn-outline-danger">
              <i class="bi bi-trash-fill ml-1"></i>
              حذف
            </button>
          </form>
        </div>
    </div>
  </div>
</div>