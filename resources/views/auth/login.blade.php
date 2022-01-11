@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h3 class="form-title m-t0">مرحبا بكم</h3>

        <div class="form-group">
            <input name="email" required="" class="form-control" placeholder="البريد الإلكتروني" type="text" />
            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <input name="password" required="" class="form-control " placeholder="كلمة المرور" type="password" />
            @if ($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>
        <div class="form-group field-btn text-left">
            <div class="input-block">
                <input id="check1" type="checkbox" name="remember">
                <label for="check1">تذكرني </label>
            </div>
            <a href="{{ route('password.request') }}" class="btn-link forgot-password"> نسيت كلمة المرور </a>
        </div>
        <div class="form-group">
            <button class="site-button btn-block button-md">دخول</button>
        </div>
        <div class="form-group">
            <p class="info-bottom">مستخدم جديد <a href="{{ route('register') }}"
                    class="btn-link">سجل الان</a> </p>
        </div>
    </form>
@endsection
