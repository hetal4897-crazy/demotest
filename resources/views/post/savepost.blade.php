<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('POST') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    @if($id==0)
                                        <h3><strong>Add Post</strong></h3>
                                    @else
                                        <h3><strong>Edit Post</strong></h3>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                 @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <form action="{{url('updatepost')}}" method="post" enctype="multipart/form-data" id="formpost" data-parsley-validate>
                                <input type="hidden" name="id" value="{{$id}}">
                                {{csrf_field()}}
                                <div class="row">
                                     <div class="col-md-4">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp"  name="name" placeholder="Enter name" value="{{isset($data->name)?$data->name:''}}" required="">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="user_name">User Name</label>
                                        <input type="text" class="form-control" id="user_name" aria-describedby="emailHelp" name="user_name" placeholder="Enter Username" value="{{isset($data->user_name)?$data->user_name:''}}" required="">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="birthdate">Birth Date</label>
                                        <input type="date" class="form-control" id="birthdate" aria-describedby="emailHelp" required="" value="{{isset($data->birthdate)?$data->birthdate:''}}" name="birthdate">
                                    </div>
                                </div>                                
                                <div class="row">
                                    <div class="col-md-8"> 
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="" placeholder="mail@example.com" required name="email[]" value="{{isset($email[0])?$email[0]:''}}">
                                    </div>
                                    <div class="col-md-4 mdtop"> 
                                        <button id="addEmail" type="button" class="btn btn-primary">Add more</button> 
                                       
                                    </div>
                                    <div id="more-email" class="col-md-12">
                                            <?php $i=0;?>
                                            @if(count($email))
                                              @foreach($email as $e)
                                                 @if($i!=0)
                                                    <?php $temp=time();?>
                                                    <div class='row' id="{{$temp}}">
                                                        <div class='col-md-8'>
                                                            
                                                                <label for='exampleInputEmail1'>Alternate email address</label>
                                                                <input type='email' class='form-control' id='' placeholder='alt.mail@example.com' required name='email[]' value="{{isset($e)?$e:''}}" />
                                                           
                                                        </div>
                                                        <div class="col-md-4 mdtop"> 
                                                        <button id='removeContact' type='button' class='btn btn-warning'  onclick='removerow("{{$temp}}")' >
                                                          <i class='fa fa-trash f-s-25' style='font-size: x-large;'></i>
                                                        </button>
                                                      </div>
                                                    </div>
                                                 @endif
                                                  <?php $i++; ?>
                                              @endforeach
                                            @endif
                                      </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="exampleInputContact">Contact</label>
                                            <input type="text" class="form-control" id="" placeholder="+91-99999-88888" name="phone[]" required value="{{isset($phone[0])?$phone[0]:''}}">
                                        </div>
                                         <div class="col-md-4 mdtop"> 
                                             <button id="addContact" type="button" class="btn btn-primary">Add more</button> 
                                           
                                        </div>
                                        <div id="more-contact" class="col-md-12">
                                             <?php $i=0;?>
                                            @if(count($phone))
                                              @foreach($phone as $e)
                                                 @if($i!=0)
                                                 <?php $temp=time();?>
                                                    <div class='row' id="{{$temp}}">
                                                        <div class='col-md-8'>
                                                            
                                                               <label for='exampleInputContact'>Alternate contact</label><input type='text' class='form-control' id='' placeholder='+91-88888-88888' required name='phone[]' value="{{isset($e)?$e:''}}"/>
                                                           </div>
                                                             <div class="col-md-4 mdtop"> 
                                                        <button id='removeContact' type='button' class='btn btn-warning'  onclick='removerow("{{$temp}}")' >
                                                          <i class='fa fa-trash f-s-25' style='font-size: x-large;'></i>
                                                        </button>
                                                      </div>
                                                        </div>
                                                    
                                                 @endif
                                                  <?php $i++; ?>
                                              @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>                                
                                <div class="row col-md-12 mdtop">
                                    <div class="col-md-12">
                                       <?php $i=0;?>
                                         @if(count($image))
                                              @foreach($image as $e)
                                                <span class="pip" id="{{$i}}">
                                                    <img class="imageThumb" src="{{asset('upload/post').'/'.$e}}" title="{{$e}}">
                                                    <br/><button type="button" class="remove" onclick="removeimg('{{$i}}') ">Remove image</button>
                                                     <input type="hidden" name="real_image[]" value="{{$e}}">
                                                </span>
                                                <?php $i++;?>
                                            @endforeach
                                        @endif                                        
                                        <input type="file" <?= isset($id)&&$id==0?'required':""?> id="files" name="image[]" multiple />
                                    </div>
                                </div>
                                 <div class="row col-md-12" style="margin-top: 25px">
                                    <div class="col-md-12">
                                      <button type="submit" class="btn btn-primary" style="margin-top: 15px;margin-bottom: 15px">Submit</button>
                                  </div>
                                  </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>