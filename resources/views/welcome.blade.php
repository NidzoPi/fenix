
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
                padding-top: 100px;
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
    <div class="container">
        <div class="flex-center position-ref full-height">


            <div class="top-right links"> <img class="logo" src="/storage/logo/republic_of_srpska.png"> </div>

            <div class="content">
                <div class="pd d-flex pl-5 align-items-center">
                    <div class="pl-5"> Organizacija: {{ $sumOfUsers }} </div>
                    <div class="pl-5"> Akcija: {{ $sumOfPosts }} </div>
                    <div class="pl-5"> Sati: {{ $sumOfHours }} </div>
                    <div class="pl-5">  </div>
                    <div class="pd1 pl-5"> <img id="volunteerImage" src="/storage/volunteers/volunteer.png"> = {{ $sumOfVolunteers }} </div>
                </div>


                <div class="title m-b-md">
                    I mi gradimo Srpsku!
                </div>

                <div class="links">
                    @if (Route::has('login'))
                    @auth
                        <a href="/profile/{{Auth::user()->id}}" class="btn btn-danger btn-lg" role="button">MOJ PROFIL</a>
                        <a href="/v/all" class="btn btn-primary btn-lg" role="button">VOLONTERI</a>
                    @else
                        <a class="btn btn-success btn-lg" href="{{ route('login') }}" role="button">Prijava</a>
                     @if (Route::has('register'))
                        <a class="btn btn-info btn-lg" href="{{ route('register') }}" role="button">Registracija</a>
                </div>
                    <small> Prijava i registracija samo za organizatore volonterskih akcija! </small>
                    @endif
                    @endauth
                    @endif
                
                <hr>
                <div class="d-flex align-items-center">
                    @foreach ($userModels as $model)
                    <a href="/profile/{{ $model['id'] }}">
                        <div class="image pl-2">  
                            <img src = "/storage/{{ $model['image'] ?? '/profile/noimage.jpg'}}" class="rounded-circle w-100" style="max-width: 50px;">
                            <span class="overlay">{{ $model['title'] }}</span>  
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
                            <td style="text-align: left;"><a href="/profile/{{ $m['userId'] }}"> <img style="width: 30px;" src="/storage/{{$m['userProfileImage']}}"> {{ $m['userName'] }} </a> </td>
                            <td > <a href="/v/{{ $m['volunteer']->id }}">  {{ $m['volunteer']->first_and_last_name }} </a>  </td>
                            <td> {{ $m['hours'] }} </td>
                        </tr>
                    @endforeach
                </tbody>
              </thead>
          </table>
          <hr>
          <h5>  Volonteri sa najviše sati (TOP 10) </h5> <br>
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
                        <td style="text-align: left;"> <a id="aNoneDecoration" href="/profile/{{ $orgHour['userId'] }}">  <img style="width: 30px;" src="/storage/{{ $orgHour['userImage'] }}"> {{ $orgHour['userName'] }} </a> </td>
                        <td> {{ $orgHour['postSum'] }} </td>
                        <td> {{ $orgHour['sumOrgHours']}} </td>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
                <hr>
                  <h5>  Organizacije sa najviše sati (TOP 5) </h5>

            </div>
        </div>
      </div>
  

 
    </body>
</html>
