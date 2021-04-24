@extends('Main.layout.layout-app')
@section('content')
<nav class="navbar" id="nav">
  <div class="navbar-brand">
  	<a href="#" class="navbar-item brands">
  		<img src="{{ asset('/front-assets/img/logo.png') }}" alt="">
  	</a>
    <div class="navbar-burger burger" data-target="navMenuExample">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <ul id="navMenuExample" class="navbar-menu columns is-multiline is-mobile is-tablet">
		<div class="column is-4-tablet is-12-mobile is-5-desktop">
			<div class="columns is-multiline is-mobile is-tablet">
				<div class="column is-12-mobile is-half-tablet is-offset-half-desktop is-one-quarter-desktop">
				<li><a href="#" class="navbar-item menu-1">populer</a></li>
				</div>
				<div class="column is-12-mobile is-half-tablet is-one-quarter-desktop">
				<li><a href="#" class="navbar-item menu-2">baru</a></li>
				</div>
			</div>
		</div>
		<div class="column is-4-tablet is-2-desktop" align="center">
			<li class="logo"><a href="#">perpus7</a></li>
		</div>
		<div class="column is-4-tablet is-12-mobile is-5-desktop">
			<div class="columns is-multiline is-mobile is-tablet">
				<div class="column is-12-mobile is-half-tablet is-one-quarter-desktop">
					<li><a href="#" class="navbar-item menu-3">panduan</a></li>
				</div>
				<div class="column is-12-mobile is-half-tablet is-one-quarter-desktop">
					<li><a href="#" class="navbar-item menu-4">petugas</a></li>
				</div>
			</div>
		</div>
  </ul>
</nav>
<!-- HEADER -->
@if (Auth::check())
<!-- Header -->
<header id="header">
	<figure>
		<img src="{{ asset('/front-assets/img/header.jpg')}}" alt="">
			<div class="layer"></div>
			<figcaption class="has-text-centered">
				<h1>Selamat datang <b>{{ $nama_anggota }}</b></h1>
				<p>Hidupkan perpus kalian ! dan jadilah generasi gemar membaca bersama teman teman.</p>
				<hr color="lightgrey">
				<a href="{{ url('/profile') }}" class="button is-primary is-outlined">Profil</a> 
				{{-- <a href="{{ url('/profile/#wishlist') }}" class="button is-dark is-inverted is-outlined" id="wishlist">Wishlist</a> --}}
				<button class="icon is-large floating">
					<a class="fa fa-angle-down"></a>
				</button>
			</figcaption>
	</figure>
</header>
@else
<!-- Header -->
<header id="header">
	<figure>
		<img src="{{ asset('/front-assets/img/header.jpg') }}" alt="">
			<div class="layer"></div>
			<figcaption class="has-text-centered">
					<h1>Selamat datang di Perpustakaan</h1>
					<p>Hidupkan perpus kalian ! dan jadilah generasi gemar membaca bersama teman teman.</p>
					<hr color="lightgrey">
					<a href="{{ url('/login-form') }}" class="button is-primary is-outlined">Login</a>
					<button class="icon is-large floating">
						<a class="fa fa-angle-down"></a>
					</button>
				</figcaption>
	</figure>
</header>
@endif

