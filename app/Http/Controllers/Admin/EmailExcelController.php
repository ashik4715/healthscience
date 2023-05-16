<?php

namespace App\Http\Controllers\Admin;

use App\Mail\SendMail;
use App\Models\Category;
use App\Models\EmailExcel;
use Box\Spout\Common\Type;
use Box\Spout\Reader\ReaderFactory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class EmailExcelController extends Controller
{
    public function sent(){
        $row = EmailExcel::where('status',1)->count();
        $sents = EmailExcel::orderBy('id','DESC')->where('status','1')->get();
        return view('admin.email-excel.sended', compact('sents','row'));
    }

    public function truncate(){
        DB::table('email_excels')->truncate();
        $categories = Category::all();
        $row = EmailExcel::where('status',0)->count();
        $email_excel = EmailExcel::where('status',0)->get();
        return redirect()->route('admin.email-excel.index', compact('email_excel','row','categories'));
    }
    
    public function send(Request $request){


        $this->validate($request, [
            'subject' => 'required|max:150',
            'message' => 'required',
            'category_id' => 'required'
        ]);

//        ============================= Checkbox One click send mail =================================
        $subject = $request->subject;
        $message = $request->message;
        $category = Category::find($request->category_id);
        $emailID[] = $request->emailID;


        $email = EmailExcel::where('status',0)->select('id','author_name','email')->get();

        try{
            foreach ($emailID as $k => $v){
                for ($i = 0; $i <= count($v) -1; $i++) {
                    Mail::to($email[$v[$i] - 1]->email)->queue(new SendMail($subject, $message, $email[$v[$i] - 1]->author_name, $category));
                    DB::table('email_excels')->where('id', $v[$i])->update(['status' => 1]);
                }
            }

            return back()->with('success','Email Sent Successfully!');
        }catch (\Exception $e) {
            return redirect()->route('admin.email-excel.index')
                ->with($e->getMessage());
        }

    }
    public function resend(){

        $total= EmailExcel::all()->where('status',1)->last()->id;

        for($i = 0; $i <= $total-1; $i++){
            DB::table('email_excels')->where('id',$i +1)->update(['status' => 0]);
        }
        return back();
    }



    public function index()
    {
        $categories = Category::all();
        $row = EmailExcel::where('status',0)->count();
        $email_excel = EmailExcel::where('status',0)->get();
        return view('admin.email-excel.index', compact('email_excel','row','categories'));
    }


    public function create()
    {
        return view('admin.email-excel.upload_excel', compact([]));
    }


    public function store(Request $request)
    {
        $file = public_path('admin/data/author_emails.xlsx');
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $reader = ReaderFactory::create(Type::XLSX);
            $reader->open($file);

            $insert_data = [];


            foreach ($reader->getSheetIterator() as $sheet) {
                if ($sheet->getIndex() > 0) break; // only first sheet

                foreach ($sheet->getRowIterator() as $row_index => $values) {

                    if ($row_index > 1) {
                        if (empty($values[0]) || $values[0] == "") {
                            continue;
                        } else if (empty($values[1]) ) {
                            return redirect()->back()->with('failure',
                                'Problem Detect Column [Publisher]! Could not blank!');
                        } else if (empty($values[2]) ) {
                            return redirect()->back()->with('failure',
                                'Problem Detect Column [Country]! Could not blank!');
                        } else if (empty($values[3]) ) {
                            return redirect()->back()->with('failure',
                                'Problem Detect Column [Email]! Could not blank!');
                        } else if ($values[1] == null) {
                            return redirect()->back()->with('failure',
                                'Author Name has Error in [Author Name] ' . $values[0] . '  Could not upload Excel File Correctly!');
                        } else if ($values[2] == null) {
                            return redirect()->back()->with('failure',
                                'Publisher has Error in [Publisher] ' . $values[0] . '  Could not upload Excel File Correctly!');
                        } else if ($values[3] == null) {
                            return redirect()->back()->with('failure',
                                'Error in [Email] ' . $values[0] . '  Could not upload Excel File Correctly!');
                        } else {

                            $existing_id = DB::table('email_excels')->select('author_name', 'email')->get();;
                            $excel_value = EmailExcel::get();
                            if ($excel_value->isEmpty()) {
                                $insert_data [] = [
                                    'author_name' => $values[0],
                                    'publisher' => $values[1],
                                    'country' => $values[2],
                                    'email' => $values[3],
                                    'year' => $values[4],
                                ];
                                // For the first Time Insertion If Empty
                            } else {
                                foreach ($existing_id as $key => $db_row) {
                                    if ($key > 0) {
                                        if ($db_row->email == $values[3]) {
                                            return back()->with('failure', 'Duplicate Email : ' . $db_row->email . ' exists');
                                        }
                                        else {
                                            continue;
                                        }
                                    }
                                }

                                // After DB duplicate checking insertion
                                $insert_data [] = [
                                    'author_name' => $values[0],
                                    'publisher' => $values[1],
                                    'country' => $values[2],
                                    'email' => $values[3],
                                    'year' => $values[4],
                                ];

                            }
                        }
                    }
                }
            }
            try {

                EmailExcel::insert($insert_data);
                return redirect()->route('admin.email-excel.index')
                    ->with('success', 'You have Uploaded an Excel Successfully');
            } catch (\Exception $e) {
                return redirect()->route('admin.email-excel.index')
                    ->with($e->getMessage());
            }
        }
    }



    public function show(EmailExcel $email_excel)
    {
        //
    }


    public function edit(EmailExcel $emailExcel)
    {
        //
    }

    public function update(Request $request, EmailExcel $email_excel)
    {
        //
    }


    public function destroy(EmailExcel $email_excel)
    {
        //
    }


}
