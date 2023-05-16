<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Sendpaperlink;
use App\Models\Author\Submit;
use App\Models\PaperAccess;
use App\Models\Submission_timer;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaperaccessController extends Controller
{

    public function index(Request $request)
    {
        $paperacces = DB::table('paper_accesses as pa')
                        ->join('submits as sub','sub.id','pa.submit_id')
                        ->orderBy('id','DESC')
                        ->select('pa.*','sub.id as subid','sub.paper_id as paper_id','sub.paper_access_key as key')
                        ->get();
        return view('admin.paper-access.index', compact('paperacces'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, $id)
    {
        PaperAccess::where('id',$id)->update(['is_denied' => 1]);
        return back()->with('danger','Request is Denied!');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $info = PaperAccess::where('id',$request->access_id)->first();
        $article = Submit::orderBy('id', 'DESC')
                ->where('status', 1)
                ->where('is_payment', 1)
                ->where('publish',1)
                ->where('id', $request->article_id)
                ->first();
        $volume = Submission_timer::find($article->issue_id);
        $url = url('volume/'.$volume->cat_folder.'/'.$volume->volume.'/'.$volume->issue.'/'.$article->pdf);
        Mail::to($info->email)->queue(new Sendpaperlink($info, $url));
        PaperAccess::where('id',$request->access_id)->update(['is_accept' => 1]);
        return back()->with('success','URL Sent Succesfull!');
    }

    public function destroy($id)
    {
        $access = PaperAccess::find($id);
        $access->delete();
        return back()->with('success','Request delete Succesfull!');
    }
}
