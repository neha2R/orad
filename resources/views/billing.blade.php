<!DOCTYPE html>
<html lang="en">

<head>
    <title>Certificate</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    {{-- <link rel="stylesheet" href="{{ URL::asset('certificate/CSS/style.css') }}"> --}}

    {{-- <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat"
        rel="stylesheet">
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

    <!--font-family: 'Montserrat', sans-serif;-->

    <style>
        body {
            font-family: 'Montserrat';
            /* font-size: 22px; */
            margin:20px;
        }
        

    </style>
</head>

<body id="ddd">

    <div class="row" >
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12" style="color: red">
                        <img src="/oradlogo.png" height="100px" width="200px">
                   </div>
                   <div class="col-md-12">
                        <div class="row">
                            <div class="" style="margin-top: 30px;float:left;">
                                <b style="font-size: 24px;">Payment Receipt</b><br>
                               <span style="font-size: 13px"> Date:{{dateformater($data->created_at)}}</span><br>
                                <span style="font-size: 13px"> Time:{{timeformater($data->created_at)}}</span><br>
                            </div>
                            <div class="" style="text-align: end;margin-top: 30px;float:right;">
                                <h4>
                                <span style="font-size: 13px">ORAD Consultancy Pvt.Ltd.</span><br>
                                <span style="font-size: 13px">1, Sahar Place ,Ajmer Road,</span><br>
                                <span style="font-size: 13px">Barwada Colony, Civil Lines,</span><br>
                                <span style="font-size: 13px">Jaipur 302006</span><br>
                                <span style="font-size: 13px">CIN : U74140RJ2020PTC070031</span><br>
                                <span style="font-size: 13px">PAN : AADCO2136R</span><br>
                                </h4>
                            </div>
                        </div>
    
                   </div>
                   <hr>
                   <div class="col-md-12">
                    <div class="row">
                        <div class="" style="float:left;">
                            <h3 style="margin-top: 35px;font-size:20px;font-weight:bold">Client Information</h3>
                            <span style="font-size: 13px">Name: {{$data->user->name ?? ''}}</span><br>
                            <span style="font-size: 13px">Email: {{$data->email ?? ''}}</span><br>
                                <span style="font-size: 13px">Mobile No: {{$data->mobile ?? ''}}</span><br>
                        </div>
                        <div class="" style="text-align: end;float:right;">
                            <h3 style="margin-top: 35px;font-size:20px;font-weight:bold">Payment Details</h3>
                            <span style="font-size: 13px">Payment Mode: Cash</span> <br>
                            <span style="font-size: 13px">Receipt No.:00000{{$data->id ?? ''}}</span> <br>
                            <span style="font-size: 13px">Transaction No.: {{$data->order_id ?? ''}}</span><br>
                        </div>
                    </div>
                   </div>
                   <hr>
                   <div class="col-md-12">
                    <table class="table table-borderless table-responsive">
                        <thead>
                          <tr>
                            <th scope="col" style="font-size: 16px;font-weight: bold;">ID</th>
                            <th scope="col" style="font-size: 16px;font-weight: bold;">Course Name</th>
                            <th scope="col" style="font-size: 16px;font-weight: bold;">Course Type</th>
                            <th scope="col" style="font-size: 16px;font-weight: bold;">Duration</th>
                            <th scope="col" style="font-size: 16px;font-weight: bold;">Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th style="font-size: 14px" scope="row">1</th>
                            <td style="font-size: 14px">{{$data->course->Course->name ?? ''}}</td>
                            <td style="font-size: 14px">{{$data->course->name ?? ''}}</td>
                            <td style="font-size: 14px">{{$data->course->days ?? ''}} days</td>
                            <td style="font-size: 14px">{{$data->price ?? ''}}</td>
                          </tr>
                        </tbody>
                      </table>
                   </div>
                  <hr>
                  <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                        <table class="table table-borderless table-responsive">
                            <thead>
                              <tr>
                                <th scope="col" style="font-size: 16px;font-weight: bold;">Sub Total</th>
                                @if($data->price != $data->discounted_price )
                                <th scope="col" style="font-size: 16px;font-weight: bold;">Discount Price</th>
                                @endif
                                <th scope="col" style="font-size: 16px;font-weight: bold;">Total</th>
                               
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th style="font-size: 14px" scope="row"><span style="font-size: 16px;font-weight: bold;">Sub Total:<span><br>
                                    Rs.{{$data->price ?? ''}}</th>
                                    @if($data->price != $data->discounted_price )
                                <td style="font-size: 14px"> 
                                   
                                    <div class="col-md-2">
                                       <span style="font-size: 16px;font-weight: bold;">Discount Price:<span><br>
                                       {{$data->discounted_price ?? ''}}
                                   </div>
                                  
                                </td>
                                @endif
                                <td style="font-size: 14px"> <span style="font-size: 16px;font-weight: bold;">Total:<span><br>
                                    Rs.{{$data->discounted_price ?? ''}}</td>
                                
                              </tr>
                            </tbody>
                          </table>
                      </div>
                      <div class="col-md-2"></div>
                   
                  </div>
                  <div class="col-md-12" style="    margin-top: 60px;
                  text-align: center;" >
                    <span>
                        If you have any questions or concerns regarding your account,please don’t hesitate to contact us.
                    </span>
                  </div>
                  {{-- <div class="col-md-12" style="text-align: center">
                    <button onclick="download()" class="btn btn-primary">Print/Download</button>
                  </div> --}}
                </div>
            </div>
        </div>
        <div class="col-md-1">
        </div>
        
       
    </div>


    <script>


        var element = document.getElementById('ddd');
        var opt = {
            // margin: 1,
            filename: 'orad-bill',
        };
        html2pdf(element, opt);

       

    </script>
</body>

</html>