<main>
	<div id="content">
		{{-- @include('Main.layout.notif-bubble') --}}
      	<div id="wrap-notif">
			<div class="wish-box">
	    		<div class="wish-notif columns is-multiline notification is-default is-mobile is-tablet">
			        <div class="column is-2-mobile is-2-tablet is-2-desktop">
			          <span class="icon">
			            <i class="fa fa-heart"></i>
			          </span>
			        </div>
			        <div class="column is-10-tablet is-10-mobile is-10-mobile">
			          Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
			        </div>
	      		</div>
	      	</div>
      	</div>
		@if (Auth::check())
		<section id="profil1" class="hero is-medium is-primary is-bold">
			    <div class="container">
			    	<p class="title-style title is-2 has-text-centered">Profil Anggota</p>
			    	<div class="columns is-multiline is-tablet is-mobile">
			    		<div class="column is-12-mobile is-one-third-tablet is-one-third-desktop">
							<figure>
        						<img src="{{asset($anggota->foto_profile == '' || $anggota->foto_profile == '-' ? '/front-assets/profile_anggota/1498308623.learning.svg' : '/front-assets/profile_anggota/'.$anggota->foto_profile)}}" alt="">
							</figure>
			    		</div>
			    		<div class="column is-12-mobile is-one-third-tablet is-one-third-desktop data-siswa">
			    			<ul>
			    			<p class="title is-5">Nomor Induk</p>
			    				<li class="subtitle is-4">
			    				{{ $anggota->nomor_induk }}</li>
			    			<p class="title is-5">Nama</p>
			    				<li class="subtitle is-4">
			    				{{ $anggota->nama_anggota }}</li>
			    			<p class="title is-5">Username</p>
			    				<li class="subtitle is-4">
			    				{{ Auth::user()->username }}</li>
			    			</ul>
			    		</div>
			    		<div class="column is-12-mobile is-one-third-tablet is-one-third-desktop data-siswa">
			    			<ul>
			    			<p class="title is-5">Email</p>
			    				<li class="subtitle is-4">
			    				{{ $anggota->email }}</li>
			    			@if($anggota->tipe_anggota == 'siswa')
			    			<p class="title is-5">Kelas</p>
			    				<li class="subtitle is-4">
			    				{{ $anggota->kelas_tingkat.' '.$anggota->nama_jurusan.' '.$anggota->urutan_kelas }}</li>
			    			@endif
			    			</ul>
			    		</div>
				    	<div class="column is-4-mobile is-offset-6-tablet is-offset-7-desktop">
				    		<a class="button hover is-medium is-danger is-outlined" href="{{ url('/logout') }}">
								Logout
				    		</a>
			    		</div>
			    	</div>
			    </div>
			</section>
		@endif
		<section id="terpopuler" class="hero is-medium is-info is-bold">
			<div class="hero-body">
				<div class="container">
					<div class="columns is-multiline is-tablet is-mobile">
						<div data-aos="fade-right" data-aos-offset="200" class="column is-12-mobile is-12-tablet is-3-desktop">
							<h1 class="title">
								Buku Terpopuler
							</h1>
							<hr>
							<p class="subtitle is-6">
								Beberapa buku dengan peminjaman paling banyak
							</p>
						</div>
						@foreach($buku->showMostPopular() as $key => $data)
						@php
						$array = [
							0 =>['animate' => 'fade-up','delay' => '200'],
							1 =>['animate' => 'fade-down','delay' => '400'],
							2 =>['animate' => 'fade-left','delay' => '600']
						];
						@endphp
			    		<div data-aos="{{$array[$key]['animate']}}" data-aos-delay="{{$array[$key]['delay']}}" data-aos-offset="200" class="column is-10-mobile is-offset-1-mobile is-3-desktop">
			    			<div class="card">
			    				<div class="card-image">
			    					<figure class="image is-1by1">
				    					<a href="{{ url('/buku',$data->judul_slug) }}">
				    						<img src="{{ $data->foto_buku != '-' ? asset('/front-assets/foto_buku/'.$data->foto_buku) : asset('/front-assets/foto_buku/book.png') }}" draggable="false">
				    					</a>
			    					</figure>
			    				</div>
			    				<div class="card-content">
				 					<a href="{{ url('/buku',$data->judul_slug) }}">
					 					<p class="title is-5 text-black">
					 						{{ $data->judul_buku }}
					 					</p>
				 					</a>
									<div>
										<small>{{ tanggal_upload($data->tanggal_upload) }}</small>
										<br>
										{{-- <span class="icon is-big">
											<i class="fa fa-star"></i>
										</span>
										<span class="icon is-big">
											<i class="fa fa-star"></i>
										</span>
										<span class="icon is-big">
											<i class="fa fa-star"></i>
										</span>
										<span class="icon is-big">
											<i class="fa fa-star-o"></i>
										</span>
										<span class="icon is-big">
											<i class="fa fa-star-o"></i>
										</span> --}}
									</div>
					 				<div>
					 					<div class="new-tag">
						 					<a href="{{ url('/kategori',$data->slug_kategori) }}" class="tag tag-kategori tag-small is-danger text-white">{{ $data->nama_kategori }}</a>
						 					<a href="{{ url('/kategori/'.$data->slug_kategori.'/sub-kategori',$data->slug_sub_ktg) }}" class="tag tag-sub-ktg tag-small is-success text-white">{{ $data->nama_sub }}</a>
					 					</div>
					 				</div>
				 				</div>
				 				<div class="content">
				 					<div class="columns is-gapless is-multiline is-mobile">
				 						<div class="column is-12-desktop is-12-mobile">
				 							@if(Auth::check())
					 							@if($cek == 0)
					 							<a href="{{ url('/pinjam/buku',$data->judul_slug) }}">
					 								<button class="button is-primary pinjam">Pinjam</button>
					 							</a>
					 							@else
					 							{{-- <a href="{{ url('/pinjam/buku',$data->judul_slug) }}"> --}}
					 								<button class="button is-danger pinjam"><s>Pinjam</s></button>
					 							{{-- </a> --}}
					 							@endif
					 						@else
				 							<a href="{{ url('/pinjam/buku',$data->judul_slug) }}">
				 								<button class="button is-primary pinjam">Pinjam</button>
				 							</a>
				 							@endif
				 						</div>
				 						{{-- <div class="column is-2-desktop is-half-mobile">
				 							<button class="button is-inverted is-dark pinjam notif-wishlist">
				 								<span class="icon">
				 									<i class="fa fa-heart-o animated pulse"></i>
				 								</span>
				 							</button>
				 						</div> --}}
				 					</div>
				 				</div>
			 				</div>
			    		</div>
			    		@endforeach
			 			<div data-aos="fade-left" data-aos-offset="-100" class="column is-12">
			 				<p class="title is-4 has-text-centered">
			 					<a href="{{ url('/buku') }}">Buku Lainnya</a>
			 					<span class="icon">
			 						<i class="fa fa-angle-double-right"></i>
			 					</span>
			 				</p>
			 			</div>
					</div>
				</div>
			</div>
		</section>
		<section id="terbaru" class="hero is-medium is-success is-bold">
			<div class="hero-body">
				<div class="container">
					<div class="columns is-multiline is-tablet is-mobile">
						<div data-aos="fade-right" data-aos-delay="100" data-aos-offset="200" class="column is-12-mobile is-12-tablet is-hidden-desktop">
							<h1 class="title">
								Buku Terbaru
							</h1>
							<hr>
							<p class="subtitle is-6">
								Beberapa buku dengan baru yg telah ditambah
							</p>
						</div>
						@foreach($buku->newestBook() as $key => $data)
						@php
						$animate = [
							0 => 'fade-up',
							1 => 'fade-down',
							2 => 'fade-up'
						];
						@endphp
			    		<div data-aos="{{$animate[$key]}}" data-aos-delay="{{$key+2}}00" data-aos-offset="200" class="column is-10-mobile is-offset-1-mobile is-3-desktop">
			    			<div class="card">
			    				<div class="card-image">
			    					<figure class="image is-1by1">
				    					<a href="{{ url('/buku',$data->judul_slug) }}">
				    						<img src="{{ $data->foto_buku != '-' ? asset('/front-assets/foto_buku/'.$data->foto_buku) : asset('/front-assets/foto_buku/book.png') }}" draggable="false">
				    					</a>
			    					</figure>
			    				</div>
			    				<div class="card-content">
				 					<a href="{{ url('/buku',$data->judul_slug) }}">
					 					<p class="title is-5 text-black">
					 						{{ $data->judul_buku }}
					 					</p>
				 					</a>
									<div>
										<small>{{ tanggal_upload($data->tanggal_upload) }}</small>
										<br>
										{{-- <span class="icon is-big">
											<i class="fa fa-star"></i>
										</span>
										<span class="icon is-big">
											<i class="fa fa-star"></i>
										</span>
										<span class="icon is-big">
											<i class="fa fa-star"></i>
										</span>
										<span class="icon is-big">
											<i class="fa fa-star-o"></i>
										</span>
										<span class="icon is-big">
											<i class="fa fa-star-o"></i>
										</span> --}}
									</div>
					 				<div>
					 					<div class="new-tag">
						 					<a href="{{ url('/kategori',$data->slug_kategori) }}" class="tag tag-kategori tag-small is-danger text-white">{{ $data->nama_kategori }}</a>
						 					<a href="{{ url('/kategori/'.$data->slug_kategori.'/sub-kategori',$data->slug_sub_ktg) }}" class="tag tag-sub-ktg tag-small is-success text-white">{{ $data->nama_sub }}</a>
					 					</div>
					 				</div>
				 				</div>
				 				<div class="content">
				 					<div class="columns is-gapless is-multiline is-mobile">
				 						<div class="column is-12-desktop is-12-mobile">
				 							@if(Auth::check())
					 							@if($cek == 0)
					 							<a href="{{ url('/pinjam/buku',$data->judul_slug) }}">
					 								<button class="button is-primary pinjam">Pinjam</button>
					 							</a>
					 							@else
					 							{{-- <a href="{{ url('/pinjam/buku',$data->judul_slug) }}"> --}}
					 								<button class="button is-danger pinjam"><s>Pinjam</s></button>
					 							{{-- </a> --}}
					 							@endif
					 						@else
				 							<a href="{{ url('/pinjam/buku',$data->judul_slug) }}">
				 								<button class="button is-primary pinjam">Pinjam</button>
				 							</a>
				 							@endif
				 						</div>
				 						{{-- <div class="column is-2-desktop is-half-mobile">
				 							<button class="button is-inverted is-dark pinjam notif-wishlist">
				 								<span class="icon">
				 									<i class="fa fa-heart-o animated pulse"></i>
				 								</span>
				 							</button>
				 						</div> --}}
				 					</div>
				 				</div>
			 				</div>
			    		</div>
			    		@endforeach
						<div data-aos="fade-up" data-aos-delay="700" data-aos-offset="200" class="column is-hidden-mobile is-hidden-tablet-only is-block-desktop is-3-desktop">
							<h1 class="title">
								Buku Terbaru
							</h1>
							<hr>
							<p class="subtitle is-6">
								Beberapa buku dengan baru yg telah ditambah
							</p>
						</div>
			 			<div data-aos="fade-up" data-aos-offset="-100" class="column is-12">
			 				<p class="title is-4 has-text-centered">
			 					<a href="{{ url('/buku') }}">Buku Lainnya</a>
			 					<span class="icon">
			 						<i class="fa fa-angle-double-right"></i>
			 					</span>
			 				</p>
			 			</div>
					</div>
				</div>
			</div>
		</section>
		<section id="panduan" class="hero is-medium is-warning is-bold">
		  <div class="hero-body">
		    <div class="container">
				<div data-aos="fade-down" data-aos-delay="100" data-aos-offset="200" class="has-text-centered">
				      <h1 class="title">
				      	Panduan Perpustakaan
				      </h1>
				      <p class="subtitle is-6" color="white">
				       	Ikuti semua cara dengan langkah per langkah agar mudah dalam peminjaman
				      </p>
				</div>
				<div data-aos="fade-up" data-aos-delay="400" data-aos-offset="200" class="center-slide">
					@foreach ($panduan_pinjam as $element)
					<div>
						<img src="{{ asset('/front-assets/foto_panduan/'.$element->foto_panduan) }}" alt="">
						<h5 class="title is-5">{{ $element->langkah_panduan }}</h5>
						<p class="subtitle">{{ $element->isi_panduan }}</p>
					</div>
					@endforeach
				</div>
		    </div>
		  </div>
		</section>
		<section id="petugas" class="hero is-medium is-danger is-bold">
		  <div class="hero-body">
		    <div class="container">
		    	<div class="columns is-multiline is-tablet is-mobile is-centered">
		    		<div data-aos="fade-up" data-aos-delay="200" data-aos-offset="200"  class="column is-hidden-desktop is-10-mobile is-12-tablet has-text-centered">
		    			<div>
			    			  <h1 class="title is-4">
					      	  Petugas Perpustakaan
					      	  </h1>
					      <hr>
						      <p class="subtitle is-6">
						       	Lorem ipsum dolor sit amet, consectetur adipisicing elit.
						      </p>
					     </div>
		    		</div>
			    	<div data-aos="fade-right" data-aos-delay="300" data-aos-offset="200" class="column is-10-mobile is-half-tablet is-3-desktop">
		    		@foreach ($petugas as $element)
			    		@if ($element->jabatan == 'pustakawan')
							<figure class="image">
    							<img src="{{ $element->foto_profile == '-' ? asset('/front-assets/foto_petugas/iconfinder_user-alt_285645.png') : asset('/front-assets/foto_petugas/'.$element->foto_profile) }}">
								<figcaption>
									<p class="title is-6">{{ $element->nama_petugas }}</p>
									<p class="subtitle is-6" style="margin-bottom:3%;">{{ $element->nip != '' || $element->nip != '-' ? 'NIP. '.$element->nip : '-' }}</p>
									<p class="subtitle is-6">{{ unslug_str($element->jabatan) }}</p>
								</figcaption>
							</figure>
							<br>
							<br>
			    		@endif
		    		@endforeach
			    	</div>
		    		<div data-aos="fade-down" data-aos-delay="200" data-aos-offset="200" class="column is-4-desktop is-hidden-mobile is-hidden-tablet-only has-text-centered">
		    			<div>
			    			  <h1 class="title is-4">
					      	  Petugas Perpustakaan
					      	  </h1>
					      <hr>
						      <p class="subtitle is-6">
						       	Lorem ipsum dolor sit amet, consectetur adipisicing elit.
						      </p>
					     </div>
		    		</div>
		    		<div data-aos="fade-left" data-aos-delay="300" data-aos-offset="200" class="column is-10-mobile is-half-tablet is-3-desktop">
		    		@foreach ($petugas as $element)
		    			@if ($element->jabatan == 'kepala-perpustakaan')
    					<figure class="image">
    						<img src="{{ $element->foto_profile == '-' ? asset('/front-assets/foto_petugas/iconfinder_user-alt_285645.png') : asset('/front-assets/foto_petugas/'.$element->foto_profile) }}">
    						<figcaption>
    							<p class="title is-6">{{ $element->nama_petugas }}</p>
								<p class="subtitle is-6" style="margin-bottom:3%;">{{ $element->nip != '' || $element->nip != '-' ? 'NIP. '.$element->nip : '-' }}</p>
								<p class="subtitle is-6">{{ unslug_str($element->jabatan) }}</p>
    						</figcaption>
    					</figure>
    					<br>
    					<br>
		    			@endif
		    		@endforeach
		    		</div>
		    	</div>
		    </div>
		  </div>
		</section>
	</div>
</main>
@include('Main.layout.footer-link')
@endsection

@section('script')
    @if (Auth::check())
    <script>
    $("button.floating").click(function() {
    $('html,body').animate({
        scrollTop: $("#profil1").offset().top},
        1000);
	 });
    </script>
    @else
    <script>
    $("button.floating").click(function() {
    $('html,body').animate({
        scrollTop: $("#terpopuler").offset().top},
        1000);
	 });
    </script>
    @endif
    <script>
    $("a.menu-1").click(function() {
    $('html,body').animate({
        scrollTop: $("#terpopuler").offset().top},
        1200);
	 });
    $("a.menu-2").click(function() {
    $('html,body').animate({
        scrollTop: $("#terbaru").offset().top},
        1100);
	 });
    $("a.menu-3").click(function() {
    $('html,body').animate({
        scrollTop: $("#panduan").offset().top},
        1000);
	 });
    $("a.menu-4").click(function() {
    $('html,body').animate({
        scrollTop: $("#petugas").offset().top},
        900);
	 });
    </script>
@endsection