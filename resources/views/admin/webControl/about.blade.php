@extends('include.admindashboard')


@section('body')
<div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr"><div class="card-head"><h4 class="card-title">Update Frequently Asked Questions</h4>
<br>

                     <form class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-body">

                            <div class="form-group ">
                                <label class="input-item-label text-exlight"> Title</label>
                                <div class="input-group">
                                    <input type="text" class="input-bordered"
                                           value="{{$basic->about_title}}"
                                           name="about_title">

                                </div>

                            </div>


                            <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                               <label class="input-item-label text-exlight">About Page</label>

                                <textarea id="area1" class="input-bordered" rows="10"
                                          name="about">{{ $basic->about }}</textarea>


                            </div>
                            <br>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="input-item-label text-exlight">About Us Image</label>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"
                                             data-trigger="fileinput">
                                            <img style="width: 200px"
                                                 src="{{asset('assets/images/about-video-image.jpg')}}" alt="...">
                                        </div>
                                        <div class="input-item input-with-label"><label class="input-item-label text-exlight">Upload New Image</label><div class="relative"><em class="input-file-icon fas fa-upload"></em><input type="file" class="input-file" id="file-01" name="image" accept="image/*"><label for="file-01">Choose a file</label></div></div>
                                    </div>
                                    @if ($errors->has('image'))
                                        <div class="error">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary  btn-lg"><i
                                            class="fa fa-send"></i> Update About
                                    </button>
                                </div>
                            </div>


                        </div>
                    </form>
   </div>   </div>   </div>   </div>

@stop
