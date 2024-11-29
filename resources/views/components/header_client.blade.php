<header class="header_main container-fluid p-0">
    <div class="container-fluid header_top">
        <div class="container header_top_wrap">
            <div class="row">
                <div class="logo col-6">
                        <img src="{{ asset('assets/img/photo_6215422185825222414_x-removebg-preview.png') }}" alt="">
                </div>

                <div class="menu_dropdow col-6" id="menuIcon">
                    <i class="fa-solid fa-bars"></i>
                </div>

                <div class="action col-6 d-flex justify-content-end align-items-center">
                    @if (Auth::check())
                        {{-- Kiểm tra nếu người dùng đã đăng nhập --}}
                        <div class=" account lienhe" style="margin-right: 20px">
                            <span>Liên hệ</span>
                        </div>
                        <div class="account">
                            <i class="fa-regular fa-user"></i>
                            <span>{{ Auth::user()->name }}</span> {{-- Hiển thị tên người dùng --}}
                        </div>
                        <div class="account">
                            <i class="fa-solid fa-coins"></i>
                            <span>{{ Auth::user()->coin }}</span> {{-- Hiển thị số coins hoặc thông tin khác --}}
                        </div>
                        <div class="account">
                            <span>
                                <a href="{{ route('client.logout') }}">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </a>
                            </span>
                        </div>
                    @else
                        {{-- Nếu chưa đăng nhập --}}
                        <div class="account">
                            <span><a href="{{ route('login') }}">Đăng nhập</a></span>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <div class="mobile_menu container" id="mobileMenu">
        <ul>
            @if (Auth::check())
                <li id="lienhe">
                    <span>Liên hệ</span>
                </li>
                <li>
                    <i class="fa-regular fa-user"></i>
                    <span>{{ Auth::user()->name }}</span>
                </li>
                <li>
                    <i class="fa-solid fa-coins"></i>
                    <span>{{ Auth::user()->coin }}</span>
                </li>
                <li>
                    <span>
                        <a style="color: white" href="{{ route('client.logout') }}">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    </span>
                </li>
            @else
                <li>
                    <span>Đăng Xuất</span>
                </li>
            @endif

        </ul>
    </div>

</header>

<script>
    const menuIcon = document.getElementById("menuIcon");
    const mobileMenu = document.getElementById("mobileMenu");
    const accountElement = document.querySelector('.lienhe');
    const accountidElement = document.getElementById('lienhe');

    accountidElement.addEventListener('click', function() {
        alert('Liên hệ admin để nhận thêm xu!');
    });

    accountElement.addEventListener('click', function() {
        alert('Liên hệ admin để nhận thêm xu!');
    });

    menuIcon.addEventListener("click", () => {
        mobileMenu.style.display = mobileMenu.style.display === "block" ? "none" : "block";
    });
</script>
