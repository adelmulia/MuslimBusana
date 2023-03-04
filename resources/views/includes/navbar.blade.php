<nav class="navbar navbar-expand-lg navbar-dark">
     <div class="container">
         <a class="navbar-brand" href="{{url('/')}}">
             <img src="{{ url('frontend/img/logo_small.png') }}" alt="logo-small">
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
             aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav text-uppercase mx-auto">
                 <li class="nav-item active">
                     <a class="nav-link" href="{{ url('/')}}">Home </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">Category</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">Designer</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">About</a>
                 </li>
                 @if (auth()->guard('customer')->check())
                    <li class="nav-item"><a class="nav-link" href="{{ route('customer.logout') }}">Logout</a></li>
                @else
                    <<li class="nav-item"><a class="nav-link" href="{{ route('customer.login') }}">Login</a></li>
                @endif
             </ul>
             <a href="{{ route('front.list_cart')}}" class="nav-link text-white"><i class="fas fa-shopping-cart"></i>My Cart <span>
                     (12)</span></a>
         </div>
     </div>
 </nav>