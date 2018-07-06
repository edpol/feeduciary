                <h3> </h3><br />

                <!-- logged in and admin or owner -->
                @if (auth()->check() && ($advisor->owner() || auth()->user()->isAdmin()))
                <!-- 
                    Can't format input type file, so hide it and add a button   
                    you can format and use javascript to execute the hidden 
                    div when the visible formated button is clicked
                -->
                   <form id="trackingFile" action="{{ url('upload') }}/{{ $advisor->id}}" method="post" enctype="multipart/form-data"> 
                        {{ csrf_field() }}
                        <div style="height:0px; overflow:hidden">
                            <input type="file" name="fileUpload" id="fileUpload"/>
                        </div>
                        <button class="importButton" type="button" onclick="chooseFile();">
                            Click to<br />Select Image <br />
                            <img src="{{url($advisor->photo())}}@isset($success)?time()@endisset" width="{{DEFAULT_SIZE}}" />
                        </button>
                        <br /><br />
                        <div align="center"><input type="submit" class='alert alert-info' name="submit" value="Upload File" /></div>
                    </form>
                @else
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
