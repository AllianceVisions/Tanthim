@extends('layouts.frontend')

@section('content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle" style="background-image: url('{{ asset('frontend/images/banner/bnr1.jpg') }}')">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">تواصل معنا</h1>
                    <p>
                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
                        هذا النص من مولد النص العربى
                    </p>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ route('frontend.home') }}">الرئيسية</a></li>
                            <li>تواصل معنا</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <div class="section-full content-inner">
            <div class="container">
                <div class="row dzseth m-b50">
                    <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                        <div class="icon-bx-wraper p-lr20 p-tb50 center seth contact-bx">
                            <div class="icon-bx-sm radius m-b20 bg-primary m-b20">
                                <a href="#" class="icon-cell"><i class="ti-email"></i></a>
                            </div>
                            <div class="icon-content">
                                <h5 class="dlab-tilte text-uppercase">البريد الإلكتروني</h5>
                                <p>
                                    info@example.com <br />
                                    info@example.com
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                        <div class="icon-bx-wraper p-lr20 p-tb50 center seth contact-bx">
                            <div class="icon-bx-sm radius m-b20 bg-primary m-b20">
                                <a href="#" class="icon-cell"><i class="ti-mobile"></i></a>
                            </div>
                            <div class="icon-content">
                                <h5 class="dlab-tilte text-uppercase">التليفون</h5>
                                <p>
                                    +61 3 8376 6284 <br />
                                    +23 123 456 7890
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Left part start -->
                    <div class="col-lg-6 mb-4 mb-md-0">
                        <div class="clearfix contact-form m-b30">
                            <div class="section-head text-black">
                                <h2 class="box-title">تواصل معنا</h2>
                                <div class="dlab-separator bg-primary"></div>
                                <p>
                                    هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                                    توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل
                                    هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد
                                    الحروف التى يولدها التطبيق
                                </p>
                            </div>
                            <div class="dzFormMsg"></div>
                            
                            @if($errors->count() > 0)
                                <div class="alert alert-danger">
                                    <ul class="list-unstyled">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST"  action="{{ route('frontend.contactus.store') }}">
                                @csrf 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="name" type="text" required class="form-control"
                                                    placeholder="الاسم" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="email" type="email" class="form-control" required
                                                    placeholder="البريد الإلكتروني" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="phone" type="text" required class="form-control"
                                                    placeholder="التليفون" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="title" type="text" required class="form-control"
                                                    placeholder="الموضوع" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <textarea name="message" rows="4" class="form-control" required
                                                    placeholder="الرســـالة .... "></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button name="submit" type="submit" value="Submit"
                                            class="site-button button-lg radius-xl">
                                            إرسال
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Left part END -->
                    <!-- right part start -->
                    <div class="col-lg-6 d-flex">
                        <div id="map3" class="m-b30 align-self-stretch" style="width: 100%; min-height: 300px"></div>
                    </div>
                    <!-- right part END -->
                </div>
            </div>
        </div>
    </div>
    <!-- Content END-->
@endsection


@section('scripts')
    
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyBjirg3UoMD5oUiFuZt3P9sErZD-2Rxc68&sensor=false"></script>
    <!-- GOOGLE MAP -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <!-- Google API For Recaptcha  -->

    <script src="{{ asset('frontend/js/map.script.js') }}"></script>
    <!-- CONTACT JS  -->
@endsection