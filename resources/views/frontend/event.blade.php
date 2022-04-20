@extends('layouts.frontend')

@section('styles') 
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/star-rating-svg.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection

@section('content')

    <!-- Content -->
    <div id="event_page" class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle" style="background-image: url('{{ asset('frontend/images/banner/bnr1.jpg') }}')">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <div class="wonder-bx text-white">
                        @php
                            if($event->company && $event->company->user && $event->company->user->photo){
                                $company_image = $event->company->user->photo->getUrl('preview');
                            }else{
                                $company_image = '';
                            }
                        @endphp
                        <div class="wonder-theme">
                            <img src="{{ $company_image }}" class="rounded-circle" />
                            <p>{{ $event->company->user->name ?? '' }}</p>
                        </div> 
                        <div class="wonder-price">
                            <p>السعر</p>
                            <h3 class="m-b0">{{ $event->cost ?? ''}} ريال سعودي - للفرد</h3>
                        </div>
                        <div class="wonder-btn">
                            <a href="javascript:void(0);" class="site-button button-lg radius-no text-uppercase">احجز الان
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="section-full content-inner">
            <div class="container">
                <div class="dlab-post-media m-b50">
                    <a href="javascript:void(0);"><img src="{{ asset('frontend/images/event-big.jpg') }}" alt="" /></a>
                </div>
                <div class="row">
                    <!-- Left part start -->
                    <div class="col-xl-8 col-lg-7 col-md-12 p-b30">
                        <div class="section-head text-black mb-3">
                            <h2 class="box-title">{{ $event->title ?? '' }}</h2>
                            <p class="m-b0">
                                <?php echo nl2br($event->description ?? ''); ?>
                            </p>
                            <input type="hidden" value="{{$event->latitude}}" name="latitude" id="latitude">
                            <input type="hidden" value="{{$event->longitude}}" name="longitude" id="longitude">
                        </div>
                        <div class="dlab-divider bg-gray-dark"></div>
                        <div class="widget widget_getintuch widget_listing">
                            <ul>
                                <li>
                                    <i class="fa fa-map-marker text-primary"></i>
                                    <p class="m-b0">{{ $event->city->name_ar ?? '' }}</p>
                                </li>
                                <li>
                                    <i class="fa fa-phone text-primary"></i>
                                    <p class="m-b0">{{ $event->company->user->phone ?? ''}}</p> 
                                </li>
                                <li>
                                    <i class="fa fa-envelope text-primary"></i>
                                    <p class="m-b0">{{ $event->company->user->email ?? '' }}</p>
                                    <p class="m-b0">{{ $event->company->user->website ?? '' }}</p>
                                </li>
                            </ul>
                        </div>
                        <div class="dlab-divider bg-gray-dark"></div> 

                        <div class="content-box">
                            <div class="content-header">
                                <h3 class="title">
                                    <i class="la la-list-ul"></i> الأقسام الداخلية
                                </h3>
                            </div>
                            <div class="content-body">
                                <ul id="iconbox" class="icon-box-list list-col-4">
                                    @foreach($event->eventBrands as $brand)
                                        <li>
                                    <button id="myBtn" type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#exampleModal{{$brand->id}}">
                                        
                                        <a href="javascript:void(0);" class="icon-box-info">
                                                <div class="icon-cell bg-gray">
                                                    <img src="{{ $brand->photo ? $brand->photo->getUrl('thumb') : '' }}" class="rounded-circle" alt="">
                                                </div>
                                                <span>{{ $brand->title ?? ''}}</span>
                                            </a>
                                            
                                      </button>
                                       <!-- Modal pop up-->
                                        <div class="modal fade" id="exampleModal{{$brand->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ $brand->title ?? ''}}</h5>
                                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="brand-info">
                                                    <p class="brand_tit">الصورة</p>
                                                    <img src="{{ $brand->photo ? $brand->photo->getUrl('thumb') : '' }}" class="" alt="">
                                                    
                                                </div>
                                                <div class="brand-info">
                                                    <p class="brand_tit">المكان</p>
                                                                   <p>{{ $brand->zone_name ?? ''}}</p>
                                                 
                                                    </div>
                                               <div class="brand-info">      
                                                                                            <p class="brand_tit">التفاصيل</p>
                                                    <p>{{ $brand->description ?? ''}}</p>
                                                    </div>
                                              </div>
                                        
                                            </div>
                                          </div>
                                        </div>
                                            <!--<a href="javascript:void(0);" class="icon-box-info">-->
                                            <!--    <div class="icon-cell bg-gray">-->
                                            <!--        <img src="{{ $brand->photo ? $brand->photo->getUrl('thumb') : '' }}" class="rounded-circle" alt="">-->
                                            <!--    </div>-->
                                            <!--    <span>{{ $brand->title ?? ''}}</span>-->
                                            
                                            <!--</a>-->
                                        </li> 
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="dlab-divider bg-gray-dark"></div>
                        <div class="clear" id="comment-list">
                            <div class="comments-area" id="comments">
                                <h3 class="font-26">تقييم الزوار</h3>
                                <div class="clearfix">
                                    <!-- comment list END -->
                                    <ol class="comment-list">
                                        @foreach($event->reviews as $review)
                                            <li class="comment">
                                                <div class="comment-body">
                                                    <div class="comment-author vcard">
                                                        @php
                                                            if($review->user && $review->user->photo){
                                                                $user_image = $review->user->photo->getUrl('preview');
                                                            }else{
                                                                $user_image = '';
                                                            }
                                                        @endphp
                                                        <img class="avatar photo" src="{{ $user_image }}" alt="" />
                                                        <cite class="fn">{{ $review->user->name ?? '' }} </cite>
                                                    </div>
                                                    <div class="comment-meta">
                                                        <a href="javascript:void(0);">{{ $review->pivot->created_at ? date('F j, Y',strtotime($review->pivot->created_at)) : '' }}</a>
                                                        <ul class="featured-star">
                                                            @for($i = 0 ; $i <= round($review->pivot->rate) ; $i++)
                                                                <li><i class="fa fa-star"></i></li>
                                                            @endfor 
                                                        </ul>
                                                    </div>
                                                    <p>
                                                        {{ $review->pivot->review ?? '' }}
                                                    </p>
                                                </div>
                                            </li> 
                                        @endforeach
                                    </ol>
                                    <!-- comment list END -->
                                    <!-- Form -->
                                    {{-- <h3 class="font-26">اكتب تعليقك</h3>
                                    <div class="comment-respond" id="respond">
                                        <form class="comment-form" id="commentform" method="post" action="#">
                                            <div class="comment-form-rating">
                                                <div class="starrr"></div>
                                                <div class="rating-widget">
                                                    <!-- Rating Stars Box -->
                                                    <div class="rating-stars">
                                                        <ul id="stars">
                                                            <li class="star" title="Poor" data-value="1">
                                                                <i class="fa fa-star fa-fw"></i>
                                                            </li>
                                                            <li class="star" title="Fair" data-value="2">
                                                                <i class="fa fa-star fa-fw"></i>
                                                            </li>
                                                            <li class="star" title="Good" data-value="3">
                                                                <i class="fa fa-star fa-fw"></i>
                                                            </li>
                                                            <li class="star" title="Excellent" data-value="4">
                                                                <i class="fa fa-star fa-fw"></i>
                                                            </li>
                                                            <li class="star" title="WOW!!!" data-value="5">
                                                                <i class="fa fa-star fa-fw"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="comment-form-comment">
                                                <label for="comment">التعليقات</label>
                                                <textarea rows="8" name="comment" placeholder="من فضلك اكتب تعليقك"
                                                    id="comment"></textarea>
                                            </p>
                                            <p class="comment-form-author">
                                                <label for="author">الاسم<span class="required">*</span></label>
                                                <input type="text" value="" name="Author" placeholder="الاسم" id="author" />
                                            </p>
                                            <p class="comment-form-email">
                                                <label for="email">البريد الالكتروني
                                                    <span class="required">*</span></label>
                                                <input type="text" value="" placeholder="البريد الالكتروني" name="email"
                                                    id="email" />
                                            </p>

                                            <p class="form-submit">
                                                <input type="submit" value="نشر التعليق" class="submit site-button"
                                                    id="submit" name="submit" />
                                            </p>
                                        </form>
                                    </div> --}}
                                    <!-- Form -->
                                </div>
                            </div>
                        </div>
                        <!-- blog END -->
                    </div>
                    <!-- Left part END -->
                    <!-- Side bar start -->
                    <div class="col-xl-4 col-lg-5 col-md-12 sticky-top p-b30">
                        <aside class="side-bar listing-side-bar">
                            <div class="widget widget_map">
                                <div id="map" class="m-b30 align-self-stretch" style="width: 100%; height: 400px"></div>
                                <a href="javascript:void(0)"
                                    class=" site-button button-lg radius-xl m-b30  text-uppercase ">الموقع
                                    على الخريطة</a>
                            </div>
                            {{-- <div class="widget widget_time">
                                <h4 class="m-b10">ساعات العمل</h4>
                                <div class="dlab-separator bg-primary m-b20"></div>
                                <ul class="m-b0">
                                    <li>
                                        <a href="javascript:void(0)">السبت</a> 08:00am - 11:00pm
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">الاحد</a> 08:00am - 11:00pm
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">الاثنين</a> 12:00am -
                                        11:00pm
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">الثلاثاء</a> 08:00am -
                                        11:00pm
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">الاربعاء</a> 03:00pm -
                                        02:00am
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">الخميس</a> 03:00pm -
                                        02:00am
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">الجمعة</a> 03:00pm -
                                        02:00am
                                    </li>
                                </ul>
                            </div> --}}
                            <div class="widget widget_share">
                                <h4 class="m-b10">مشاركة الفعالية</h4>
                                <div class="dlab-separator bg-primary m-b20"></div>
                                <ul class="list-inline m-a0 text-white">
                                    <li>
                                        <a href="http://www.facebook.com/sharer.php?u={{ route('frontend.event',$event->id) }}" class="site-button facebook circle"><i
                                                class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="mailto:?Subject={{ $event->title }}&Body=I%20saw%20this%20and%20thought%20of%20you!%20 {{ route('frontend.event',$event->id) }}" class="site-button google-plus circle"><i
                                                class="fa fa-google-plus"></i></a>
                                    </li>
                                    <li>
                                        <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ route('frontend.event',$event->id) }}" class="site-button linkedin circle"><i
                                                class="fa fa-linkedin"></i></a>
                                    </li>
                                    {{-- <li>
                                        <a href="javascript:void(0);" class="site-button instagram circle"><i
                                                class="fa fa-instagram"></i></a>
                                    </li> --}}
                                    <li>
                                        <a href="http://twitter.com/share?url={{ route('frontend.event',$event->id) }}&text={{ $event->title }}&hashtags=#" class="site-button twitter circle"><i
                                                class="fa fa-twitter"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                    <!-- Side bar END -->
                </div>
            </div>
        </div>
        <!-- contact area END -->
    </div>
    <!-- Content END-->
@endsection

@section('scripts')
    
    <script src="{{ asset('frontend/js/jquery.star-rating-svg.js')}}"></script>
    <!-- STAR RATING SVG -->
    
    <!-- GOOGLE MAP -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <!-- Google API For Recaptcha  -->
    <script src="{{ asset('frontend/js/map.script.js') }}"></script>
    <!-- CONTACT JS  -->
    <script type="text/javascript">

        var map;
        var lat = parseFloat(document.getElementById('latitude').value);
        var lng = parseFloat(document.getElementById('longitude').value);
       
           function initAutocomplete() {
                  var pos = {lat:  lat ,  lng:lng };
                  map = new google.maps.Map(document.getElementById('map'), {
                      zoom: 12,
                      center: pos
                  });
              infoWindow = new google.maps.InfoWindow;
                  geocoder = new google.maps.Geocoder();
                  marker = new google.maps.Marker({
                      position: pos,
                      map: map,
                      title: ''
                  });
                  infoWindow.setContent('موقع الفعاليه');
                  infoWindow.open(map, marker);
          }
      </script>
      
      <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9D9VYMWp1sTVSDnGToKdKN4RnEtfyuAY&callback=initAutocomplete">
      </script>
      @endsection
