<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Products;
use App\News;
use App\ProductCate;
use App\NewsLetter;
use App\Recruitment;
use DB,Cache,Mail, Session;
use Cart;
use App\Campaign;
use App\Bill;
use App\CampaignCard;
use App\District;
use App\ChiNhanh;
class IndexController extends Controller {
	protected $setting = NULL;

	
	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		session_start();
    	$setting = DB::table('setting')->select()->where('id',1)->get()->first();
    	
    	$cateProducts = DB::table('product_categories')->where('parent_id',0)->get();
    	
    	$about = DB::table('about')->where('com','gioi-thieu')->get();
    	Cache::forever('setting', $setting);
        Cache::forever('about', $about);
       
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$news = DB::table('news')->where('status',1)->where('noibat',1)->where('com','cong-trinh')->take(12)->orderBy('id','desc')->get();
		$products = DB::table('products')->where('status',1)->take(20)->orderBy('id','desc')->get();
		$categories_home = DB::table('product_categories')->where('status',1)->where('noibat',1)->orderBy('stt','asc')->get();
		$feedbacks = DB::table('feedback')->get();
		$partners = DB::table('partner')->get();
		$setting =DB::table('setting')->select()->where('id',1)->get()->first();
		$about = DB::table('about')->where('com','gioi-thieu')->first();
		$title = $setting->title;
		$keyword = $setting->keyword;
		$description = $setting->description;	
		$cate_pro = DB::table('product_categories')
			->where('status',1)
			->where('parent_id',0)
			->where('com','san-pham')
			->orderby('stt','asc')->get();	
		$com = 'index';
		// End cấu hình SEO
		$img_share = asset('upload/hinhanh/'.$setting->photo);
		return view('templates.index_tpl', compact('com','keyword','description','title','img_share','partners','products','categories_home','feedbacks','news','about','cate_pro','cateNews'));
	}
	public function getProduct(Request $req)
	{
		$cate_pro = DB::table('product_categories')
			->where('status',1)
			->where('parent_id',0)
			->where('com','san-pham')
			->orderby('stt','asc')->get();
		
		$products = DB::table('products')->where('status',1)->where('com','san-pham')->orderBy('id','desc')->paginate(12);
		$com='san-pham';		
		$title = "Decor";
		$keyword = "Decor";
		$description = "Decor";
		// $img_share = asset('upload/hinhanh/'.$banner_danhmuc->photo);
		
		// return view('templates.product_tpl', compact('product','banner_danhmuc','doitac','camnhan_khachhang','keyword','description','title','img_share'));
		
		return view('templates.product_tpl', compact('title','keyword','description','products', 'com','cate_pro'));
	}


	public function getProductList($id, Request $req)
	{
		$cate_pro = DB::table('product_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
        $com = 'san-pham';
        $product_cate = ProductCate::select('*')->where('status', 1)->where('alias', $id)->where('com','san-pham')->first();        
        if (!empty($product_cate)) {            
        	$cate_parent = DB::table('product_categories')->where('id', $product_cate->parent_id)->first();
        	$cateChilds = DB::table('product_categories')->where('parent_id', $product_cate->id)->get();
        	$array_cate[] = $product_cate->id;
        	if($cateChilds){
        		foreach($cateChilds as $cate){
        			$array_cate[] = $cate->id;
        		}
        	}        	
        	$products = Products::whereIn('cate_id', $array_cate)->orderBy('id','desc')->get();            
            if (!empty($product_cate->title)) {
                $title = $product_cate->title;
            } else {
                $title = $product_cate->name;
            }
            $keyword = $product_cate->keyword;
            $description = $product_cate->description;
            $img_share = asset('upload/product/' . $product_cate->photo);
            return view('templates.productlist_tpl', compact('products', 'product_cate', 'keyword', 'description', 'title', 'img_share', 'cate_pro', 'cate_parent', 'com'));
        } else {
            return redirect()->route('getErrorNotFount');
        }
	}

	

	public function getProductChild($alias){
		$cate = DB::table('product_categories')->where('alias',$alias)->first();
		$products = DB::table('products')->select()->where('status',1)->where('cate_id',$cate->id)->orderBy('id','desc')->paginate(20);
		$tintucs = DB::table('news')->orderBy('id','desc')->take(3)->get();
		return view('templates.productlist_level2', compact('tintucs','products'));
	}
	


	public function setCookies(Request $req, $id)
	{
		$idCookie = $id;
		$minutes = 1;
		$id_cookie = cookie('id_cookie', $idCookie, $minutes);

		return response()
			->view('templates.product_detail_tpl')
			->withCookie($id_cookie);
	}

	public function getProductDetail($id, Request $req)
	{
        
        $cate_pro = DB::table('product_categories')->where('status',1)->orderby('id','asc')->get();
		$product_detail = DB::table('products')->select()->where('status',1)->where('alias',$id)->get()->first();
		if(!empty($product_detail)){
			$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','san-pham')->get()->first();
			// sản phẩm đã xem
			$_SESSION['daxem'][$product_detail->id] = $product_detail->id;
			$ids_session = $_SESSION['daxem'];
			$productDaXem = DB::table('products')->whereIn('id', $ids_session)->where('status', 1)->get();

			$album_hinh = DB::table('images')->select()->where('product_id',$product_detail->id)->orderby('id','asc')->get();
				
			$cateProduct = DB::table('product_categories')->select('name','alias')->where('id',$product_detail->cate_id)->first();
			$productSameCate = DB::table('products')->select()->where('status',1)->where('id','<>',$product_detail->id)->where('cate_id',$product_detail->cate_id)->orderby('stt','desc')->take(12)->get();			
			
			// Cấu hình SEO
			if(!empty($product_detail->title)){
				$title = $product_detail->title;
			}else{
				$title = $product_detail->name;
			}
			$keyword = $product_detail->keyword;
			$description = $product_detail->description;
			$img_share = asset('upload/product/'.$product_detail->photo);
			$com='san-pham';
			// End cấu hình SEO
			return view('templates.product_detail_tpl', compact('product_detail','banner_danhmuc','keyword','description','title','img_share','product_khac','album_hinh','cateProduct','productSameCate','tintucs','cate_pro','com', 'productDaXem'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
	}

	public function getAbout()
	{
		$about = DB::table('about')->where('com','gioi-thieu')->first();
		$partners =  DB::table('partner')->get();		
        $com = 'gioi-thieu';		
		 //Cấu hình SEO
		$title = 'Giới thiệu';
		$keyword = 'Giới thiệu';
		$description = 'Giới thiệu';
		// End cấu hình SEO

		return view('templates.about_tpl', compact('about','keyword','description','title','img_share','com','partners'));
	}
	public function getMember($alias)
	{
		$partners =  DB::table('partner')->get();		
        $com = 'gioi-thieu';
		$data = DB::table('partner')->where('url',$alias)->first();
		return view('templates.thanhvien', compact('data','partners','com'));
	}
	public function baogia()
	{
		$data = DB::table('about')->where('com','bao-gia')->first();
		$title = 'Báo giá';	
		return view('templates.baogia',compact('data','title'));
	}
	public function search(Request $request)
	{
		$search = $request->txtSearch;
		$com = 'tim-kiem';
		$cate_pro = DB::table('product_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
		// Cấu hình SEO
		$title = "Tìm kiếm: ".$search;
		$keyword = "Tìm kiếm: ".$search;
		$description = "Tìm kiếm: ".$search;
		$img_share = '';		
		$data = DB::table('products')->where('name', 'LIKE', '%' . $search . '%')
		->where('status',1)
		->orderBy('id','DESC')->get();
		// dd($data);
		return view('templates.search_tpl', compact('data','keyword','description','title','img_share','search','com','cate_pro'));
	}

	public function getNews()
	{		
		$tintuc = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')->orderby('id','desc')->paginate(8);	
		$hot_news = DB::table('news')->where('noibat',1)->where('status',1)->where('com','tin-tuc')->take(6)->orderby('id','desc')->get();	
		$cate_pro = DB::table('news_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
		$com='tin-tuc';
		// Cấu hình SEO
		$title = "Tin tức";
		$keyword = "Tin tức";
		$description = "Tin tức";
		$img_share = '';
		// End cấu hình SEO
		return view('templates.news_tpl', compact('tintuc','keyword','description','title','img_share','com','cateNews','hot_news','cate_pro'));
	}
	public function getListNews($alias)
	{
		//Tìm article thông qua mã id tương ứng
		$tintuc_cate = DB::table('news_categories')->select()->where('status',1)->where('com','tin-tuc')->where('alias',$alias)->first();
		$cateNews = DB::table('news_categories')->where('com','tin-tuc')->get();
		if(!empty($tintuc_cate)){

			$cate_pro = DB::table('news_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
			$cate_parents = DB::table('news_categories')->where('status',1)->where('parent_id',$tintuc_cate->id)->get();
			$ids=[];
			$ids[] = $tintuc_cate->id;
			foreach($cate_parents as $cate)
			{
				$ids[] = $cate->id;
			}
			$tintuc = DB::table('news')->select()->where('status',1)->whereIn('cate_id',$ids)->orderBy('id','desc')->get();
			$setting = Cache::get('setting');

			if(!empty($tintuc_cate->title)){
				$title = $tintuc_cate->title;
			}else{
				$title = $tintuc_cate->name;
			}
			
			$keyword = $tintuc_cate->keyword;
			$description = $tintuc_cate->description;
			$img_share = asset('upload/news/'.$tintuc_cate->photo);

			// End cấu hình SEO
			return view('templates.news_list', compact('tintuc','tintuc_cate','banner_danhmuc','keyword','description','title','img_share','tintuc_moinhat_detail','hot_news', 'cateNews','cate_pro'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
	}
	
	public function getNewsDetail($alias)
	{
		$news_detail = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')->where('alias',$alias)->first();
		
		if(!empty($news_detail)){			
			$cate_pro = DB::table('news_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
			$album_hinh = DB::table('images')->select()->where('news_id',$news_detail->id)->orderby('id','asc')->get();
			$newsSameCate = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')->where('cate_id',$news_detail->cate_id)->take(12)->get();	
			$com='tin-tuc';
			$setting = Cache::get('setting');
			// Cấu hình SEO
			if(!empty($news_detail->title)){
				$title = $news_detail->title;
			}else{
				$title = $news_detail->name;
			}
			$keyword = $news_detail->keyword;
			$description = $news_detail->description;
			$img_share = asset('upload/news/'.$news_detail->photo);

			return view('templates.news_detail_tpl', compact('news_detail','com','keyword','description','title','img_share','album_hinh','newsSameCate','cate_pro'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
		
	}
	
	public function anhcongtrinh()
	{
		$data = News::where('status',1)->where('com','cong-trinh')->orderBy('id','desc')->paginate(20);
		$title = 'Ảnh công trình';
		$com = 'cong-trinh';
		return view('templates.congtrinh', compact('title','data','com'));
	}
	public function listCongTrinh($alias)
	{
		$com = 'cong-trinh';
		$detail = DB::table('news_categories')->where('status',1)->where('alias',$alias)->first();
		$data = News::where('cate_id',$detail->id)->paginate(20);
		if(!empty($detail->title)){
			$title = $detail->title;
		}else{
			$title = $detail->name;
		}
		$keyword = $detail->keyword;
		$description = $detail->description;
		$img_share = asset('upload/news/'.$detail->photo);
		return view('templates.list_congtrinh', compact('title','description','keyword','com','data','detail'));
	}
	public function detailCongTrinh($alias)
	{
		$com = 'cong-trinh';
		$data = News::where('alias',$alias)->where('com','cong-trinh')->first();
		if(!empty($data->title)){
				$title = $data->title;
			}else{
				$title = $data->name;
			}
			$keyword = $data->keyword;
			$description = $data->description;
			$img_share = asset('upload/news/'.$data->photo);
		return view('templates.detail_congtrinh', compact('title','description','keyword','data','com','img_share'));
	}
	public function postNewsLetter(Request $request)
	{
		$this->validate($request,
            ["txtEmail" => "required"],
            ["txtEmail.required" => "Bạn chưa nhập email"]
        );
        $kiemtra_mail = DB::table('newsletter')->select()->where('status',1)->where('com','newsletter')->where('email',$request->txtEmail)->get()->first();
        if(empty($kiemtra_mail)){
			$data = new NewsLetter();
			$data->name = $request->txtName;
			$data->email = $request->txtEmail;
			$data->phone = $request->txtPhone;
			$data->content = $request->txtContent;
			$data->status = 1;
			$data->com = 'newsletter';
			$data->save();

			echo "<script type='text/javascript'>
				alert('Bạn đã đăng kí nhận tin tức thành công !');
				window.location = '".url('/')."' </script>";
		}else{
			echo "<script type='text/javascript'>
				alert('Email này đã đăng ký !');
				window.location = '".url('/')."' </script>";
		}
	}
	public function getErrorNotFount(){
		$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','san-pham')->get()->first();
		return view('templates.404_tpl',compact('banner_danhmuc'));
	}

	public function design()
	{
		$com='thiet-ke';
		$title = 'Thiết kế';
		$data = DB::table('news')->where('status',1)->where('com','thiet-ke')->orderBy('id','desc')->get();
		return view('templates.design', compact('title','com','data'));
	}
	public function listDesign($alias)
	{
		$data = DB::table('news_categories')->where('alias',$alias)->first();
		$categories = DB::table('news_categories')->where('parent_id',$data->id)->get();
		$ids = [];
		$ids[] = $data->id;
		foreach($categories as $cate){
			$ids[] = $cate->id;
		}
		$results = DB::table('news')->where('com','thiet-ke')->whereIn('cate_id', $ids)->orderBy('id','desc')->get();
		if($data->title !=''){
			$title = $data->title;
		}else{
			$title = $data->name;
		}
		$description = $data->description;
		$keyword = $data->keyword;
		$com = 'thiet-ke';
		return view('templates.list_design', compact('data','title','keyword','description','com','results'));
	}
	public function designDetail($alias)
	{
		$data = DB::table('news')->where('com','thiet-ke')->where('alias',$alias)->first();
		$albums = DB::table('images')->where('news_id',$data->id)->get();
		if($data->title !=''){
			$title = $data->title;
		}else{
			$title = $data->name;
		}
		$description = $data->description;
		$keyword = $data->keyword;
		$com = 'thiet-ke';
		$img_share = asset('upload/news/'.$data->photo);
		return view('templates.detail_design', compact('data','title','keyword','description','com','albums','img_share'));
	}
	
}
