<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

use App\Models\Postmeta;

use DataTables;
use Session;
use Validator;

use Auth;
class PostController extends Controller
{
    //

    public function index(){
    	return view("post.default");
    }

    public function postdatatable(){
    	 $post =Post::with("metadata")->get();
         return DataTables::of($post)
            ->editColumn('id', function ($post) {
                return $post->id;
            })
            ->editColumn('name', function ($post) {
                return $post->name;
            })
            ->editColumn('image', function ($post) {
                $email=array();
            	foreach ($post->metadata as $k) {
            		if($k->meta_key=="image"){
            			$email[]=$k->meta_value;
            		}            		
            	}
                return isset($email[0])?asset('upload/post').'/'.$email[0]:"";
            })  
            ->editColumn('user_name', function ($post) {
                return $post->user_name;
            })
            ->editColumn('brithdate', function ($post) {
                return $post->birthdate;
            }) 
            ->editColumn('email', function ($post) {
            	$email=array();
            	foreach ($post->metadata as $k) {
            		if($k->meta_key=="email"){
            			$email[]=$k->meta_value;
            		}            		
            	}
                return implode(",",$email);
            }) 
            ->editColumn('phone', function ($post) {
                $email=array();
            	foreach ($post->metadata as $k) {
            		if($k->meta_key=="phone"){
            			$email[]=$k->meta_value;
            		}            		
            	}
                return implode(",",$email);
            }) 

            ->editColumn('action', function ($post) {
                 $edit=url('savepost',array('id'=>$post->id));
                 $delete=url('deletepost',array('id'=>$post->id));
                 return '<a href="'.$edit.'"  rel="tooltip" class="m-b-10 m-l-5" data-original-title="Remove"><i class="fa fa-edit f-s-25" style="margin-right: 10px;font-size: x-large;"></i></a><a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="m-b-10 m-l-5" data-original-title="Remove" style="margin-right: 10px;"><i class="fa fa-trash f-s-25" style="font-size: x-large;"></i></a>';              
            })           
            ->make(true);
    }

    public function savepost($id){
    	$data=Post::with("metadata")->find($id);   
    	$phone=array(); 
    	$email=array(); 
    	$image=array(); 
    	if($data){
    		foreach ($data->metadata as $k) {
	    		if($k->meta_key=="phone"){
	    			$phone[]=$k->meta_value;
	    		}elseif($k->meta_key=="email"){
	    			$email[]=$k->meta_value;
	    		}elseif($k->meta_key=="image"){
	    			$image[]=$k->meta_value;
	    		}else{

	    		}
    	    }	
    	}    	
    	return view('post.savepost',compact('id','data','email','phone','image'));
    }

    public function updatepost(Request $request){
    		Validator::extend('without_spaces', function($attr, $value){
			    return preg_match('/^\S*$/u', $value);
			});    
    		if($request->get("id")==0){
    				$this->validate($request, [
			            "name"    => "required",
					    "user_name"    => "required|without_spaces|unique:post",
					    "birthdate"    => "required",
					    "email.*"  => "required",
					    "phone.*"  => "required",
			        ]);
    		}else{
    			$this->validate($request, [
			            "name"    => "required",
					    "user_name"    => "required|without_spaces|unique:post,user_name,".$request->get("id")."",
					    "birthdate"    => "required",
					    "email.*"  => "required",
					    "phone.*"  => "required",
			        ]);
    			
    		}
		 

    	if($request->get("id")==0){
    		$store=new Post();
    		$msg="Post Add Successfully";
    	}else{
    		$store=Post::find($request->get("id"));
    		$msg="Post Update Successfully";
    		$imagels=Postmeta::where("post_id",$request->get("id"))->where("meta_key",'image')->get();
    	//	print_r($imagels);exit;
    		Postmeta::where("post_id",$request->get("id"))->delete();
    	}
    	$store->name=$request->get("name");
    	$store->user_id=Auth::id();
    	$store->user_name=$request->get("user_name");
    	$store->birthdate=$request->get("birthdate");
    	$store->save();
    	$phone=$request->get("phone");
    	$email=$request->get("email");
    	foreach ($phone as $p) {
    		$phoadd=new Postmeta();
    		$phoadd->post_id=$store->id;
    		$phoadd->meta_key="phone";
    		$phoadd->meta_value=$p;
    		$phoadd->save();
    	}
    	foreach ($email as $p) {
    		$phoadd=new Postmeta();
    		$phoadd->post_id=$store->id;
    		$phoadd->meta_key="email";
    		$phoadd->meta_value=$p;
    		$phoadd->save();
    	}
    	$add_img=$request->get("real_image");
    	if($request->file("image")){             
             $data=$request->file("image");            
             foreach ($data as $k) {                
                         $file = $k;
		                 $filename = $file->getClientOriginalName();
		                 $extension = $file->getClientOriginalExtension() ?: 'png';
		                 $folderName = '/upload/post';
		                 $picture = mt_rand(100000, 999999). '.' . $extension;
		                 $destinationPath = public_path().'/upload/post/';
		                 $k->move($destinationPath, $picture);		                
                         $add_img[]=$picture; 
             } 
        }
        foreach ($add_img as $p) {
            $phoadd=new Postmeta();
			$phoadd->post_id=$store->id;
			$phoadd->meta_key="image";
			$phoadd->meta_value=$p;
			$phoadd->save();
		}
		
         if(!empty($add_img)){
         	if(isset($imagels)&&count($imagels)>0){
         		foreach ($imagels as $k) {
                if(!in_array($k->meta_value,$add_img)){
                    $image_path = public_path() ."/upload/post/".$k->meta_value;
                    if(file_exists($image_path)) {
                       
                                 unlink($image_path);
                           
                    }
                }
            }
         	}           
        }
        Session::flash('message',$msg); 
        Session::flash('alert-class', 'alert-success');
        return redirect("post");
    }

    public function deletepost($id){
    	$del=Post::find($id);
    	if($del){
    		$del->delete();
    		$getimage=Postmeta::where("post_id",$id)->where("meta_key","image")->get();
    		foreach ($getimage as $k) {
    			 $image_path = public_path() ."/upload/post/".$k->meta_value;
                    if(file_exists($image_path)) {
                        try{
                                unlink($image_path);
                            }
                        catch(\Exception $e)
                            {
                                                
                            }
                    }
    			$k->delete();
    		}
    		Postmeta::where("post_id",$id)->delete();
    	}
    	Session::flash('message',"Post Delete Successfully"); 
        Session::flash('alert-class', 'alert-success');
        return redirect("post");
    }
}
