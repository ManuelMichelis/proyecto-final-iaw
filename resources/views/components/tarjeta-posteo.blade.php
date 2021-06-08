
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
                    &nbsp;
                    <!--{{ $posteo->contenido }}-->

                </div>
                <div style="padding:5px"></div>
                <div style="padding:8px; border-top:1px solid #ddd" class="col-md-12"></div>
                <div class="row container">
                    <form method="POST">
                        @csrf
                        <button href="{{action('PostController@addLike',[$posteo])}}" type="submit">
                            <!--button href="{{route('dashboard',[])}}" type="submit"-->
                                <span class="material-icons" style='padding-right: 20px'>
                                    thumb_up_off_alt
                                </span>
                        </button>
                    </form>
                    <form method="POST">
                        @csrf
                        <button href="#" type="submit">
                            <span class="material-icons" style='padding-right: 20px'>
                                        delete
                            </span>
                        </button>
                    </form>
                    <form method="POST">
                        @csrf
                        <button href="#" type="submit">
                            <span class="material-icons" style='padding-right: 20px'>
                                        report_problem
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
