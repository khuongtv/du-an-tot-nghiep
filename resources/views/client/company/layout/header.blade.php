<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from jobword.utouchdesign.com/jobword_ltr/dashboard-manage-resume.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Sep 2021 04:49:11 GMT -->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="">
  <meta name="theme-color" content="#ff8a00">
  <meta name="description" content="Job Portal HTML Template">
  <meta name="keywords" content="Employment, Naukri, Shine, Indeed, Job Posting, Job Provider">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'company')</title>

  <!--  Favicon -->
  <link rel="shortcut icon" href="{{asset('theme/client')}}/images/icon.png">

  <!-- CSS -->
  <link rel="stylesheet" href="{{asset('theme/client')}}/css/bootstrap-grid.css">
  <link rel="stylesheet" href="{{asset('theme/client')}}/css/icons.css">
  <link rel="stylesheet" href="{{asset('theme/client')}}/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
  <!-- Google Fonts -->
  <!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

  <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;display=swap" rel="stylesheet">
<!--Ckeditor-->
<link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link href="a/assets/css/demo.css" rel="stylesheet" />
    <script type="text/javascript" src="{{asset('theme/client')}}/ckeditor/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <style>
  .text-danger{
    color:red;
    
  }
  .utf-manage-resume-overview-aera .utf-manage-resume-avatar img{
    max-width: 70px !important;
    max-height: 70px !important;
    width: 70px !important;
    height: 70px !important;
    padding: 2px;
    border-radius: 50px;
    object-fit: cover;
    transform: translate3d(0, 0, 0);
  }
  .utf-job-listing .utf-job-listing-company-logo img {
	max-width: 75px !important;
	max-height: 75px !important;
	width:100%;
	height:100px;
	padding:2px;
	border-radius: 50px;
	object-fit: cover;
	transform: translate3d(0, 0, 0);
}
.utf-manage-resume-avatar{
  max-width: 70px !important;
    max-height: 70px !important;
    width: 70px !important;
    height: 70px !important;
    padding: 2px;
    border-radius: 50px;
    object-fit: cover;
    transform: translate3d(0, 0, 0);
}
.user-avatar img{
   max-width: 50px !important;
    max-height: 50px !important;
    width: 50px !important;
    height: 50px !important;
    padding: 2px;
    border-radius: 50px;
    object-fit: cover;
    transform: translate3d(0, 0, 0);
}
.dashboard-profile-box img {
    max-width: 70px !important;
    max-height: 70px !important;
    width: 70px !important;
    height: 70px !important;
    padding: 2px;
    border-radius: 50px;
    object-fit: cover;
    transform: translate3d(0, 0, 0);
}

/* Thiết kẻ thẻ select */
select {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  appearance: none;
  outline: 0;
  box-shadow: none;
  border: 0 !important;
  background: White;
  background-image: none;
  margin-bottom: 20px !important;
}

.select {
  position: relative;
  display: flex;
  width: 14em;
  height: 3em;
  line-height: 3;
  margin-b;
  overflow: hidden;
  border-radius: .25em;
}
select {
  flex: 1;
  padding: 0 .5em;
  color: black;
  cursor: pointer;
}


.alertify-notifier .ajs-message.ajs-success {
  z-index: 1000000 !important;
}

/* thiết kế dấu mũi tên */
.select::after {
  content: '\25BC';
  position: absolute;
  top: 0;
  right: 0;
  padding: 0 1em;
  background: White;
  cursor: #424242;
  pointer-events: none;
  -webkit-transition: .25s all ease;
  -o-transition: .25s all ease;
  transition: .25s all ease;
  color: #424242;
}
/* Transition */


</style>
  </head>
<body>