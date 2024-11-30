<?php

  require_once '../../init.php';
  $dots = '../../';

  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : exit();
  
  Component::header(['title' => 'حذف مستخدم']);

  $userID = filter($_GET['id'], 'int');
  
  @$user = (new User)->find($userID);
?>

<div class="d-flex align-items-center justify-content-center mt-4 flex-column">
  <h1 class="text-center">هل تريد حقاً حذف "<?=@$user->fullName?>" ؟ </h1>
  <form action="http://myschool.great-site.net/src/functions/deleteUser" method="post">
    <input type="hidden" name="id" value="<?=@$user->id?>">
    <button class="btn btn-outline-danger">حذف المستخدم</button>
  </form>
</div>
