@extends('layouts.main')

@section('content')
    <!-- carousel -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel ">
     <div class="carousel-inner">
         <div class="container">
             <div class="carousel-item active">

                 <div class="row pt-5 justify-content-center">
                     <div class="col-9 col-sm-4 col-md-6 col-lg-5">
                         <h1 class="mb-4">Spesial Eid Lebaran</h1>
                         <p class="mb-4">Jadikan hari pertama lebaranmu meriah dan memorable</p>
                         <a href="single.html" class="btn btn-warning bg-warning text-white">Get It Now</a>
                     </div>
                     <div class="col-3 col-sm-6 col-md-4 col-lg-5 d-none d-sm-block offset-1">
                         <img src="{{ url ('frontend/img/slide show/1.png') }}" alt="" class="img-fluid" width="200">
                     </div>
                 </div>

             </div>
             <div class="carousel-item">
                 <div class="row pt-5 justify-content-center">
                     <div class="col-9 col-sm-4 col-md-6 col-lg-5">
                         <h1 class="mb-4">Spesial Eid Adha</h1>
                         <p class="mb-4">Jadikan hari pertama idul adha lebih indah</p>
                         <a href="single.html" class="btn btn-warning bg-warning text-white">Get It Now</a>
                     </div>
                     <div class="col-3 col-sm-6 col-md-4 col-lg-5 d-none d-sm-block offset-1">
                         <img src="{{ url ('frontend/img/slide show/1.png') }}" alt="" class="img-fluid" width="200">
                     </div>
                 </div>
             </div>
             <div class="carousel-item">
                 <div class="row pt-5 justify-content-center">
                     <div class="col-9 col-sm-4 col-md-6 col-lg-5">
                         <h1 class="mb-4">Spesial Hari Raya Islam</h1>
                         <p class="mb-4">Marhaban Ya Muharram Selamat Menyambut Tahun Baru Islam 1446 H </p>
                         <a href="single.html" class="btn btn-warning bg-warning text-white">Get It Now</a>
                     </div>
                     <div class="col-3 col-sm-6 col-md-4 col-lg-5 d-none d-sm-block offset-1">
                         <img src="{{ url ('frontend/img/slide show/1.png') }}" alt="" class="img-fluid" width="200">
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="sr-only">Previous</span>
     </a>
     <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="sr-only">Next</span>
     </a>
 </div>
 <!-- akhir carousel -->

 <!-- brands -->
 <section class="brands">
     <div class="container">
         <div class="row p-5 text-center">
             <div class="col -md">
                 <img src="{{ url ('frontend/img/brands/bank.png') }}" alt="" class="img-fluid">
             </div>
             <div class="col-md">
                 <img src="{{ url ('frontend/img/brands/alhazen.jpeg') }}" alt="" class="img-fluid">
             </div>
             <div class="col-md">
                 <img src="{{ url ('frontend/img/brands/fesyar.png') }}" alt="" class="img-fluid">
             </div>
             <div class="col-md">
                 <img src="{{ url ('frontend/img/brands/isef.png') }}" alt="" class="img-fluid">
             </div>
         </div>

 </section>
 <!-- akhir brands -->

 <!-- features -->
 <section class="features bg-light p-5">
     <div class="container">
         <div class="row mb-3">
             <div class="col">
                 <h3>Spesial Eid</h3>
                 <p>Promo pakaian cocok untuk lebaran</p>
             </div>
         </div>

         <div class="row">
            @forelse ($data as $item)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <figure class="figure">
                    <div class="figure-img">
                        <img src="{{ asset('storage/uploads/' . $item->image) }}"  alt="">
                        <a href="{{ route('detail-produk', $item->id)}}" class="d-flex justify-content-center">
                            <img src="{{ url('frontend/img/detail.png') }}" alt="" class="align-self-center">
                        </a>
                    </div>
                    <figcaption class="figure-caption text-center">
                        <h5>{{ $item->name }}</h5>
                        <p>IDR. @currency($item->price)</p>
                    </figcaption>
                </figure>
            </div>
            @empty
                
            @endforelse
           
           
         </div>
     </div>
 </section>
 <!-- akhir features -->

 

@endsection