<?php

namespace App\Http\Controllers\FooterManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Footers;
use Yajra\Datatables\Datatables;

class FooterController extends Controller
{
    //Protected module footer by slug
    public function __construct()
    {
        $this->middleware('perm.acc:footer');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public index footer
    public function index()
    {
        $footers = Footers::all();
        return view('panel.footer-management.footer.index')->with(['footer'=>$footers]);
    }

    //find data categories
    public function find(Request $request)
    {

        if ($request->id) {
            $footer = Footers::where('slug', $request->slug)->first();
            if (count($footer) > 0) {
                return ($request->id == $footer->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (Footers::where('slug', $request->slug)->first() ? 'false' : 'true');
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //view form create
    public function create()
    {
        return view('panel.footer-management.footer.form-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store data segment
    public function store(Request $request)
    {
        $footer = new Footers();
        $arrLeft =[];
        for($i=0; $i < count($request->name); $i++){
            $arrLeft[] =[
                'name' => $request->name[$i],
                'link' => $request->link[$i]
            ];
        }
        $arrMiddle =[];
        for($i=0; $i < count($request->icon); $i++){
            $arrMiddle[] =[
                'icon' => $request->icon[$i],
                'value' => $request->value[$i]
            ];
        }

        $footer->left=$arrLeft;
        $footer->middle=$arrMiddle;
        $footer->save();

        $arrPic = [];
        $i = 0;

        //add picture product
        $j = count($arrPic);
        $pictureFiles = $request->file('image');
        for($i=0; $i < count($pictureFiles); $i++){
            $destinationPath = public_path('/img/avatars');
            $extension = $pictureFiles[$i]->getClientOriginalExtension();
            $pictureFiles[$i]->move($destinationPath, '['. $j . ']' . $footer->id . '.' . $extension);
            $arrPic[] = [
                'filename' => '['. $j . ']' . $footer->id . '.' . $extension,
                'size' => $pictureFiles[$i]->getClientSize(),
                'linkimg' => $request->linkimg[$i]
            ];
            $j++;
        }
        $footer->mitra = $arrPic;
        $footer->address=$request->address;
        $footer->fromdays=$request->fromdays;
        $footer->todays=$request->todays;
        $footer->from=$request->from;
        $footer->to=$request->to;
        $footer->copyright=$request->copyright;
        $footer->save();
        
        return redirect()->route('footer.index')->with('toastr', 'new');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //for getting datatable at index
    public function show(Request $request, $action){
        $carriers = Footers::all();
        
        return Datatables::of($carriers)
            ->addColumn('action', function ($carriers) {
                return 
                    '<a class="btn btn-success btn-sm"  href="'.route('footer.edit',['id' => $carriers->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('footer.destroy',['id' => $carriers->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //view form edit
    public function edit($id)
    {
        $footer = Footers::find($id);
        $att = Footers::whereIn('name', array_column($footer->left,'name'))->get();
        $attr = Footers::whereIn('value', array_column($footer->middle,'value'))->get();
        $attrs = Footers::whereIn('filename', array_column($footer->mitra,'filename'))->get();
        return view('panel.footer-management.footer.form-edit')->with([
            'footer'=>$footer,
            'att'=>$att,
            'attr'=>$attr,
            'attrs'=>$attrs
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update data courier
    public function update(Request $request, $id)
    {
        $footer = Footers::find($id);
        $arrLeft =[];
        for($i=0; $i < count($request->name); $i++){
            $arrLeft[] =[
                'name' => $request->name[$i],
                'link' => $request->link[$i]
            ];
        }
        $arrMiddle =[];
        for($i=0; $i < count($request->icon); $i++){
            $arrMiddle[] =[
                'icon' => $request->icon[$i],
                'value' => $request->value[$i]
            ];
        }

        $footer->left=$arrLeft;
        $footer->middle=$arrMiddle;
        $footer->save();

        $arrPic = [];
        $i = 0;
        if ($request->hasFile('image')) {
        //add picture product
        $j = count($arrPic);
        $pictureFiles = $request->file('image');
        for($i=0; $i < count($pictureFiles); $i++){
            $destinationPath = public_path('/img/avatars');
            $extension = $pictureFiles[$i]->getClientOriginalExtension();
            $pictureFiles[$i]->move($destinationPath, '['. $j . ']' . $footer->id . '.' . $extension);
            $arrPic[] = [
                'filename' => '['. $j . ']' . $footer->id . '.' . $extension,
                'size' => $pictureFiles[$i]->getClientSize(),
                'linkimg' => $request->linkimg[$i]
            ];
            $j++;
        }
        $footer->mitra = $arrPic;
        }  
        $footer->address=$request->address;
        $footer->fromdays=$request->fromdays;
        $footer->todays=$request->todays;
        $footer->from=$request->from;
        $footer->to=$request->to;
        $footer->copyright=$request->copyright;
        $footer->save();
        return redirect()->route('footer.index')->with('update', 'Footers updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //delete data carriers
    public function destroy($id)
    {
        $footer = Footers::find($id);
        $footer->delete();
        
        return redirect()->route('footer.index')->with('dlt', 'Footers deleted!');
    }
}
