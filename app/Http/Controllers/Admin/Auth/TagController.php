<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(Request $request) 
    {
    	$count = Tag::all();
		$title='Manage Tag';
		
     	if($request->input('search')=='search')
    	{
    		$search_txt = $request->tag_name;
    		$tags  = Tag::select('id','name','status')->orderBy('name','asc')->where('name','LIKE','%'.$search_txt.'%')->paginate(50);
    	}
    	else
    	{       		
			$tags  = Tag::paginate(50);	       
    	}
		
    	return view('admin.tags.index',compact('title','tags','count'));
    }
    
    public function create()
    {
        $title='Tag';
		//$tag_parent  = Tag::all();
		
		/* $sql = "select category1.name as name1, category2.name as name2, category1.id,category1.parent_id";
$sql .= " from category as category1 left join category as category2 on category1.id=category2.parent_id where category2.parent_id >0";
return DB::select($sql);
		 */
		 
		//$sql = "select tag1.name as name1, tag2.name as name2, tag1.id, tag1.parent_id";
		//$sql .= " from tag as tag1 left join tag as tag2 on tag1.id=tag2.parent_id where tag2.parent_id ";
		
		$sql = "select tag1.name as name1, tag2.name as name2, tag1.id as id1 , tag1.parent_id from tag as tag1 left join tag as tag2 on tag1.id=tag2.parent_id";
		$tag_parent = DB::select($sql);
		
		//$tag_parent = Tag::where('parent_id', '<>', '0')->get();				
		//dd($tag_parent);	

		
        $count = Tag::count();		
			  
        return view('admin.tags.create', compact('title','tag_parent','count'));
    }
   
    public function store(Request $request)
    {
        $title='Tag';		
        $request->validate([
          'title' => 'required',            
        ]);		
		//dd($request);die;       
        $tag = new Tag;       
        $tag->name = $request->title;	
		
        if(!empty($request->parent_name)){
			
		  $tag->parent_id = $request->parent_name;		 
		}
		
        $tag->status = $request->status;
        $tag->save();
     
        return redirect()->route('admin.tags.index')
        ->with('success','Tag has been created successfully.');
    }
    
    public function show($id)
    {
        $title='Tag Manage';	
        $tag = Tag::findOrFail($id);
        return view('admin.tags.show', compact('tag','title'));
    }
   
    public function edit($id)
    {
        $title='Tag';
        //$tag_parent  = Tag::all();
        $tag = Tag::findOrFail($id);
		
		$sql = "select tag1.name as name1, tag2.name as name2, tag1.id as id1 , tag1.parent_id from tag as tag1 left join tag as tag2 on tag1.id=tag2.parent_id";
		$tag_parent = DB::select($sql);
		
		//$product1 = Tag::find($id);
		//$tag_parent = Tag::where('parent_id', $tag->id)->get();
        //$tag_parent = Tag::where('parent_id', '<>', '0')->get();		
						
		//dd($tag_parent);
		
		$count = Tag::count();
        return view('admin.tags.edit',compact('tag','title','tag_parent','count')); 
    }
   
    public function update(Request $request, $id)
    {
		$request->validate([
            'title' => 'required',           
        ]);
       
        $tag = Tag::find($id);
        $tag->name = $request->title;       
        
		if(!empty($request->parent_name)){			
		  $tag->parent_id = $request->parent_name;		 
		} 
		
        $tag->status = $request->status;       
        $tag->save();      

        return redirect('admin/tags')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }
    
    public function destroy(Tag $tags,$id)
    {
	  //dd($id);die(); 
	   $tags = Tag::where('id', $id)->first()->delete();
       //$tags->delete();
       return redirect()->route('admin.tags.index')
        ->with('success','tag deleted successfully');
    }
}