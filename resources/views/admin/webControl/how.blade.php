@extends('include.admindashboard')


@section('body')
<div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr"><div class="card-head"><h4 class="card-title">Update How It Works</h4>
<br>

                     <form class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-body">




                            <div class="form-group ">
                               <label class="input-item-label text-exlight">Step 1</label>

                                <textarea id="area1" class="input-bordered" rows="3"
                                          name="step1">{{ $basic->step1 }}</textarea>


                            </div>
                            <br>
 <div class="form-group ">
                              <label class="input-item-label text-exlight">Step 2</label>

                                <textarea id="area1" class="input-bordered" rows="3"
                                          name="step2">{{ $basic->step2 }}</textarea>


                            </div>
                            <br>
 <div class="form-group ">
                               <label class="input-item-label text-exlight">Step 3</label>

                                <textarea id="area1" class="input-bordered" rows="3"
                                          name="step3">{{ $basic->step3 }}</textarea>


                            </div>
                            <br>

                             <label class="input-item-label text-exlight">Step 4</label>

                                <textarea id="area1" class="input-bordered" rows="3"
                                          name="step4">{{ $basic->step4 }}</textarea>


                            </div>
                            <br>

                             <label class="input-item-label text-exlight">Step 5</label>

                                <textarea id="area1" class="input-bordered" rows="3"
                                          name="step5">{{ $basic->step5 }}</textarea>


                            </div>
                            <br>


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
