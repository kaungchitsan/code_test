<?php
function active($currect_page){
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);  
    if($currect_page == $url){
        echo 'active'; //class name in css 
    } 
}
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="index.php" target="_blank">
        <img src="{{asset('assets/icon/codetest.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Code Test</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php active('clients');?>" href="{{url('/admin/clients')}}">
            <i class="fas fa-user"></i>
            <span class="nav-link-text ms-1">Client</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php active('billings');?>" href="{{url('/admin/billings')}}">
            <i class="fas fa-usd"></i>
            <span class="nav-link-text ms-1">Billing</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>