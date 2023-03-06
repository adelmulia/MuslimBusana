@extends('layouts.main')

@section('title')
    <title>Checkout - Halal Ecommerce</title>
@endsection

@section('content')
     <!--================Home Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="overlay"></div>
			<div class="container">
				<div class="banner_content text-center">
					<h2>Informasi Pengiriman</h2>
					<div class="page_link">
                              <a href="{{ url('/') }}">Home</a>
						<a href="#">Checkout</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->

	<!--================Checkout Area =================-->
	<section class="checkout_area section_gap">
		<div class="container">
			<div class="billing_details">
				<div class="row">
					<div class="col-lg-8">
                         <h3>Informasi Pengiriman</h3>          
                         @if (session('error'))
                              <div class="alert alert-danger">{{ session('error') }}</div>
                         @endif
                         <form class="row contact_form" action="{{ route('front.store_checkout') }}" method="post" novalidate="novalidate">
                                        @csrf
                              <div class="col-md-12 form-group p_star">
                                   <label for="">Nama Lengkap</label>
                                   <input type="text" class="form-control" id="first" name="customer_name" required>
                                   <p class="text-danger">{{ $errors->first('customer_name') }}</p>
                              </div>
						{{-- <div class="col-md-12 form-group">
                                   <input type="text" class="form-control" id="first" value="{{ $password}}" name="password" required>
                                   <p class="text-danger">{{ $errors->first('customer_name') }}</p>
                              </div> --}}
                              <div class="col-md-6 form-group p_star">
                                   <label for="">No Telp</label>
                                   <input type="text" class="form-control" id="number" name="customer_phone" required>
                                   <p class="text-danger">{{ $errors->first('customer_phone') }}</p>
                              </div>
                              <div class="col-md-6 form-group p_star">
                                   <label for="">Email</label>
							@php
							    
							@endphp
    							<input type="email" class="form-control" id="email" name="email" value="{{ auth()->guard('customer')->user()  != null ? auth()->guard('customer')->user()->email  : ' '}}" required {{ auth()->guard('customer')->check() ? 'readonly':'' }}>
                                   <p class="text-danger">{{ $errors->first('email') }}</p>
                              </div>
                              <div class="col-md-12 form-group d-flex flex-column">
                                   <label for="">Alamat Lengkap</label>
                                   <textarea name="customer_address" id="" cols="30" rows="10"></textarea>
                                        <p class="text-danger">{{ $errors->first('customer_address') }}</p>
                              </div>
                         </div>
					
                         <div class="col-lg-4">
						<div class="order_box">
							<h2>Ringkasan Pesanan</h2>
							<div class="card">
								<div class="card-header">
									<h5 class="text-center">Produk Total</h5>
								</div>
								<div class="card-body">
									<ul class="list-checkout">
									
										@foreach ($carts as $cart)
											<li>
												<a href="#">{{ \Str::limit($cart['product_name'], 10) }}
													<span class="middle">x {{ $cart['qty'] }}</span>
													<span class="last">Rp {{ number_format($cart['product_price']) }}</span>
												</a>
											</li>
										@endforeach
										<li>
											<a href="#">Subtotal
												<span>Rp {{ number_format($subtotal) }}</span>
											</a>
										</li>
										<li>
											<a href="#">Pengiriman
												<span>Rp 0</span>
											</a>
										</li>
										<li>
											<a href="#">Total
												<span>Rp {{ number_format($subtotal) }}</span>
											</a>
										</li>
										<button class="btn btn-warning mt-4" type="submit">
											Bayar Pesanan
										   </button>
							  
									</ul>
								</div>
							</div>
							
								
                          </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection