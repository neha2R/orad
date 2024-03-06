<!DOCTYPE html>
<html lang="en">

<head>
    <title>Certificate</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('certificate/CSS/style.css') }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;0,600;1,300&display=swap"
        rel="stylesheet">
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

    <!--font-family: 'Montserrat', sans-serif;-->


</head>

<body id="ddd">

    <div class="jumbotron text-center">

        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <img src="{{ URL::asset('certificate/Images/logo.png') }}" alt="Paris"
                        style="width:400px;margin-top: 6px;">
                </div>

                <div class="col-sm-12">
                    <h3
                        style="  color: #a07f38; text-transform: uppercase; text-align: center; font-size: 26px; font-family: 'Montserrat', sans-serif;  ">
                        We hereby recognize</h3>
                </div>


                <div class="col-sm-12">
                    <h3
                        style=" text-transform: uppercase; text-align: center; font-size: 26px; font-family: 'Montserrat', sans-serif;  ">
                        {{ Str::upper($user->name) ?? '' }}</h3>
                </div>


                <div class="col-sm-12">

                    <div class="col-sm-3"> </div>
                    <div style="  background-color:#000; " class="col-sm-6"> </div>
                    <div class="col-sm-3"> </div>

                </div>


                <div class="col-sm-12">

                    <div class="col-sm-2"> </div>
                    <div class="col-sm-8">

                        <h3 style="text-align: center;
      
    line-height: 36px;		  
    font-size: 23px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 400; ">Is among the top 20% students to successfully complete the <strong>ORAD Spoken English and
                                Personality Development</strong>
                            curriculum trial class.</h3>

                    </div>
                    <div class="col-sm-2"> </div>

                </div>


                <div class="col-sm-12">
                    <img src="{{ URL::asset('certificate/Images/sain_1.png') }}" alt="Paris"
                        style="margin-bottom: 2px; width: 148px;">
                </div>


                <div class="col-sm-12">

                    <div class="col-sm-5"> </div>
                    <div style="  background-color:#000; " class="col-sm-2"> </div>
                    <div class="col-sm-5"> </div>

                </div>


                <div class="col-sm-12">
                    <h3 style=" color: #a07f38;
                                text-transform: uppercase;
                                text-align: center;
                                font-size: 20px;
                              line-height: 28px;
                                font-family: 'Montserrat', sans-serif; ">

                        prashant saini
                        <br>
                        <span style="color: #000000; font-size:15px;">Founder &amp; CEO</span>
                    </h3>
                </div>




            </div>
        </div>

    </div>


    <script>
        var element = document.getElementById('ddd');
        var opt = {
            margin: 1,
            filename: 'orad-certificate',
        };
        html2pdf(element, opt);

        //  setTimeout(function(){window.close();}, 2000);

    </script>
</body>

</html>
