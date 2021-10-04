@extends('include.admindashboard')
@section('body')
<!-- .topbar-wrap --><div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr"><div class="card-head"><h4 class="card-title">Update Frequently Asked Questions</h4>
<br>

                    {!! Form::model($faqs,['route'=>['faqs-update',$faqs->id],'method'=>'put','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="input-item-label text-exlight"><strong style="text-transform: uppercase;">Question Title</strong></label>
                                    <div class="cols-md-12">
                                        <input name="title" class="input-bordered" value="{{ $faqs->title }}" placeholder="Question Title" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="input-item-label text-exlight"><strong style="text-transform: uppercase;">Question Answer</strong></label>
                                    <div class="cols-md-12">
                                        <textarea name="description" id="area1" rows="10" class="input-bordered" required placeholder="Question Answer">{{ $faqs->description }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" onclick="nicEditors.findEditor('area1').saveContent();" class="btn btn-primary   bold btn-sm uppercase"><i class="fa fa-send"></i> Update FAQS</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div>
                    {!! Form::close() !!}
   </div>   </div>   </div>   </div>
@stop

