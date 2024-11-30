<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=$cssFile ?? 'assets/css/backend.css'?>">
  <link rel="stylesheet" href="<?=$css?>icons.css">
  <link rel="stylesheet" href="<?=$css?>alertify.rtl.min.css">
  <link rel="stylesheet" href="<?=$css?>default.rtl.min.css">
  <link rel="stylesheet" href="<?=$css?>bootstrap.rtl.css">
  <link rel="stylesheet" href="<?=$css?>bootstrap-icons.css">
  <link rel="shortcut icon" href="http://myschool.great-site.net/assets/images/rome.svg" type="image/x-icon">
  <title><?= (Session::has('app') ?  Session::get('app')  . '  |  ' . $pageTitle  : $pageTitle) ?? 'Unknown page'?> </title>
  <style>
    * {font-family: 'cairo';}
    .ajs-header {font-family: 'cairo' !important; color:#0d6efd !important}
  </style>
</head>
<body class="<?=$bodyClass ?? ''?>" id="page-top">
