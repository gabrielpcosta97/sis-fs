
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <li><a href="{{ route('infraestrutura') }}">Infra <i class="material-icons">square_foot</i></a></li>
  <li><a href="{{ route('login/logout') }}" id="btn-sair">Sair <i class="material-icons">logout</i></a></li>
</ul>

<div class="progress" id="load-nav" style="display: none;">
  <div class="indeterminate"></div>
</div>
<nav class="blue darken-1">
  <div class="container">
    <div class="nav-wrapper">
      <a href="{{ route('home') }}" class="brand-logo">
        <img src="{{ asset('assets/images/logo.png') }}" width="50px">
        <span class="hide-on-med-and-down">
          Sistema de informações em saúde da FS
        </span>
      </a>
      <a href="#" data-target="sidebar-menu" class="sidenav-trigger">
        <i class="material-icons">menu</i>
      </a>
      <ul class="right hide-on-med-and-down">
        @if(Auth::check())
          <li>
            <a class="dropdown-trigger" href="#!" data-target="dropdown1">
              @php
                $arr_name = explode(' ', Auth::user()->name);
              @endphp
              <span>{{ $arr_name[0] }}</span>
              <i class="material-icons right">arrow_drop_down</i>
            </a>
          </li>
        @else
          <li><a href="#modal-login" class="modal-trigger">Login</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>

<!-- SIDEBAR MENU -->
<ul id="sidebar-menu" class="sidenav blue light-3" style="z-index: 9999;">
  <div class="sidebar-logo">
    <img src="{{ asset('assets/images/logo.png') }}" width="40px">
    <span style="font-weight: bold; color: white;">Sis-FS</span>
  </div>
  @if(Auth::check())
    <li>
      <a class="dropdown-trigger" href="#!" data-target="dropdown1">
        @php
          $arr_name = explode(' ', Auth::user()->name);
        @endphp
        <span>{{ $arr_name[0] }}</span>
        <i class="material-icons right">arrow_drop_down</i>
      </a>
    </li>
  @else
    <li><a href="#modal-login" class="modal-trigger">Login</a></li>
  @endif
</ul>


        