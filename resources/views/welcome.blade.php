
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>

            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                margin-top: 500px;
            }

            .title {
                font-size: 84px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .pd
            {
                padding-bottom: 60px;
                font-weight: bold;
            }
            #volunteerImage
            {
                width: 70px;
                height: 50px;
            }
            .logo
            {
                width: 100px;
            }
            .pd1
            {
                padding-top: 65px;
            }
            .table
            {
              margin-top: 50px;
            }

            .image 
            {
               position:relative;
               display:inline-block;
            }
            .overlay 
            {
                display:none;
                padding-top: 10px;
            }



        .image:hover .overlay {
               width:100%;
               height:100%;
               background:rgba(0,0,0,.5);
               position:absolute;
               top:0;
               left:0;
               color: white;
               font-size: large;
               cursor: pointer;
               display:inline-block;
               -webkit-box-sizing:border-box;
               -moz-box-sizing:border-box;
               box-sizing:border-box;

           /* All other styling - see example */
           img {
              vertical-align:top;
           }

        }
        </style>
    </head>
    <body>
    <div class="container h-100">
        <div class="row">
            <div class="col-9 pd d-flex pl-5 justify-content-center pt-5">
              <div class="pl-5"> Organizacija: {{ $sumOfUsers }} </div>
              <div class="pl-5"> Akcija: {{ $sumOfPosts }} </div>
              <div class="pl-5"> Sati: {{ $sumOfHours }} </div>
              <div class="pd1 pl-1"> <img id="volunteerImage" src="/storage/volunteers/volunteer.png"> = {{ $sumOfVolunteers }} </div>
            </div>
            <div class="col-3">
              <img class="logo" src="/storage/logo/republic_of_srpska.png">
            </div>
          </div>


                <div class="row">
                  <div class="col-12 d-flex justify-content-center pl-5">
                     <h1> I mi gradimo Srpsku! </h1>
                  </div>
                </div>

                
                <div class="row pt-3">
                  <div class="col-12 d-flex justify-content-center">
                    @if (Route::has('login'))
                    @auth
                       <div> <a href="/profile/{{Auth::user()->id}}" class="btn btn-danger btn-lg" role="button">MOJ PROFIL</a> </div>
                       <div class="pl-2"> <a href="/v/all" class="btn btn-primary btn-lg" role="button">VOLONTERI</a> </div>
                    @else
                        <div> <a class="btn btn-success btn-lg" href="{{ route('login') }}" role="button">Prijava</a> </div>
                     @if (Route::has('register'))
                       <div class="pl-2"> <a class="btn btn-info btn-lg" href="{{ route('register') }}" role="button">Registracija</a> </div>
                     @endif
                     @endauth
                     @endif
                  </div>
                </div>

                  @if (Route::has('login'))
                  @auth
                  @else
                  @if (Route::has('register')) 
                    <center> <small> Registracija i prijava samo za organizatore volontiranja! @endif </small> </center>
                  @endauth
                  @endif
                   
                <hr>

                <div class="d-flex align-items-center">
                    @foreach ($userModels as $model)
                    <a href="/profile/{{ $model['id'] }}">
                        <div class="image pl-2">  
                            <img src = "/storage/{{ $model['image'] ?? '/profile/noimage.jpg'}}" class="rounded-circle w-100" style="max-width: 50px;">
                           <center> <span class="overlay">{{ $model['title'] }}</span> </center>
                        </div>
                    </a>
                    @endforeach
                </div>

             
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Br.</th>
                  <th scope="col">Organizacija</th>
                  <th scope="col">Ime i prezime</th>
                  <th scope="col">Broj sati</th>
                </tr>
                <tbody>
                <?php $br=1; ?>
                    @foreach($takeModels as $m)
                        <tr>
                            <th scope="row"> {{ $br++ }}. </th>
                            <td style="text-align: left;"><a href="/profile/{{ $m['userId'] }}"> <img style="width: 30px;" src="/storage/{{$m['userProfileImage'] ?? '/profile/noimage.jpg'}}"> {{ $m['userName'] }} </a> </td>
                            <td > <a href="/v/{{ $m['volunteer']->id }}">  {{ $m['volunteer']->first_and_last_name }} </a>  </td>
                            <td> {{ $m['hours'] }} </td>
                        </tr>
                    @endforeach
                </tbody>
              </thead>
          </table>
          <hr>
          <center> <h5>  Volonteri sa najviše sati (TOP 10) </h5> </center> 
          <br>
          <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Br.</th>
                  <th scope="col">Organizacija</th>
                  <th scope="col">Broj akcija</th>
                  <th scope="col">Broj sati</th>
                </tr>
                <tbody>
                    <?php $br=1; ?>
                    @foreach($takeOrgHours as $orgHour)
                    <tr>
                        <th scope="row"> {{ $br++ }}. </th>
                        <td style="text-align: left;"> <a id="aNoneDecoration" href="/profile/{{ $orgHour['userId'] }}">  <img style="width: 30px;" src="/storage/{{ $orgHour['userImage'] ?? '/profile/noimage.jpg' }}"> {{ $orgHour['userName'] }} </a> </td>
                        <td> {{ $orgHour['postSum'] }} </td>
                        <td> {{ $orgHour['sumOrgHours']}} </td>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
                <hr>
                  <center> <h5>  Organizacije sa najviše sati (TOP 5) </h5> </center>

            </div>
        </div>

  

 
    </body>
</html>
