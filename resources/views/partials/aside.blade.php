 <aside class="main-sidebar elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
      <h2 class="brand-text font-weight-bolder text-center" style="color:#007bff">{{ $app->nom }}</h2>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dashboard/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block" style="color:#6c757d">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a id="ac" href="{{route('admin.dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tableau de bord
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-invoice"></i>
              <p>
                Factures
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('facture.create')}}" class="nav-link">
                  <i class="fas fa-file-invoice-dollar nav-icon"></i>
                  <p>Etablir une facture</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('facture.index')}}" class="nav-link">
                  <i class="fas fa-file-alt nav-icon"></i>
                  <p>Liste des factures</p>
                </a>
              </li>

            </ul>
          </li>
          @if(auth()->user()->role == "admin")
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>
                    Utilisateurs
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                    <i class="fas fa-user-friends nav-icon"></i>
                    <p>Liste des utilisateurs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.create')}}" class="nav-link">
                    <i class="fas fa-user-plus nav-icon"></i>
                    <p>Ajouter un utilisateur</p>
                    </a>
                </li>

                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('setting.societe') }}" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Configuration
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Historiques
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="pages/forms/general.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Liste des factures</p>
                    </a>
                </li>

                </ul>
            </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
