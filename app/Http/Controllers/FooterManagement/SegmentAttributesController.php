<?php

namespace App\Http\Controllers\FooterManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SegmentAttributes;
use Yajra\Datatables\Datatables;

class SegmentAttributesController extends Controller
{
    //Protected module segment by slug
    public function __construct()
    {
        $this->middleware('perm.acc:segment-attributes');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public index segment
    public function index()
    {
        return view('panel.footer-management.segment-attributes.index');
    }

    //find data categories
    public function find(Request $request)
    {
        if ($request->id) {
            $category = SegmentAttributes::where('slug', $request->slug)->first();
            if (count($category) > 0) {
                return ($request->id == $category->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (SegmentAttributes::where('slug', $request->slug)->first() ? 'false' : 'true');
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
        return view('panel.footer-management.segment-attributes.form-create');
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
        $attr = new SegmentAttributes();
        $attr->name = $request->name;
        $attr->type = $request->type;
        $attr->url = $request->url;
        $attr->urlicon = $request->urlicon;
        $attr->icon = $request->icon;
        $attr->textArea = $request->textArea;
        $attr->save();

        if ($request->hasFile('media')) {
            $pictureFile = $request->file('media');
            $extension = $pictureFile->getClientOriginalExtension();
            $destinationPath = public_path('/img/avatars');
            $pictureFile->move($destinationPath, $attr->id.'.'.$extension);
            $attr->media = $attr->id.'.'.$extension;
            $attr->urlmedia = $request->urlmedia;
        }

        $attr->save();
        
        return redirect()->route('segment-attributes.index')->with('toastr', 'new');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //for getting datatable at index
    public function show(Request $request, $action){
        $attr = SegmentAttributes::all();
        
        return Datatables::of($attr)
            ->addColumn('action', function ($attr) {
                return 
                    '<a class="btn btn-success btn-sm" href="'.route('segment-attributes.edit',['id' => $attr->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('segment-attributes.destroy',['id' => $attr->id]).'">'.method_field('DELETE').csrf_field().
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
        $attr = SegmentAttributes::find($id);
        return view('panel.footer-management.segment-attributes.form-edit')->with(['attr'=>$attr]);
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
        $attr = SegmentAttributes::find($id);
        $attr->name = $request->name;
        $attr->type = $request->type;
        $attr->url = $request->url;
        $attr->urlicon = $request->urlicon;
        $attr->icon = $request->icon;
        $attr->urlmedia = $request->urlmedia;
        $attr->textArea = $request->textArea;
        $attr->save();

        if ($request->hasFile('media')) {
            $pictureFile = $request->file('media');
            $extension = $pictureFile->getClientOriginalExtension();
            $destinationPath = public_path('/img/avatars');
            if($attr->media != '' || $attr->media != null){
                    File::delete(public_path('/img/avatars/'.$attr->media));
                }
            $pictureFile->move($destinationPath, $attr->id.'.'.$extension);
            $attr->media = $attr->id.'.'.$extension;
        }

        $attr->save();
        return redirect()->route('segment-attributes.index')->with('update', 'Segment Atrributes updated!');
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
        $segment = SegmentAttributes::find($id);
        $segment->delete();
        
        return redirect()->route('segment-attributes.index')->with('dlt', 'Segment Atrributes deleted!');
    }
}
