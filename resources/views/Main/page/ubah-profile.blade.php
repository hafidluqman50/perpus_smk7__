@extends('Main.layout.layout-app')
@section('content')
{{-- @include('Main.layout.notif-bubble') --}}
<div class="banner2"></div>
<section id="profil">
    <figure class="foto-siswa">
        <img src="{{asset($anggota->foto_profile == '' || $anggota->foto_profile == '-' ? '/front-assets/profile_anggota/1498308623.learning.svg' : $anggota->foto_profile)}}" alt="">
    </figure>
    <form action="{{ url('/ubah/profile/save') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="field has-text-centered">
        <span class="button is-outlined is-primary btn-file">
          Pilih Foto... <input name="foto_profile" id="image" type="file">
        </span>
        <img id="uploadPreview">
    </div>
    <div class="container">
        <div class="columns is-multiline data-siswa">
            <div class="column is-5-tablet is-offset-1-tablet is-10-mobile is-offset-1-mobile is-4 is-offset-2-desktop">
                <ul>
                    <div class="field">
                        <p class="title is-6 label" for="nisn">nomor induk</p>
                        <li class="control has-icons-left subtitle is-4">
                            <input class="input" name="nisn" type="text" disabled="disabled" value="{{ $anggota->nomor_induk }}">
                        </li>
                    </div>
                    <div class="field">
                        <p class="title is-6 label" for="nama">nama</p>
                        <li class="control has-icons-left subtitle is-4">
                            <input name="nama_siswa" type="text" class="input" value="{{ $anggota->nama_anggota }}" disabled="disabled">
                        </li>
                    </div>
                    <div class="field">
                        <p class="title is-6 label" for="username">username</p>
                        <li class="control has-icons-left subtitle is-4">
                            <input type="text" name="username" class="input" value="{{ $anggota->username }}">
                        </li>
                    </div>
                </ul>
            </div>
            <div class="column is-5-tablet is-10-mobile is-offset-1-mobile is-4">
                <ul>
                    @if ($anggota->tipe_anggota != 'guru')
                    <div class="field">
                        <p class="title is-6 label" for="kelas">kelas</p>
                        <li class="control has-icons-left subtitle is-4">
                            <input type="text" name="kelas" class="input" disabled value="{{ $anggota->kelas_tingkat.' '.$anggota->nama_jurusan.' '.$anggota->urutan_kelas }}">
                        </li>
                    </div>
                    @endif
                    <div class="field">
                        <p class="title is-6 label" for="email">email</p>
                        <li class="control has-icons-left subtitle is-4">
                            <input class="input" name="email" type="email" value="{{ $anggota->email }}">
                        </li>
                    </div>
                </ul>
            </div>
            <div class="column is-5-tablet is-offset-1-tablet is-10-mobile is-offset-1-mobile is-4 is-offset-2-desktop">
                <ul>
                    <div class="field">
                        <p class="title is-6 label" for="kata-sandi">
                            Kata sandi baru
                        </p>
                        <li class="control has-icons-left subtitle is-4">
                            <input class="input" name="password" type="password" id="password">
                        </li>
                    </div>
                </ul>
            </div>
            <div class="column is-5-tablet is-10-mobile is-offset-1-mobile is-4-desktop">
                <ul>
                    <div class="field">
                        <p class="title is-6 label" for="kata-sandi2">
                            Konfirmasi kata sandi baru
                        </p>
                        <li class="control has-icons-left subtitle is-4">
                            <input class="input" type="password" id="confirm-password">
                        </li>
                    </div>
                </ul>
            </div>
            <div class="column is-5-tablet is-offset-1-tablet is-10-mobile is-offset-1-mobile is-8 is-offset-2-desktop data-siswa">
                <input type="hidden" name="id_users" value="{{Auth::id()}}">
                <button type="submit" class="button is-primary" disabled="disabled">Submit</button>
                <a href="{{ url('/profile') }}">
                <button class="button is-default" type="button">
                    Kembali
                </button>
                </a>
            </div>
        </div>
    </div>
    </form>
</section>
@endsection

@section('script')
<script>
$(function(){
    $('#container').css({
        'background-color':'#efefef'
    });

    $(document).on('keyup','#confirm-password',function(){
        var val = $('#password').val();
        if ($(this).val() == val) {
            $('button[type="submit"]').removeAttr('disabled');
            if ($(this).parent().hasClass('fail-input')) {
                $(this).parent().removeClass('fail-input');
            }
        }
        else {
            $(this).parent().addClass('fail-input');
        }
    });
});
</script>
@endsection