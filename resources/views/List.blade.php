@extends('index')

@section('title')
    @yield('title')
@endsection

@section('scripts')
    <script>
        function openDetail(a) {
            $(a).addClass('open');
            $(a).removeClass('closed');
            $(a).children('.orderDetail').show();
        }

        function closeDetail(a) {
            $(a).addClass('closed');
            $(a).removeClass('open');
            $(a).children('.orderDetail').hide();

        }

        $(document).ready(function() {
            $('.orderDetailLabel').on('click', function() {
                if ($(this).hasClass('closed')) {
                    openDetail(this);


                } else {
                    closeDetail(this);
                }
            })


        });
    </script>
@endsection


@section('main')
    <div class="mainHeader">
        <h1>
            @yield('header')
        </h1>
        @yield('addButton')
    </div>
    @yield('dictCard')
@endsection
