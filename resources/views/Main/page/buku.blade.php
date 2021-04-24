@extends('Main.layout.layout-app')
@section('content')
{{-- @include('Main.layout.notif-bubble') --}}
{{-- <div id="wrap-notif" class="test">
	<div class="wish-box">
		<div class="wish-notif columns is-multiline notification is-default is-mobile is-tablet">
        	<div class="column is-2-mobile is-2-tablet is-2-desktop">
	          	<span class="icon">
	           		<i class="fa fa-heart"></i>
	          	</span>
        	</div>
	        <div class="column is-10-tablet is-10-mobile is-10-mobile" id="mantap">

	        </div>
		</div>
	</div>
</div> --}}
<div class="error">
	<div class="error-box">
		<div class="is-error columns is-multiline notification is-default is-mobile is-tablet">
        	<div class="column is-2-mobile is-2-tablet is-2-desktop">
	          	<span class="icon">
	           		<i class="fa fa-close"></i>
	          	</span>
        	</div>
	        <div class="column is-10-tablet is-10-mobile is-10-mobile">
	        	<p></p> 
	        </div>
		</div>
	</div>
</div>
 
<section id="page-buku" class="container is-fluid">
	<button class="button icon is-medium open-menu is-hidden-desktop">
		<i class="fa fa-bars"></i>
	</button>
	{{-- <div class="columns is-multiline is-mobile"> --}}
		@include('Main.layout.sidebar')
		<div class="column is-9-desktop is-offset-3-desktop">
			<div class="columns is-multiline is-mobile is-tablet" id="buku-list">
				@foreach ($buku as $data)
				<div class="column is-10-mobile is-offset-1-mobile is-one-third-tablet is-one-quarter-desktop" data-aos="flip-left" data-aos-duration="900">
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
			 					<p class="title is-5">
			 						{{ Str::limit($data->judul_buku,20) }}
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
				 					<a href="{{ url('/kategori',$data->slug_kategori) }}" class="tag tag-kategori is-danger">{{ $data->nama_kategori }}</a>
				 					<a href="{{ url('/kategori/'.$data->slug_kategori.'/sub-kategori',$data->slug_sub_ktg) }}" class="tag tag-sub-ktg is-success">{{ $data->nama_sub }}</a>
			 					</div>
			 				</div>
		 				</div>
		 				<div class="content">
		 					<div class="columns is-gapless is-multiline is-mobile">
		 						<div class="column is-12-desktop is-12-mobile">
		 							@if (Auth::check())
			 							@if($cek == 0)
			 							<a href="{{ url('/pinjam/buku',$data->judul_slug) }}">
			 								<button class="button is-primary pinjam">Pinjam</button>
			 							</a>
			 							@else
			 								<button class="button is-danger pinjam"><s>Pinjam</s></button>
			 							@endif
			 						@else
		 							<a href="{{ url('/pinjam/buku',$data->judul_slug) }}">
		 								<button class="button is-primary pinjam">Pinjam</button>
		 							</a>
		 							@endif
		 						</div>
		 						{{-- <div class="column is-2-desktop is-half-mobile">
		 							<button class="button is-inverted is-dark pinjam notif-wishlist" data-buku="{{ $data->id_buku }}">
		 								<span class="icon">
		 									<i class="fa fa-heart-o animated pulse"></i>
		 								</span>
		 							</button>
		 						</div> --}}
		 					</div>
		 				</div>
	 				</div>
				</div>
				@endforeach{{-- 
				<span class="icon is-large load-icon">
					<i class="fa fa-circle-o-notch fa-spin"></i>
				</span> --}}
				{{-- <div class="loading-page">
					<span class="icon is-large load-icon">
						<i class="fa fa-circle-o-notch fa-spin"></i>
					</span>
				</div> --}}
			</div>
			@if($buku->hasPages())
			{{$buku->links()}}
			@else
			<nav class="pagination is-centered">
			  <a class="pagination-previous">Previous</a>
			  <ul class="pagination-list">
			    <li><a class="pagination-link is-current">1</a></li>
			  </ul>
			  <a class="pagination-next">Next page</a>
			</nav>
			@endif
		</div>
	{{-- </div> --}}
</section>

@endsection

@section('script')
<script>
$(function(){
 //  	$('#container').css({
 //  		'background-color':'#f5f5f5'
	// });
	$("button.close-menu,.overlay").click(function(){
        $("#side-menu").css("left", "-300px");
        $('.overlay').fadeOut(200);
    });
    $("button.open-menu").click(function(){
        $("#side-menu").css("left", "0");
        $('.overlay').fadeIn(200);
    });
    $('#remove').on('click',function(){
    	$('#show').hide();
    });
});
</script>
@endsection