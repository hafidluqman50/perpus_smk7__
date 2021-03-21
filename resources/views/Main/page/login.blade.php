@extends('Main.layout.layout-app')
@section('content')
<section id="login">
  <div class="container">
    <div class="columns">
      <div class="column is-offset-3-tablet is-6-tablet is-one-third-desktop is-offset-one-third-desktop" align="center">
        <div class="card">
          <div class="card-content">
          <figure>
            <img src="{{asset('/front-assets/img/logo.png')}}" alt="">
            <figcaption>
              <h3 class="title is-3">Login</h3>
            </figcaption>
          </figure>
          @if (session()->has('fail') || session()->has('log'))
            <div class="notification is-danger" id="show-notif">
            <button class="delete" id="dismiss"></button>
              {{ (session('fail') ? session('fail') : session('log')) }}
            </div>
          @endif
          <form action="{{ url('/login/auth') }}" method="POST">
          {{ csrf_field() }}
          <div class="field">
            <p class="control has-icons-left">
              <input class="input" type="text" name="username" placeholder="Username" required="required">
              <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
              </span>
            </p>
          </div>
          <div class="columns is-mobile">
            <div class="column is-11">
              <div class="field">
                <p class="control has-icons-left">
                  <input class="input" id="pass" type="password" name="password" placeholder="Password" required="required">
                  <span class="icon is-small is-left">
                    <i class="fa fa-lock"></i>
                  </span>
                </p>
              </div>
            </div>
            <div class="column is-1">
              <div class="field">
                <span class="icon is-right custom-click" id="check">
                  <i class="fa fa-eye"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="field">
              <button class="button is-primary">Login</button>
          </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
<script>
$(function(){
  $('body').css({
    'background-size':'cover',
    'background-image':'url(/front-assets/img/pattern.png)',
    'background-image': 'linear-gradient(to right, rgba(20,30,48,0.98) 0%, rgba(36, 59, 85, 0.98) 100%), url(/front-assets/img/pattern.png)',
    'z-index':'auto'
});
  $('#check').on('click',function(){
    if (!$(this).hasClass('clicked')) {
        $(this).addClass('clicked');
        $('#pass').attr('type','text');
    }
    else {
        $(this).removeClass('clicked');
        $('#pass').attr('type','password');
    }
    // alert('test');
  });
  $('#dismiss').on('click',function(){
    $('#show-notif').hide();
  });
});
</script>
@endsection