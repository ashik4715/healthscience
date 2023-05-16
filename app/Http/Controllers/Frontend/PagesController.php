<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\ArticleProcessingCharge;
use App\Models\Author\Submit;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Certification;
use App\Models\Contact;
use App\Models\Editor;
use App\Models\Faq;
use App\Models\ImageSlider;
use App\Models\OpenAccess;
use App\Models\PaperAccess;
use App\Models\Privacy;
use App\Models\PublishDate;
use App\Models\RefundPolicy;
use App\Models\Sub_menu;
use App\Models\Subcategory;
use App\Models\Submission_timer;
use App\Models\Term;
use App\Models\Testimonial;
use App\Models\announcements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Auth;

class PagesController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $publish_date = PublishDate::latest()->first();
        $journals = Submit::orderBy('id', 'DESC')
                            ->orderBy('id', 'DESC')
                            ->where('status', '=',1)
                            ->where('is_payment', '=',1)
                            ->where('publish','=',1)
                            ->paginate(5);
        $view_counts = Submit::orderBy('view_count', 'DESC')
                            ->where('is_payment', 1)
                            ->where('publish',1)
                            ->where('status', 1)
                            ->get();
        $ImageSlides = ImageSlider::all();
        $announcements = announcements::orderBy('id', 'DESC')->paginate(5);
        $blogs = Blog::all();
        $about = About::first();
        $submission_timer = Submission_timer::orderBy('id', 'desc')->first();
        $certifications = Certification::all();
        $testimonials = Testimonial::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('website.pages.index', compact('categories','journals','view_counts','ImageSlides','announcements','blogs','submission_timer','about','certifications','testimonials','publish_date'));
    }

    public function single_article($url)
    {
        $contact = Contact::all();
        $article = Submit::orderBy('id', 'DESC')
            ->where('status', 1)
            ->where('is_payment', 1)
            ->where('publish',1)
            ->where('title_slug', $url)
            ->first();
        return view('website.pages.single_article', compact('article', 'contact'));
    }

    public function get_paper_access_key(){
        $article_id = Input::get('article_id');
        $access_key = Input::get('access_key');
        if (Submit::where('paper_access_key',$access_key)->where('id',$article_id)->count()>0) {
            $article = Submit::orderBy('id', 'DESC')
                ->where('status', 1)
                ->where('is_payment', 1)
                ->where('publish',1)
                ->where('id', $article_id)
                ->where('paper_access_key', $access_key)
                ->first();
            $volume = Submission_timer::find($article->issue_id);
            return redirect('volume/'.$volume->cat_folder.'/'.$volume->volume.'/'.$volume->issue.'/'.$article->pdf);
        }else{
            return back()->with("danger","Access Key Doesn't match");
        }
    }

    public function send_request(Request $request){
        $this->validate($request, [
            'article_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'inputcountryname' => 'required',
        ]);

        if (PaperAccess::where('submit_id',$request->article_id)->where('email',$request->email)->count()>0) {
            return back()->with("danger","Already send a request");
        }else{
            $ip = request()->ip();

            $vpnurl = "https://proxycheck.io/v2/{$ip}";
            $details = json_decode(file_get_contents($vpnurl));
            $arr = (array) $details;

            $data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            $paper_access = new PaperAccess();
            $paper_access->user_id = $request->authId;
            $paper_access->submit_id = $request->article_id;
            $paper_access->name = $request->name;
            $paper_access->email = $request->email;
            $paper_access->systemcountryname = $data->geoplugin_countryName;
            $paper_access->inputcountryname = $request->inputcountryname;
            $paper_access->use_proxy = $arr[$ip]->proxy;
            $paper_access->save();

            return back()->with('success','A notification will send to your mail soon');
        }
    }

    public function article_search_result(Request $request)
    {
        $title_or_keyword = $request->title_or_keyword;
        $journal_category = $request->journal_category;

        $categories = Category::orderBy('id', 'asc')->get();
        $certifications = Certification::all();

        $journals = Submit::orderByDesc('id')
                        ->Where('journal_id', 'LIKE', '%' . $journal_category . '%')
                        ->Where(function ($query) use ($title_or_keyword) {
                            $query->where('ptitle', 'LIKE', '%' . $title_or_keyword . '%')
                                    ->orWhere('paper_id', 'LIKE', '%' . $title_or_keyword . '%');
                            })
                        ->Where([
                            ['status',1],
                            ['is_payment',1],
                            ['publish',1],
                        ])
                        ->paginate(5);

        $journals->appends ( array (
            'ptitle' => $title_or_keyword
        ));

        $view_counts = Submit::orderBy('view_count', 'DESC')
                                ->where('is_payment', 1)
                                ->where('publish',1)
                                ->where('status', 1)
                                ->get();

        $announcements = announcements::all();
        $submission_timer = Submission_timer::first();

        return view('website.pages.article_search_result',compact('categories','journals','view_counts','announcements','submission_timer','certifications','testimonials'));
    }

    public function about_us()
    {
        $about_us = About::first();
        $contacts = Contact::all();
        return view('website.pages.about_us', compact('about_us','pictures','contacts'));
    }

    public function contact_us()
    {
        $contacts = Contact::all();
        return view('website.pages.contact', compact('contacts'));
    }

    public function apc()
    {
        $contact = Contact::all();
        $apcs = ArticleProcessingCharge::all();
        $categories = Category::all();
        return view('website.pages.apc', compact('apcs', 'contact','categories'));
    }

    public function open_access()
    {

        $contact = Contact::all();
        $open_access = OpenAccess::all();
        $categories = Category::all();
        $journals = Submit::orderBy('id', 'DESC')->where('status', 1)->paginate(5);
        return view('website.pages.open_access', compact('contact','open_access','categories','journals'));
    }

    public function terms_condition()
    {
        $contact = Contact::all();
        $terms = Term::all();
        return view('website.pages.terms_condition', compact('terms', 'contact'));
    }

    public function privacy_policy()
    {
        $contact = Contact::all();
        $privacys = Privacy::all();
        return view('website.pages.privacy_policy', compact('privacys', 'contact'));
    }

    public function refund_policy()
    {
        $contact = Contact::all();
        $refund_policys = RefundPolicy::all();
        return view('website.pages.refund_policy', compact('refund_policys', 'contact'));
    }

    public function authors()
    {
        $contacts = Contact::all();
        $categories = Category::all();
        return view('website.pages.authors', compact('categories', 'contacts'));
    }

    public function editors()
    {
        $contact = Contact::all();
        $editors = Editor::paginate(10);

        return view('website.pages.editors', compact('contact','editors'));
    }

    public function faq()
    {
        $faqs = Faq::all();
        // return $faqs;
        return view('website.pages.faq',compact('faqs'));
    }
    public function aim_and_scope(){
        return view('website.pages.aim_and_scope');
    }

    public function paper_submission_guideline(){
        return view('author.pages.paper_submission_guideline');
    }


}
