<?php

namespace App\Http\Controllers\mailManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Member;
use App\Email;
use Auth;
use Mail;

class mailController extends Controller
{
    //Protected module mail by slug
    public function __construct()
    {
        $this->middleware('perm.acc:mail');
    }
    
    //public index mail
    public function index()
    {
        return view('panel.email-management.mail.index');
    }
    
    //view form create
    public function create()
    {   
    	$name = Auth::user()->name;
        $id = Auth::user()->id;
        $email = Member::all();
        return view('panel.email-management.mail.form-create')->with([
            'name' => $name,
            'id' => $id,
            'emails' => $email,
        ]);
        

    }

    //store data mail
    public function store(Request $request)
    {
        $mail = new Email();
        $mail->adminId = $request->adminId;
        $mail->memberEmail = $request->memberEmail;
        $mail->subject = $request->subject;
        $mail->content = $request->content;
        $mail->comment = $request->comment;
        $mail->save();

        $data=[
            'memberEmail'=>$request->memberEmail,
            'subject'=>$request->subject,
            'content' => $request->content,
        ];

        Mail::send('panel.email-management.mail.mail',$data,function($message) use ($data){
            $message->from((Auth::user()->email),'Admin Fiture');
            $message->to($data['memberEmail']);
            $message->subject($data['subject']);

            });

        return redirect()->route('mail.index')->with('toastr', 'mail');
    }

    //for getting datatable at index
    public function show(Request $request, $action){
        $mails = Email::select(['id','adminId','memberEmail','subject', 'content','comment', 'created_at']);
        
        return Datatables::of($mails)
            ->addColumn('action', function ($mail) {
                return
                    '<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('mail.edit',['id' => $mail->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit mail</button>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('mail.destroy',['id' => $mail->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    
    //delete data mail
    public function destroy($id)
    {
        $mail = Email::find($id);
        $mail->delete();
        return redirect()->route('mail.index')->with('dlt', 'mail');
    }
}
