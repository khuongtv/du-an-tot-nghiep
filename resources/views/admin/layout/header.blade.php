<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Admin')</title>
    <link rel="icon" type="image/png" href="{{asset('theme/client')}}/images/icon.png">
    <link href="{{asset('theme/admin')}}/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="{{asset('theme/admin')}}/assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('theme/admin')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('theme/admin')}}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{asset('theme/admin')}}/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="{{asset('theme/admin')}}/assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <link href="{{asset('theme/admin')}}/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{asset('theme/admin')}}/assets/css/elements/custom-pagination.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    <link href="{{asset('theme/admin')}}/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="assets/css/elements/alert.css">
    <style>
        .btn-light {
            border-color: transparent;
        }
    </style>
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('theme/admin')}}/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/admin')}}/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/admin')}}/plugins/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/admin')}}/plugins/table/datatable/custom_dt_custom.css">
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    <!--  END CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{asset('theme/admin/plugins/dropify/dropify.min.css')}}">
    <link href="{{asset('theme/admin/assets/css/users/account-setting.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <!-- <link href="{{asset('theme/admin/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="{{asset('theme/admin/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" /> -->
    <link href="{{asset('theme/admin')}}/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('theme/admin')}}/assets/css/forms/theme-checkbox-radio.css">
    <link href="{{asset('theme/admin')}}/assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
    <!-- <link href="{{asset('theme/admin')}}/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('theme/admin')}}/plugins/bootstrap-select/bootstrap-select.min.css"> -->
    <link href="{{asset('theme/admin')}}/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('theme/admin')}}/plugins/select2/select2.min.css">
    @yield('links')
</head>

<body>