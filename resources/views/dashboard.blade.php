<x-app-layout>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <x-slot name="header">
    </x-slot>
    <br>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <style>
            .roundbtn-big {
                position: absolute;
                height: 70px;
                padding: 10px 16px;
                border-radius: 35px;
                font-size: 24px;
                line-height: 1.33;
            }
            .roundbtn {
                position: absolute;
                width: 50px;
                height: 50px;
                padding: 7px 10px;
                border-radius: 25px;
                font-size: 10px;
                text-align: center;
            }
        </style>
        <button type="button" class="btn btn-info roundbtn" data-toggle="modal" data-target="#createPosteo">
            <span class="material-icons">
                create
            </span>
        </button>
        @foreach ($posteos as $posteo)
            <div class="py-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-5 bg-white border-b border-gray-200">
                            <b>
                                {{ $posteo->alias_usuario }}
                            </b>
                            - {{ $posteo->topico()->first()->nombre }}
                            <div class="bg-white overflow-hidden sm:rounded-lg">
                                <div class="p-2 bg-white">
                                    {{ $posteo->titulo }}
                                    <br>
                                    <br>
                                    &nbsp;
                                    {{ $posteo->contenido }}

                                </div>
                                <form method="POST">
                                @csrf
                                    <button href="{{action('PostController@addLike',[$posteo])}}" type="submit">
                                    #<button href="{{route('dashboard',[])}}" type="submit">
                                        <span class="material-icons" style='padding-right: 20px'>
                                            thumb_up_off_alt
                                        </span>
                                    </button>
                                </form>
                                 <span class="material-icons" style='padding-right: 20px'>
                                            delete
                                </span>
                                <span class="material-icons" style='padding-right: 20px'>
                                            report_problem
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
@include('createPosteo', $topicos);
