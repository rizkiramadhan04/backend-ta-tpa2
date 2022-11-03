 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
         <div class="sidebar-brand-text mx-1">Al-Muhibbin</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="{{ url('/') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Presensi
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="{{ route('admin.presensi') }}">
             <i class="fa-solid fa-clipboard-user"></i>
             <span>Jadwal Presensi</span>
         </a>
     </li>

     {{-- <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="{{ route('admin.data-presensi') }}">
             <i class="fas fa-fw fa-folder"></i>
             <span>Data Presensi</span>
         </a>
     </li> --}}

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Data Guru & Murid
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#data-master"
             aria-expanded="true" aria-controls="collapsePages">
             <i class="fa-solid fa-users"></i>
             <span>Data Guru & Murid</span>
         </a>
         <div id="data-master" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="{{ route('admin.guru') }}">
                     <h6 class="collapse-header">Data Guru</h6>
                 </a>
                 <a class="collapse-item" href="{{ route('admin.murid') }}">
                     <h6 class="collapse-header">Data Murid</h6>
                 </a>
             </div>
         </div>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Agenda Majelis
     </div>

     <!-- Nav Item - Tables -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#data-laporan"
             aria-expanded="true" aria-controls="collapsePages">
             <i class="fa-solid fa-calendar"></i>
             <span>Agenda</span>
         </a>
         <div id="data-laporan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="{{ route('admin.agenda') }}">
                     <h6 class="collapse-header">Data Agenda</h6>
                 </a>
             </div>
         </div>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Riwayat Pembayaran
     </div>

     <!-- Nav Item - Tables -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#data-suplier"
             aria-expanded="true" aria-controls="collapsePages">
             <i class="fa-solid fa-money-bill"></i>
             <span>Pembayaran</span>
         </a>
         <div id="data-suplier" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="{{ route('admin.pembayaran') }}">
                     <h6 class="collapse-header">Data Pembayaran</h6>
                 </a>
             </div>
         </div>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>


 </ul>
 <!-- End of Sidebar -->
