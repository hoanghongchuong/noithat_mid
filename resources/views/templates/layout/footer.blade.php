<?php
    $setting = Cache::get('setting');
?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="col-md-6">
                    <a href=""><img src="{{asset('upload/hinhanh/'.$setting->photo_footer)}}" alt=""></a>
                    <p style="margin-top: 10px; color: #fff">{!! $setting->fax !!}</p>
                </div>
                <div class="col-md-6">
                    <p class="title_footer">{{$setting->company}}</p>
                    <p class="p-footer">Địa chỉ: {{$setting->address}}</p>
                    <p class="p-footer">Phone: {{$setting->phone}}</p>
                    <p class="p-footer">Email: {{$setting->email}}</p>
                    <p class="p-footer">Website: {{$setting->website}}</p>
                </div>
                <div class="col-md-12 box-map-footer">
                    {!! $setting->iframemap !!}
                </div>
            </div>
            <div class="col-md-3 box-fanpage">
                <p class="title_footer">Fanpage</p>
                <div class="fb-page" data-href="https://www.facebook.com/noithatmid.vn" data-tabs="timeline" data-width="270" data-height="340" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/noithatmid.vn" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/noithatmid.vn">Nội Thất Xanh - Sofa và Tre Ghép Thanh Cao Cấp</a></blockquote></div>
            </div>
            <p class="col-md-12" style="margin-top:20px;text-align: center; text-transform: uppercase; color: #fff">Copyright 2019 @ hope home. Thiết kế bởi hungthinhads</p>
        </div>
    </div>
</footer>