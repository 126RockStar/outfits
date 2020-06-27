@extends('admin.master')

@section('title')
  Edit Settings
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active">{{__('Settings')}}</li>
@endsection

@section('extra-css')
@endsection

@section('contents')
<!-- Start Content-->
<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.settings.update')}}" enctype="multipart/form-data" method="POST">
                      @csrf
                        <div class="row">
                            <div class="col-md-5">
                              <div class="form-group">
                                  <label>Application Name<span class="text-danger">*</span></label>
                                  <input type="text"  class="{{ $errors->has('app_name') ? ' is-invalid' : '' }} form-control" value="{{$settings->app_name}}" name="app_name" placeholder="Your application name" required>
                                  @if ($errors->has('app_name'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('app_name') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="form-group">
                                  <label>Application Logo</label>
                                  <input type="file"  class="{{ $errors->has('app_logo') ? ' is-invalid' : '' }} form-control-file" name="app_logo">
                                  @if ($errors->has('app_logo'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('app_logo') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>
                            <div class="col-md-2"><img src="{{asset('public/storage/'.getSettings('app_logo'))}}" alt="app logo"></div>


                            <div class="col-md-3">
                              <div class="form-group">
                                  <label>Currency<span class="text-danger">*</span></label>
                                  <select  class="{{ $errors->has('currency') ? ' is-invalid' : '' }} form-control" name="currency" title="currency" required>
                                      <option value="USD" {{$settings->currency == 'USD' ? 'selected': ''}}>USD( $ )</option>
                                      <option value="INR" {{$settings->currency == 'INR' ? 'selected': ''}}>INR( ₹ )</option>
                                  </select>
                                  @if ($errors->has('currency'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('currency') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>

                        </div> <!-- end row -->
                          @forelse(json_decode($settings->app_links) as $link=>$icon)
                          <div id="link-options">
                            <div class="row bg-light mt-1" id="link-option-field">
                              <div class="col-sm-8">
                                <div class="form-group">
                                    <label>{{__('Links')}} <span class="text-danger">*</span></label>
                                    <input class="form-control {{ $errors->has('links') ? ' is-invalid' : '' }}" value="{{$link}}" type="link" name="links[]" placeholder="https://www." required/>
                                    @if ($errors->has('links'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('links') }}</strong>
                                        </span>
                                    @endif
                                </div>
                              </div>
                              <div class="col-sm-3 col-10">
                                <div class="form-group">
                                    <label>{{__('Link type')}} <span class="text-danger">*</span></label>
                                    <select  class="{{ $errors->has('link_icon') ? ' is-invalid' : '' }} form-control" name="link_icon[]" required>
                                        <option value="facebook-square@2x.png" {{$icon == 'facebook-square@2x.png' ? 'selected': ''}}>Facebook</option>
                                        <option value="twitter-square@2x.png" {{$icon == 'twitter-square@2x.png' ? 'selected': ''}}>Twitter</option>
                                        <option value="youtube-square@2x.png" {{$icon == 'youtube-square@2x.png' ? 'selected': ''}}>Youtube</option>
                                        <option value="link-square@2x.png" {{$icon == 'link-square@2x.png' ? 'selected': ''}}>Others</option>
                                    </select>
                                </div>
                              </div>
                              <div class="col-sm-1 col-2 link-option"><span class="btn btn-danger btn-fluid mt-2" style="font-size:20px">X</span></div>
                            </div>
                          </div> <!-- end row -->
                          @empty
                            <div id="link-options">
                              <div class="row bg-light mt-1" id="link-option-field">
                                <div class="col-sm-8">
                                  <div class="form-group">
                                      <label>{{__('Links')}} <span class="text-danger">*</span></label>
                                      <input class="form-control {{ $errors->has('links') ? ' is-invalid' : '' }}" type="link" name="links[]" placeholder="https://www." required/>
                                      @if ($errors->has('links'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('links') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                                </div>
                                <div class="col-sm-3 col-10">
                                  <div class="form-group">
                                      <label>{{__('Link type')}} <span class="text-danger">*</span></label>
                                      <select  class="{{ $errors->has('link_icon') ? ' is-invalid' : '' }} form-control" name="link_icon[]" required>
                                          <option value="facebook-square@2x.png" {{$settings->currency == 'facebook-square@2x.png' ? 'selected': ''}}>Facebook</option>
                                          <option value="twitter-square@2x.png" {{$settings->currency == 'twitter-square@2x.png' ? 'selected': ''}}>Twitter</option>
                                          <option value="youtube-square@2x.png" {{$settings->currency == 'youtube-square@2x.png' ? 'selected': ''}}>Youtube</option>
                                          <option value="link-square@2x.png" {{$settings->currency == 'link-square@2x.png' ? 'selected': ''}}>Others</option>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-sm-1 col-2 link-option"><span class="btn btn-danger btn-fluid mt-2" style="font-size:20px">X</span></div>
                              </div>
                            </div> <!-- end row -->
                            @endforelse
                            <button type="button" onclick="duplicateOption()" class="btn btn-info mt-1"><i class="mdi mdi-plus"></i> New Link</button>


                            <!-- <select name="timezone_offset" id="timezone-offset" class="form-control">
                            	<option value="-12:00">(GMT -12:00) Eniwetok, Kwajalein</option>
                            	<option value="-11:00">(GMT -11:00) Midway Island, Samoa</option>
                            	<option value="-10:00">(GMT -10:00) Hawaii</option>
                            	<option value="-09:50">(GMT -9:30) Taiohae</option>
                            	<option value="-09:00">(GMT -9:00) Alaska</option>
                            	<option value="-08:00">(GMT -8:00) Pacific Time (US &amp; Canada)</option>
                            	<option value="-07:00">(GMT -7:00) Mountain Time (US &amp; Canada)</option>
                            	<option value="-06:00">(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
                            	<option value="-05:00">(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
                            	<option value="-04:50">(GMT -4:30) Caracas</option>
                            	<option value="-04:00">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
                            	<option value="-03:50">(GMT -3:30) Newfoundland</option>
                            	<option value="-03:00">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
                            	<option value="-02:00">(GMT -2:00) Mid-Atlantic</option>
                            	<option value="-01:00">(GMT -1:00) Azores, Cape Verde Islands</option>
                            	<option value="+00:00" selected="selected">(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
                            	<option value="+01:00">(GMT +1:00) Brussels, Copenhagen, Madrid, Paris</option>
                            	<option value="+02:00">(GMT +2:00) Kaliningrad, South Africa</option>
                            	<option value="+03:00">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
                            	<option value="+03:50">(GMT +3:30) Tehran</option>
                            	<option value="+04:00">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
                            	<option value="+04:50">(GMT +4:30) Kabul</option>
                            	<option value="+05:00">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
                            	<option value="+05:50">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
                            	<option value="+05:75">(GMT +5:45) Kathmandu, Pokhara</option>
                            	<option value="+06:00">(GMT +6:00) Almaty, Dhaka, Colombo</option>
                            	<option value="+06:50">(GMT +6:30) Yangon, Mandalay</option>
                            	<option value="+07:00">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
                            	<option value="+08:00">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
                            	<option value="+08:75">(GMT +8:45) Eucla</option>
                            	<option value="+09:00">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
                            	<option value="+09:50">(GMT +9:30) Adelaide, Darwin</option>
                            	<option value="+10:00">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
                            	<option value="+10:50">(GMT +10:30) Lord Howe Island</option>
                            	<option value="+11:00">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
                            	<option value="+11:50">(GMT +11:30) Norfolk Island</option>
                            	<option value="+12:00">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
                            	<option value="+12:75">(GMT +12:45) Chatham Islands</option>
                            	<option value="+13:00">(GMT +13:00) Apia, Nukualofa</option>
                            	<option value="+14:00">(GMT +14:00) Line Islands, Tokelau</option>
                            </select> -->

                    <br><br><input type="submit" class="btn btn-success btn-rounded btn-lg m-3" value="Update Settings">
                  </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row-->

</div> <!-- container -->


@endsection
@section('extra-scripts')
<script>
    function duplicateOption(){
      var field=$("#link-option-field").clone(true);
      field.find("input[type='link']").val(" ");
      field.appendTo("#link-options").val('');
    }

    $('.link-option').click(function(e){
      $(this).parent('.row').remove();
      e.preventDefault();
    });
</script>
@endsection
