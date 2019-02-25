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
                <div class="col-md-12">
                    <img src="images/map.png" style="width: 100%;height: 120px;" alt="">
                </div>
            </div>
            <div class="col-md-3">
                <p class="title_footer">Fanpage</p>
                <img src="images/fanpage.png" alt="" class="img-responsive">
            </div>
            <p class="col-md-12" style="margin-top:20px;text-align: center; text-transform: uppercase; color: #fff">Copyright 2019 @ hope home. Thiết kế bởi hungthinhads</p>
        </div>
    </div>
</footer>