@extends('layouts.main')

@section('content')
     <!-- breadcrumb -->
     <div class="container">
          <nav>
              <ol class=" breadcrumb bg-transparent pl-0">
                  <li class=" breadcrumb-item "><a href=" # ">Category</a></li>
                  <li class=" breadcrumb-item active " aria-current=" page ">Single Product</li>
              </ol>
          </nav>
      </div>
      <!-- akhir breadcrumb -->
  
      <!-- single product -->
      <section class="single-product ">
          <div class="container">
              <div class="row">
                  <div class="col-lg-5">
                      <figure class="figure">
                          <img src="{{ url('frontend/img/single/1.png') }}" class="figure-img img-fluid">
                          {{-- <figcaption class="figure-caption product-thumbnail-container d-flex  justify-content-between">
                              <a href="">
                                  <img src="{{ url('frontend/img/single/thumbnail/1.png') }}">
                              </a>
                              <a href="">
                                  <img src="{{ url('frontend/img/single/thumbnail/2.png') }}">
                              </a>
                              <a href="">
                                  <img src="{{ url('frontend/img/single/thumbnail/3.png') }}">
                              </a>
                              <a href="">
                                  <img src="{{ url('frontend/img/single/thumbnail/4.png') }}">
                              </a>
                          </figcaption> --}}
                      </figure>
                  </div>
  
                  <div class="col-lg-5">
                      <h3>{{ $data->name }}</h3>
                      <p class="text-muted">IDR. @currency($data->price)</p>
                     
    
                      <form action="{{ route('front.cart') }}" method="POST">
                        @csrf
                        <div class="product_count">
                          <label for="qty">Quantity:</label>
                          <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                          
                          <!-- BUAT INPUTAN HIDDEN YANG BERISI ID PRODUK -->
                          <input type="hidden" name="product_id" value="{{ $data->id }}" class="form-control">
                          
                          <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                          class="increase items-count btn-success" type="button">
                          <i
                          class="fas fa-plus-circle"></i></button>
                          </button>
                          <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                          class="reduced items-count btn-danger" type="button">
                          <i
                            class="fas fa-minus-circle"></i></button>
                          </button>
                        </div>
                        <div class="card_area">
                          
                          <!-- UBAH JADI BUTTON -->
                          <button class="main_btn btn-warning">Add to Cart</button>
                          <!-- UBAH JADI BUTTON -->
                          
                        </div>
                      </form>
  
                      <div class="designed-by mt-3">
                          <h5>Designed by</h5>
                          <div class="row">
                              <div class="col-2">
                                  <img src="{{ url('frontend/img/single/2.png') }}" alt="">
                              </div>
                              <div class="col">
                                  <h4>Anne Montgery</h4>
                                  <p>14.2K <span> Followers</span></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- akhir single product -->
  
      <!-- product description & review -->
      <section class="product-description p-5 ">
          <div class="container">
              <div class="row">
                  <div class="col-lg-9">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description"
                                  role="tab" aria-controls="description" aria-selected="true">Product Description</a>
                          </li>
                       
  
                      </ul>
                      <div class="tab-content p-3" id="myTabContent">
                          <div class="tab-pane fade show active product-review" id="description" role="tabpanel"
                              aria-labelledby="description-tab">
                             <p>{{ $data->description }}</p>
                          </div>

  
  
                      </div>
                  </div>
  
              </div>
          </div>
      </section>
      <!-- akhir product description & review -->
@endsection