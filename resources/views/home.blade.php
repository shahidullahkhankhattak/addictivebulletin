<!DOCTYPE html >
<html lang="en" @php if($lang == 'ur') { @endphp dir="rtl" @php } @endphp>
    @include('inc.head')
<body class="pushable @if($story) no-scroll @endif">
    <style>
    .pre-loader{
        width:100%;height:100%;position:fixed;top:0;left:0;
        background: #f8f8f8;
        z-index:999999;
    }
    .pre-loader .img{
        height:200px;
        width:200px;
        position:absolute;
        top:0;left:0;bottom:0;right:0;margin:auto;
        transition: all .3s ease;
    }
    .pre-loader.slideup{
        transition: all .3s ease;
        transform: translate3d(0, -100%, 0);
    }
    </style>
    <div class="pre-loader">
        <div class="img">
            <img src="/public/images/pre_loader.gif" alt="addictive bulletin loader">
        </div>
        <script>
            $(document).ready(function(){
                $(".pre-loader").addClass("slideup");
            });
        </script>
    </div>
    <div id="app">
        @include('inc.sidebar.left')
        @include('inc.sidebar.right')
        @include('inc.topbar')
        @include('inc.home.content')
    </div>
    @include('inc.scripts')
</body>
</html>
