<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- <meta content="initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport"> -->
  <title>Sistem Informasi Masjid Ibnu Sina</title>

  <!-- favicon -->
  <link rel="shortcut icon" href="{{ route('home') }}/public/dist/assets/img/ibnusina.jpg">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <!-- fontawesome integrity integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" -->
  <!-- bootstrap integrity integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" -->

  <!-- JS Bootstrap -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->


  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('public/dist/bootstrap-daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/selectric/public/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/assets/css/multistep.css') }}">

  <link rel="stylesheet" href="{{ asset('public/dist/summernote/dist/summernote-bs4.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('public/dist/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/assets/css/components.css') }}">

  <!-- jQuery -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

  <!-- HTML2CANVAS -->
  <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

  <!-- Icofont -->
  <link rel="stylesheet" href="{{ asset('public/plugins/icofont/icofont.min.css') }}">

  <!-- Autonumeric JQuery -->
  <script src="{{ asset('public/js/autoNumeric.js') }}" type="text/javascript"> </script>


  <!-- JS image loader -->
  <script src="{{ asset('public/js/load-image.all.min.js') }}" type="text/javascript"> </script>

  <!-- DataTables -->
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
  <!-- export -->
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>

  <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script> -->
  <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">



  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

</head>
<style>
  td.details-control {
    background: url("http://www.datatables.net/examples/resources/details_open.png") no-repeat center center;
    cursor: pointer;
  }

  tr.shown td.details-control {
    background: url("http://www.datatables.net/examples/resources/details_close.png") no-repeat center center;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: none;
    color: white !important;
    border: 0px !important;
    background: #fff !important;
    box-shadow: inset 0 0 0px #fff !important;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button:active {
    background: none;
    color: white !important;
    border: 0px !important;
    background: #fff !important;
    box-shadow: inset 0 0 0px #fff !important;
  }
</style>