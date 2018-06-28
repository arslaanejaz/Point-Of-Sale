@extends('layouts.landing')

@section('content')
<div id="o-wrapper" class="o-wrapper">
<nav id="c-menu--slide-left" class="c-menu c-menu--slide-left">
  <button class="c-menu__close">&larr; Close Menu</button>
  <ul class="c-menu__items">
    <li class="c-menu__item"><a href="#" class="c-menu__link">Home</a></li>
    <li class="c-menu__item"><a href="{{ url('/transaction') }}" class="c-menu__link">Transaction</a></li>
    <li class="c-menu__item"><a href="{{ url('/transaction') }}" class="c-menu__link">Transaction List</a></li>
    <li class="c-menu__item"><a href="{{ url('/salereturn') }}" class="c-menu__link">Sale Return</a></li>
    <li class="c-menu__item"><a href="{{ url('/purchase') }}" class="c-menu__link">Purchase</a></li>
    <li class="c-menu__item"><a href="{{ url('/purchasereturn') }}" class="c-menu__link">Purchase Return</a></li>
    <li class="c-menu__item"><a href="{{ url('/inventory') }}" class="c-menu__link">Inventory</a></li>
    <li class="c-menu__item"><a href="{{ url('/item') }}" class="c-menu__link">Item</a></li>
    <li class="c-menu__item"><a href="{{ url('/supplier') }}" class="c-menu__link">Supplier</a></li>
    <li class="c-menu__item"><a href="{{ url('/customer') }}" class="c-menu__link">customer</a></li>
    <li class="c-menu__item"><a href="{{ url('/reports') }}" class="c-menu__link">Reports</a></li>
    <li class="c-menu__item"><a href="{{ url('/paymentvoucher') }}" class="c-menu__link">Payment Voucher</a></li>
    <li class="c-menu__item"><a href="{{ url('/auth/logout') }}" class="c-menu__link">Logout ( admin )</a></li>
  </ul>
</nav>

</div>

<section class="inner-content">
	
    <div class="container">
    
    	<div class="row">
         
          <div class="seprate">	
            
            <div class="col-lg-3 col-md-3 col-sm-3 outer">	
                <a href="{{ url('/transaction') }}">
                <div class="thumbnail li-first jt_pb_animation_top jt-waypoint">
                <i class="fa fa-shopping-cart"></i>
                	<h3>Transaction</h3>
                </div>
                </a>
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-3 outer">	
                <a href="{{ url('/purchase') }}">
                <div class="thumbnail li-second jt_pb_animation_top jt-waypoint">
                <i class="fa fa-cart-arrow-down"></i>
               		<h3>Purchase</h3>
                </div>
                </a>
            </div>
            
            
            <div class="col-lg-3 col-md-3 col-sm-3 outer">	
                <a href="{{ url('/salereturn') }}">
                <div class="thumbnail li-third jt_pb_animation_top jt-waypoint">
                <i class="fa fa-repeat"></i>
                	<h3>Sale Return</h3>
                </div>
                </a>
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-3 outer">	
                <a href="{{ url('/purchasereturn') }}">
                <div class="thumbnail li-third jt_pb_animation_top jt-waypoint">
                <i class="fa fa-repeat"></i>
                	<h3>Purchase Return</h3>
                </div>
                </a>
            </div>
            
            
            
            
            
         </div>  
         </div>
         
         
         <div class="row">
          <div class="seprate">	
          
		  <div class="col-lg-3 col-md-3 col-sm-3 outer">	
                <a href="{{ url('/inventory') }}">
                <div class="thumbnail li-forth jt_pb_animation_top jt-waypoint">
                <i class="fa fa-bar-chart"></i>
                	<h3>Inventory</h3>
                </div>
                </a>
            </div>
          
           <div class="col-lg-3 col-md-3 col-sm-3 outer">	
               <a href="{{ url('/users') }}">
                <div class="thumbnail li-five jt_pb_animation_top jt-waypoint">
                <i class="fa fa-user-secret"></i>
                	<h3>USER ACCOUNTS</h3>
                </div>
               </a> 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 outer">	
              	<a href="{{ url('/supplier') }}">
                <div class="thumbnail li-six jt_pb_animation_top jt-waypoint">
                <i class="fa fa-truck"></i>
                	<h3>SUPPLIERS</h3>
                </div>
                </a>
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-3 outer">	
              <a href="{{ url('/brand') }}">
              
                <div class="thumbnail li-seven jt_pb_animation_top jt-waypoint">
                	 <i class="fa fa-th-large"></i>
                    <h3>ITEM BRAND</h3>
                   
                </div>
                </a>
            </div>
            </div>
            </div>
          
            
            
         
         
          <div class="row">
          <div class="seprate">	
          	
           <div class="col-lg-3 col-md-3 col-sm-3 outer">	
               <a href="{{ url('/category') }}">
                <div class="thumbnail li-eight jt_pb_animation_top jt-waypoint">
                <i class="fa fa-th-large"></i>
                	<h3>ITEM CATEGORY</h3>
                </div>
              </a>  
            </div>
            
          <div class="col-lg-3 col-md-3 col-sm-3 outer">
                <a href="{{ url('/customer') }}">
                <div class="thumbnail li-nine jt_pb_animation_top jt-waypoint">
                <i class="fa fa-user"></i>
                	<h3>CUSTOMR</h3>
                </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 outer">	
                <a href="{{ url('/item') }}">
                <div class="thumbnail li-ten jt_pb_animation_top jt-waypoint">
                <i class="fa fa-th-large"></i>
                	<h3>Items</h3>
                </div>
               </a>
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-3 outer">	
                <a href="{{ url('/paymentvoucher') }}">
                <div class="thumbnail li-ten jt_pb_animation_top jt-waypoint">
                <i class="fa fa-th-large"></i>
                	<h3>Payment Voucher</h3>
                </div>
               </a>
            </div>
            
            
            
         </div>
        </div>
        
        <div class="row">
          <div class="seprate">	
          <div class="col-lg-3 col-md-3 col-sm-3 outer">
                <a href="{{ url('/reports') }}">
                <div class="thumbnail li-nine jt_pb_animation_top jt-waypoint">
                <i class="fa fa-th-large"></i>
                	<h3>Reports</h3>
                </div>
                </a>
            </div>
          </div>
          </div>
        
    </div>

</section>












    
	 


@endsection
