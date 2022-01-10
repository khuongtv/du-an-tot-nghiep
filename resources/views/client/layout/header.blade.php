<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from jobword.utouchdesign.com/jobword_ltr/index-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Sep 2021 04:38:57 GMT -->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="">
  <meta name="theme-color" content="#ff8a00">
  <meta name="description" content="Job Portal HTML Template">
  <meta name="keywords" content="Employment, Naukri, Shine, Indeed, Job Posting, Job Provider">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'JobS')</title>

  <!--  Favicon -->
  <link rel="shortcut icon" href="{{asset('theme/client')}}/images/icon.png">

  <!-- CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

  <!-- CSS -->
  <link rel="stylesheet" href="{{asset('theme/client')}}/css/bootstrap-grid.css">
  <link rel="stylesheet" href="{{asset('theme/client')}}/css/icons.css">
  <link rel="stylesheet" href="{{asset('theme/client')}}/css/style.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;display=swap" rel="stylesheet">
  @yield('style')

  <style>
    .verify p {
      text-align: center;
      background: red;
      color: #fff;
      margin: 0;
      line-height: 38px !important;
    }
  </style>
</head>