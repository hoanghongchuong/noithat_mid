<?php 
namespace App\Http\Controllers;
use App\Contact;
use App\CV;
use Illuminate\Http\Request as Requests;
use DB,Cache,Mail,Request,File;
class ContactController extends Controller {
	protected $setting = NULL;

	public function __construct()
	{
	
	}

	public function getContact()
    {
        // Cấu hình SEO
		$title = "Liên hệ";
		$keyword = "Liên hệ";
		$description = "Liên hệ";
		$img_share = '';
		$com='lien-he';
		$about_lienhe = DB::table('about')->select()->where('com','lien-he')->get()->first();
		$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','lien-he')->get()->first();
		$com='lien-he';
		// End cấu hình SEO
        return view('templates.contact_tpl', compact('banner_danhmuc','lien-he','chinhanh','about_lienhe','keyword','description','title','img_share','com','com'));
    }

    /**
     * post contact action
     * @param  Request $request
     * @return redirect
     */
    public function postContact(Requests $request) {
		$setting = DB::table('setting')->select()->where('id',1)->get()->first();
		$data = new Contact();
		$data->name = $request->name;
		$data->phone = $request->phone;
		$data->address = $request->adress;
		$data->email = $request->email;
		$data->content = $request->content;
		// $value = [
  //               'full_name' => Request::input('name'),
  //               'phone' => Request::input('phone'),
  //               'email' => Request::input('email'),                
  //               'address' => Request::input('address'),                
  //               'content' => Request::input('content')
  //           ];
  //           Mail::send('templates.sendmail', $value, function ($msg) {
  //               $setting = Cache::get('setting');
  //               $msg->from(Request::input('email'),  'Hệ thống website thông báo');
  //               $msg->to($setting->email, 'Admin')->subject('Hệ thống thông báo');
                
  //           });
		$data->save();
		echo "<script type='text/javascript'>
			alert('Cảm ơn bạn đã gửi liên hệ. Chúng tôi sẽ liên hệ lại với bạn sớm nhất !');
			window.location = '".url('/')."' </script>";

	}
	
}
