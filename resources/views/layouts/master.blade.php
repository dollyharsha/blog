<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Blog Admin</title>
      
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <!-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            
            <a class="navbar-brand ps-3">Welcome,{{Auth::user()->name}}</a>
    
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <!-- <button class="btn btn-primary" id="btnNavbarSearch" type="button">LogOut</button> -->


                    <a href="{{route('logout')}}"><button class="btn btn-primary" d="btnNavbarSearch" type="button">Logout</button></a>
                </div>
            </form>
          
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Create Blogs</div>
                            <a  href="{{url('user/dashboard')}}"class="nav-link" >
                                <div class="sb-nav-link-icon"></div>
                                Create Blog
                            </a>
                            <a href="{{url('blog/show')}}" class="nav-link">
                                <div class="sb-nav-link-icon"></div>
                                All Blogs
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{Auth::user()->name}}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
            @yield('content')
            </div>
        </div>
    </body>
</html>
