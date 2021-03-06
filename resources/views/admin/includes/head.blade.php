<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    @if(Auth::user()->type == 'admin')
    <title>Admin</title>
    @else
    <title>Business</title>
    @endif
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="{{asset('admin/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{asset('admin/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="{{asset('admin/css/morris/morris.css')}}" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="{{asset('admin/css/jvectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="{{asset('admin/css/datepicker/datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <!-- <link href="{{asset('admin/css/fullcalendar/fullcalendar.css')}}" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <link href="{{asset('admin/css/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="{{asset('admin/css/iCheck/all.css')}}" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link href="{{asset('admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" type="text/css" /> -->
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- Theme style -->
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css" />



    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->

          <style type="text/css">

          </style>
      </head>
      <body class="skin-black">
