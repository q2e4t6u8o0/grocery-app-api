@section('style')
    <link rel="stylesheet" href="{{ asset('vendors/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/media-uploader.css') }}">
@endsection
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    {{ inline_brd(['Dashboard', 'configuration', 'Email Setting']) }}
                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <button type="button" class="btn btn-light bg-white btn-icon mr-3 d-none d-md-block ">
                            <i class="mdi mdi-download text-muted"></i>
                        </button>
                        <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                            <i class="mdi mdi-clock-outline text-muted"></i>
                        </button>
                        <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                            <i class="mdi mdi-plus text-muted"></i>
                        </button>
                        <button class="btn btn-primary mt-2 mt-xl-0">Download report</button>
                    </div>
                </div>
            </div>
        </div>
        <form method="post" action="{{ route('global.setting.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">SMS Configuration</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Storage List</h4>
                                    <div class="form-group">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="storage_driver1"
                                                    value="Cloudinar" id="ExampleRadio1" checked>
                                                SMTP
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>Default SMS</h4>
                                    <div class="form-group">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label pointer">
                                                <input type="radio" class="form-check-input smtp_email default_email" name="default_email"
                                                    value="smtp" @if(setting('default_email')=="smtp") checked @endif>
                                                SMTP
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Send Test email</label>
                                        <input type="email" class="form-control SEND_TEST_EMAIL text-dark" placeholder="send test email"
                                            name="SEND_TEST_EMAIL" aria-label="SEND_TEST_EMAIL" value="{{ env('SEND_TEST_EMAIL') }}">
                                    </div>
                                    <div class="template-demo float-right">
                                        <button type="button" class="btn btn-outline-primary btn-icon-text sendSmtpEmail">
                                            <i class="mdi mdi-mail btn-icon-prepend"></i>
                                            Send Test email
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">SMTP Configuration </h4>
                            <div class="form-group">
                                <label>MAIL HOST</label>
                                <input type="text" class="form-control MAIL_HOST form-control-sm" placeholder="MAIL HOST"
                                    name="MAIL_HOST" aria-label="MAIL_HOST" value="@if(env('DEMO'))****************************************************************@else{{ env('MAIL_HOST') }}@endif">
                            </div>
                            <div class="form-group">
                                <label>MAIL PORT</label>
                                <input type="text" class="form-control MAIL_PORT form-control-sm" placeholder="MAIL PORT"
                                    name="MAIL_PORT" aria-label="MAIL_PORT" value="@if(env('DEMO'))****************************************************************@else{{ env('MAIL_PORT') }}@endif">
                            </div>
                            <div class="form-group">
                                <label>MAIL USERNAME</label>
                                <input type="text" class="form-control MAIL_USERNAME form-control-sm" placeholder="MAIL USERNAME"
                                    name="MAIL_USERNAME" aria-label="MAIL_USERNAME" value="@if(env('DEMO'))****************************************************************@else{{ env('MAIL_USERNAME') }}@endif">
                            </div>
                            <div class="form-group">
                                <label>MAIL PASSWORD</label>
                                <input type="text" class="form-control MAIL_PASSWORD form-control-sm" placeholder="MAIL PASSWORD"
                                    name="MAIL_PASSWORD" aria-label="MAIL_PASSWORD" value="@if(env('DEMO'))****************************************************************@else{{ env('MAIL_PASSWORD') }}@endif">
                            </div>
                            <div class="form-group">
                                <label>MAIL ENCRYPTION</label>
                                <input type="text" class="form-control MAIL_ENCRYPTION form-control-sm" placeholder="MAIL ENCRYPTION"
                                    name="MAIL_ENCRYPTION" aria-label="MAIL_ENCRYPTION" value="@if(env('DEMO'))****************************************************************@else{{ env('MAIL_ENCRYPTION') }}@endif">
                            </div>
                            <div class="form-group">
                                <label>MAIL FROM ADDRESS</label>
                                <input type="text" class="form-control MAIL_FROM_ADDRESS form-control-sm" placeholder="MAIL FROM ADDRESS"
                                    name="MAIL_FROM_ADDRESS" aria-label="MAIL_FROM_ADDRESS" value="@if(env('DEMO'))****************************************************************@else{{ env('MAIL_FROM_ADDRESS') }}@endif">
                            </div>
                            <div class="template-demo float-right">
                                <button type="button" class="btn btn-outline-primary btn-icon-text saveSmtpEmail">
                                    <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                    Save EMAIL Configurations
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 grid-margin stretch-card"></div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="template-demo float-right">
                                <button type="submit" class="btn btn-outline-primary btn-icon-text load">
                                    <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
</div>


@section('script')
    <script src="{{ asset('vendors/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('vendors/media_controll/media.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();

            $(".sendSmtpEmail").click(function(){
                sendSmtpEmail();
            })
            $(".saveSmtpEmail").click(function(){
                saveSmtpEmail();
            })
            function sendSmtpEmail() {
                $(".loader").show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('send.test.smtpEmail') }}",
                    data: {SEND_TEST_EMAIL:$('.SEND_TEST_EMAIL').val(),_token: $(".token").val()},
                    success: function(data) {
                        $(".loader").hide();
                        if(data.error){
                            toast(data.message,"error");
                        }else{
                            toast(data.message,"success");
                        }

                    },
                    error: function (data) {
                        console.log(data.status + ':' + data.statusText,data.responseText);
                        $(".loader").hide();
                        toast(data.responseText,"error");
                    }
                });
            }
            function saveSmtpEmail() {
                $(".loader").show();
                var is_f2s_dlt = $('.is_f2s_dlt').is(":checked")
                var MAIL_HOST = $('.MAIL_HOST').val();
                var MAIL_PORT = $('.MAIL_PORT').val();
                var MAIL_USERNAME = $('.MAIL_USERNAME').val();
                var MAIL_PASSWORD = $('.MAIL_PASSWORD').val();
                var MAIL_ENCRYPTION = $('.MAIL_ENCRYPTION').val();
                var MAIL_FROM_ADDRESS = $('.MAIL_FROM_ADDRESS').val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('save.saveSmtpEmail-config') }}",
                    data: {MAIL_HOST:MAIL_HOST,MAIL_PORT:MAIL_PORT,MAIL_USERNAME:MAIL_USERNAME,MAIL_PASSWORD:MAIL_PASSWORD,MAIL_ENCRYPTION:MAIL_ENCRYPTION,MAIL_FROM_ADDRESS:MAIL_FROM_ADDRESS,_token: $(".token").val()},
                    success: function(data) {
                        $(".loader").hide();
                        toast("Update successfully ","success");
                        $(".smtp_email").prop('checked',true);
                    },
                    error: function (data) {
                        console.log(data.status + ':' + data.statusText,data.responseText);
                        $(".loader").hide();
                        toast(data.responseText,"error");
                    }
                });
            }
        });
    </script>
@endsection
