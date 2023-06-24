<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GMSPortail</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  {{-- FullCalendar librairie --}}
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">

  
  <!-- style -->
  @yield('css')
  
  <link rel="stylesheet" href="{{asset('adminlte/css/adminlte.min.css')}}">

  
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Barre de navigation -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      
      <!-- Barre de navigation de gauche -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Barre de navigation de droite -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        

        {{-- Profile dropdown --}}
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
            <img
              src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp"
              class="rounded-circle"
              height="25"
              alt="Black and White Portrait of a Man"
              loading="lazy"
            />
            
          </a>
          
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header bg-info h1" style="font-size: px">{{Auth::user()->prenom}}</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-user mr-2"></i>Mon profile
            </a>
            <a href="#" class="dropdown-item">
              <i class="fas fa-cog mr-2"></i> Paramètres
            </a>
           
              <form  class="dropdown-item" method="POST" action="/logout">
                @csrf
                <button type="submit" class="btn">
                  <i class="fas fa-sign-out-alt mr-2"></i> Se deconnecter
                </button>
              </form>
           
          </div>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Barre laterale de gauche pour lien de gestion  -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset('adminlte/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">OMAG</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{route('documents')}}" class="nav-link">
                <i class="nav-icon fas fa-folder" aria-hidden="true"></i>
                <p>
                  Documents
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('factures')}}" class="nav-link">
                <i class='nav-icon fas fa-money-check'></i>
                <p>
                  Factures
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('planning.index') }}" class="nav-link">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                  Tâches et Planning
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('tickets')}}" class="nav-link">
                {{-- <i class='nav-icon fas fa-envelope'></i> --}}
                <i class="nav-icon fas fa-ticket-alt" ></i>
                <p>
                  Tickets
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('clients')}}" class="nav-link">
                <i class="nav-icon fas fa-handshake"></i>
                <p>
                  Clients
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('sites')}}" class="nav-link">
                <i class="nav-icon fas fa-shield-alt"></i> 
                <p>
                  Sites
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('employes')}}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Employés
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/users" class="nav-link">
                <i class="nav-icon fas fa-user-alt"></i>
                <p>
                  Utilisateurs
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('options')}}" class="nav-link">
                <i class="nav-icon fa fa-cogs fa-fw" aria-hidden="true"></i>
                <p>
                  Options
                  {{-- <span class="right badge badge-danger">New</span> --}}
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Contenu Principal-->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              {{-- <h1 class="m-0">Accueil</h1> --}}
            </div><!-- /.col -->
            <div class="col-sm-6">
              {{-- <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Accueil</li>
              </ol> --}}
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          
          @yield('main')

        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Tout ce que vous voulez
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2017-2023 <a href="https://ronasdeg.go.yo.fr">Ronasdev</a>.</strong> Tout droit réservé.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  
  
  <!-- AdminLTE App -->
  <script src="{{asset('adminlte/js/adminlte.min.js')}}"></script>

  @yield('js')


  <script>
    let links = document.querySelectorAll('.nav-link');
    links.forEach(link => {
    
      link.addEventListener('click',(e)=>{
        e.target.classList.add('active');

        links.forEach(elt=>{
          if (elt != e.target) {
            elt.classList.remove("active");
          }
        })

      })
    });
  </script>

  

</body>
</html>
