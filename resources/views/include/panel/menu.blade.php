<!-- Nav items -->
<ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link active" href="{{ url('/home') }}">
         <i class="ni ni-tv-2 text-red"></i>
         <span class="nav-link-text">Dashboard</span>
      </a>
   </li>
   <li class="nav-item">
      <a class="nav-link" href="{{ url('/specialty') }}">
         <i class="ni ni-planet text-orange"></i>
         <span class="nav-link-text">Especialidades</span>
      </a>
   </li>
   <li class="nav-item">
      <a class="nav-link" href="{{ url('/doctor') }}">
         <i class="ni ni-single-02 text-primary"></i>
         <span class="nav-link-text">Medicos</span>
      </a>
   </li>
   <li class="nav-item">
      <a class="nav-link" href="{{ url('/patient') }}">
         <i class="ni ni-satisfied text-yellow"></i>
         <span class="nav-link-text">Pacientes</span>
      </a>
   </li>
   <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}"
         onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
         <i class="ni ni-key-25 text-info"></i>
         <span class="nav-link-text">Cerrar Sesion</span>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
               @csrf
         </form>
      </a>
   </li>
</ul>
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading p-0 text-muted">
<span class="docs-normal">Reportes</span>
</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
   <li class="nav-item">
      <a class="nav-link" href="#" target="_blank">
         <i class="ni ni-collection text-yellow"></i>
         <span class="nav-link-text">Frecuencia de citas</span>
      </a>
   </li>
   <li class="nav-item">
      <a class="nav-link" href="#" target="_blank">
         <i class="ni ni-spaceship text-orange"></i>
         <span class="nav-link-text">Medicos más activos</span>
      </a>
   </li>
</ul>
