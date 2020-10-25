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
                                    <h3><strong>Post</strong></h3>
                                </div>
                            </div>
                            <div class="row">
                                    @if(Session::has('message'))
                                         <div class="col-sm-12">
                                            <div class="alert  {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">{{ Session::get('message') }}
                                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                               </button>
                                            </div>
                                         </div>
                                     @endif
                                  <a href="{{url('savepost/0')}}" class="btn btn-primary" style="margin-bottom: 15px">Add Post</a>
                            </div>
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th width="50">No</th>
                                        <th>Name</th>
                                        <th>UserName</th>
                                        <th>Birthdate</th>
                                        <th width="100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>