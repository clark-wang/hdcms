<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-user">
            @include('user.layouts._notification')
            @auth
                <div class="dropdown">
                    <a href="#" class="avatar avatar-sm avatar-online dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{auth()->user()->icon}}" class="avatar-img rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{route('member.user.edit',[auth()->user(),'type'=>'info'])}}" class="dropdown-item">修改资料</a>
                        <a href="{{route('member.user.show',auth()->id())}}" class="dropdown-item">个人空间</a>
                        @if(Auth::user()->is_admin)
                            <a href="{{route('admin.index')}}" class="dropdown-item">后台管理</a>
                        @endif
                        <hr class="dropdown-divider">
                        <a href="{{route('logout')}}" class="dropdown-item">退出</a>
                    </div>
                </div>
            @endauth
            @guest
                <a href="{{route('login')}}" class="btn btn-white btn-sm mr-3">
                    <span class="fe fe-log-in mr-1"></span> 登录
                </a>
                <a href="{{route('register')}}" class="btn btn-white btn-sm">
                    <span class="fe fe-user-plus mr-1"></span> 注册
                </a>
            @endguest
        </div>
        <div class="collapse navbar-collapse mr-auto order-lg-first" id="navbar">
            <form class="mt-4 mb-3 d-md-none">
                <input type="search" class="form-control form-control-rounded" placeholder="Search" aria-label="Search">
            </form>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <img src="/images/logo.png" alt="..." class="navbar-brand-img">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
