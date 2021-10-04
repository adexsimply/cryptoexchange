@extends('include.admindashboard')


@section('body')
<div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr"><div class="card-head"><h4 class="card-title">Update Terms, Condition Privacy & Policiess</h4>
<br>

                     <form class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-body">




                            <div class="form-group ">
                               <label class="input-item-label text-exlight">Terms $ Conditions</label>

                                <textarea id="area1" class="input-bordered" rows="3"
                                          name="terms">{{ $basic->terms }}</textarea>


                            </div>
                            <br>
 <div class="form-group ">
                               <label class="input-item-label text-exlight">Privacy</label>

                                <textarea id="area1" class="input-bordered" rows="3"
                                          name="privacy">{{ $basic->privacy }}</textarea>


                            </div>
                            <br>
 <div class="form-group ">
                               <label class="input-item-label text-exlight">Policies</label>

                                <textarea id="area1" class="input-bordered" rows="3"
                                          name="policy">{{ $basic->policy }}</textarea>


                            </div>
                            <br>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="input-item-label text-exlight">Image 1</label>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"
                                             data-trigger="fileinput">
                                            <img style="width: 200px"
                                                 src="{{asset('assets/images/privacy.jpg')}}" alt="...">
                                        </div>
                                        <div class="input-item input-with-label"><label class="input-item-label text-exlight">Upload New Image</label><div class="relative"><em class="input-file-icon fas fa-upload"></em><input type="file" class="input-file" id="file-02" name="image1" accept="image/*"><label for="file-02">Choose a file</label></div></div>
                                    </div>
                                    @if ($errors->has('image'))
                                        <div class="error">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                            </div>


 <div class="form-group">
                                <div class="col-md-12">
                                    <label class="input-item-label text-exlight">Image 2</label>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"
                                             data-trigger="fileinput">
                                            <img style="width: 200px"
                                                 src="{{asset('assets/images/policy.jpg')}}" alt="...">
                                        </div>
                                        <div class="input-item input-with-label"><label class="input-item-label text-exlight">Upload New Image</label><div class="relative"><em class="input-file-icon fas fa-upload"></em><input type="file" class="input-file" id="file-01" name="image2" accept="image/*"><label for="file-01">Choose a file</label></div></div>
                                    </div>
                                    @if ($errors->has('image'))
                                        <div class="error">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary  btn-lg"><i
                                            class="fa fa-send"></i> Update Page
                                    </button>
                                </div>
                            </div>


                        </div>
                    </form>
   </div>   </div>   </div>   </div>

@stop
