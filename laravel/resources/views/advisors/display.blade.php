
                <div class="row">
                    <div class="col-sm-8">
                        <table class='table mytable' style="padding:0; margin:0;" border=0>
                            <tr style="padding:0; margin:0;">
                                <th>name*:  </th><td> {{ $advisor->name    }} </td>
                            </tr>
                            <tr>
                                <th>phone:  </th><td> {{ $advisor->phone() }} </td>
                            </tr>
                            @if(isset($hideEmail) && $hideEmail==false)
<?php //                      if(isset($hideEmail) && $hideEmail==false) { ?>
                            <tr><th>email*: </th><td> {{ $advisor->email }} </td></tr>
<?php //                      } ?>
                            @endif
                            <tr><th>company: </th>
                                <td>
                                    @if(isset($advisor->url) && !empty($advisor->url))
                                        <a href="{{ $advisor->url }}" target="_blank">
                                    @endif
                                    {{ $advisor->company }} 
                                    @if(isset($advisor->url) && !empty($advisor->url))
                                        </a> 
                                    @endif
                                </td>
                            </tr>
                            <tr><th>address: </th><td> {{ $advisor->address1 }} </td></tr>
                            @if(isset($advisor->address2) && !empty($advisor->address2))
                                <tr><th>     </th><td> {{ $advisor->address2 }} </td></tr>
                            @endif
                            <tr><th>         </th>
                                <td> 
                                    {{ $advisor->city }},
                                    @if(isset($advisor->st) && !empty($advisor->st))
                                        {{ $advisor->st }}
                                    @endif
                                    {{ $advisor->zip }} 
                                </td>
                            </tr>
                            <tr><th>minimum amount: </th>
                                <td>
                                    @if(isset($advisor->minimum_amt) && !empty($advisor->minimum_amt))
                                        ${{ number_format($advisor->minimum_amt, 0) }} 
                                    @endif
                                </td>
                            </tr>
<!--                        <tr><th>maximum amount: </th>
                                <td>
                                    @if(isset($advisor->maximum_amt) && !empty($advisor->maximum_amt))
                                        ${{ number_format($advisor->maximum_amt, 0) }} 
                                    @endif
                                </td>
                            </tr>
-->                         <tr><th>minimum fee: </th>
                                <td>
                                    @if(isset($advisor->minimum_fee) && !empty($advisor->minimum_fee))
                                        ${{ number_format($advisor->minimum_fee, 0) }} 
                                    @endif
                                </td>
                            </tr>
                            <tr><th>fee calculation*: </th>
                                <td>
                                    @if ($advisor->feeCalculation==0) Cumulative rates per tier @endif
                                    @if ($advisor->feeCalculation==1) Rate changes with investment amount @endif
                                    @if ($advisor->feeCalculation==2) Rate is fixed amount @endif
                                </td>
                            </tr>
                            <tr><th>Facebook: </th>
                                <td>
                                    @if(isset($advisor->facebook) && !empty($advisor->facebook))
                                        <a href="{{ $advisor->facebook }}" target="_blank">
                                            {{ $advisor->facebook }} 
                                        </a> 
                                    @endif
                                </td>
                            </tr>
                            <tr><th>Finra Brokercheck: </th>
                                <td>
                                    @if(isset($advisor->finraBrokercheck) && !empty($advisor->finraBrokercheck))
                                        <a href="{{ $advisor->finraBrokercheck }}" target="_blank">
                                            {{ $advisor->finraBrokercheck }} 
                                        </a> 
                                    @endif
                                </td>
                            </tr>
                            <tr><th>Linkedin: </th>
                                <td>
                                    @if(isset($advisor->linkedin) && !empty($advisor->linkedin))
                                        <a href="{{ $advisor->linkedin }}" target="_blank">
                                            {{ $advisor->linkedin }} 
                                        </a> 
                                    @endif
                                </td>
                            </tr>
                            <tr><th>Twitter: </th>
                                <td>
                                    @if(isset($advisor->twitter) && !empty($advisor->twitter))
                                        <a href="{{ $advisor->twitter }}" target="_blank">
                                            {{ $advisor->twitter }} 
                                        </a> 
                                    @endif
                                </td>
                            </tr>
                            <tr><th>Discretionary AUM: </th>
                                <td>
                                    @if(isset($advisor->discretionaryAUM) && !empty($advisor->discretionaryAUM))
                                        ${{ number_format($advisor->discretionaryAUM, 0) }} 
                                    @endif
                                </td>
                            </tr>

                            @if (auth()->check() && auth()->user()->isAdmin())
                                <tr><th>lat/lng: </th><td> {{ $advisor->lat }}   {{ $advisor->lng }} </td></tr>
                            @endif

                            @if(isset($advisor->brochure) && !empty($advisor->brochure))
                                <tr><th> </th>
                                    <td>
                                        <a href="{{ $advisor->brochure }}" target="_blank">
                                            Part 2 Brochure 
                                        </a> 
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>

                    <div class="col-sm-4 text-center">
                        <br />
                        <!-- logged in and admin or owner -->
                        @if (auth()->check() && ($advisor->owner() || auth()->user()->isAdmin()))
                        <!-- 
                            Can't format input type file, so hide it and add a button   
                            you can format and use javascript to execute the hidden 
                            div when the visible formated button is clicked
                        -->
                           <form id="trackingFile" action="{{ url('upload') }}/{{ $advisor->id}}" method="post" enctype="multipart/form-data"> 
                                {{ csrf_field() }}
                                <div style="height:0px;overflow:hidden">
                                    <input type="file"  name="fileUpload" id="fileUpload"/>
                                </div>
                                <button class="importButton" type="button" onclick="chooseFile();">
                                    Click to<br />Select Image <br />
                                    <img src="{{url($advisor->photo())}}@isset($success)?time()@endisset" width="{{DEFAULT_SIZE}}" />
                                </button>
                                <br /><br />
                                <input type="submit" class='alert alert-info' name="submit" value="Upload File" /><br />
                            </form>
                        @else
                            Photo<br />
                            <img src="{!! $advisor->photo() !!}" alt="" width="{{DEFAULT_SIZE}}"><br />
                        @endif
                        <br />
                        <!-- hide send mail button if you are displaying the email -->
                        @if(isset($hideEmail) && $hideEmail==true && !empty($advisor->email)) 
                            <form action="/contact/{{ $advisor->id }}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">e-mail</button>
                            </form>
                        @endif
                        <!-- hello $success -->
                        @isset($success)
                            <p style="margin-top:20px;" class="alert alert-success">{{ $success }}</p>
                        @endisset
                    </div>
                </div>

                <br clear="all" />
                <div class="row">
                    <div class="col-sm-1">
                        Bio:
                    </div>
                    <div class="col-sm-11">
                        {{ $advisor->bio }}
                    </div>
                    <br />
                </div>
                <hr clear="all" />

                @if (!auth()->check() && $advisor->user_id==0)
                <div class="row">
                    <form id="claim" action="{{ url('claim') }}/{{ $advisor->id}}" method="get"> 
                        {{ csrf_field() }}
                        <button class="btn btn-info" type="submit">Claim this account</button>
                    </form>
                </div>
                <br />
                @endif
