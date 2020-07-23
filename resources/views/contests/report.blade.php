@extends('layouts.app')
@section('title') 
  Report Contest entry
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3><b>Entry by:</b> {{$entry->getParticipant->username}} <a href="{{route('contest.show',$entry->contest_id)}}" class="btn btn-info float-right">Back to contest</a></h3>
            @if($entry->getContest->file_type=='image')
                <img src="{{asset('public/storage/'.$entry->file)}}" class="img img-thumbnail" style="width:100%">
            @else
                <video src="{{asset('public/storage/'.$entry->file)}}" class="img-thumbnail" width="100%"></video>
            @endif
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.contest.entry.report') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="contest_id" value="{{$entry->contest_id}}">
                        <input type="hidden" name="entry_id" value="{{$entry->id}}">
        
                        <div class="form-group row">
                            <label for="reason" class="col-md-4 col-form-label text-md-right text-white">Reason <span class="text-danger">*</span></label>
        
                            <div class="col-md-6">
                                <textarea id="reason" class="form-control @error('reason') is-invalid @enderror" name="reason" value="{{ old('reason') }}" required autocomplete="reason" autofocus>
                                </textarea>
                                @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="attachment" class="col-md-4 col-form-label text-md-right text-white">Attachment</label>
                            <div class="col-md-6">
                                <input id="attachment" type="file" class="form-control @error('attachment') is-invalid @enderror" name="attachment" value="{{ old('attachment') }}" autocomplete="attachment">
                                @error('attachment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
        
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Report
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
 
</div>
@endsection
