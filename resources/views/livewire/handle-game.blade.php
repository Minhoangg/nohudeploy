<div class="core_wrap container-fluid p-0">

    <div class="container">
        <div class="box_core">
            <div class="frame_core">
                <div class="frame_core_top d-flex justify-content-between">
                    <i onclick="goBack()" class="fa-solid fa-backward"></i>
                    <div class="name">
                        <div class="loading">
                            <span style="--i:1;"></span>
                            <span style="--i:2;"></span>
                            <span style="--i:3;"></span>
                            <span style="--i:4;"></span>
                            <span style="--i:5;"></span>
                            <span style="--i:6;"></span>
                            <span style="--i:7;"></span>
                            <span style="--i:8;"></span>
                            <span style="--i:9;"></span>
                            <span style="--i:10;"></span>
                        </div>
                    </div>

                    <div id="arrowAnim">
                        <div class="arrowSliding">
                            <div class="arrow"></div>
                        </div>
                        <div class="arrowSliding delay1">
                            <div class="arrow"></div>
                        </div>
                        <div class="arrowSliding delay2">
                            <div class="arrow"></div>
                        </div>
                        <div class="arrowSliding delay3">
                            <div class="arrow"></div>
                        </div>
                    </div>

                </div>

                <div class="frame_core_bottom d-flex">
                    <div class="frame_core_bottom_left">

                    </div>
                    <div class="frame_core_bottom_right">
                        <div class="frame_core_bottom_right_1">
                            <div class="name_core">
                                <svg viewBox="0 0 800 200" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: unset">
                                    <!-- Định nghĩa pattern cho chữ -->
                                    <defs>
                                        <pattern id="imagePattern" patternUnits="userSpaceOnUse" width="400"
                                            height="400">
                                            <image href="https://iili.io/2aZNbEJ.png" x="0" y="0" width="400"
                                                height="400" />
                                        </pattern>

                                        <!-- Định nghĩa glow filter -->
                                        <filter id="glowFilter" x="-50%" y="-50%" width="200%" height="200%">
                                            <feGaussianBlur in="SourceAlpha" stdDeviation="8" result="blurred" />
                                            <feOffset in="blurred" dx="0" dy="0"
                                                result="offsetBlurred" />
                                            <feFlood flood-color="cyan" result="glowColor" />
                                            <feComposite in="glowColor" in2="offsetBlurred" operator="in" />
                                            <feMerge>
                                                <feMergeNode />
                                                <feMergeNode in="SourceGraphic" />
                                            </feMerge>
                                        </filter>
                                    </defs>

                                    <!-- Text -->
                                    <text id="animatedText" x="50%" y="50%" dominant-baseline="middle"
                                        text-anchor="middle">{{ $nameGame }}</text>
                                </svg>

                            </div>
                            <div class="image">
                                <img src="{{ asset('storage/' . $imgGame) }}" alt="" width="80"
                                    height="80">
                            </div>
                            <div class="scan">
                                <div class="fingerprint"></div>
                                <h3>Đang Nhận Tỉ Lệ...</h3>
                            </div>
                            <div class="ratio_dt">
                                <div class="ring">
                                    <h1>{{ $percent ?? 0 }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="frame_core_bottom_right_2">
                            <canvas></canvas>
                            <div>
                                <div class="button-time" id="timeButton">{{ $startTime ?? 00 }} - {{ $endTime ?? 00 }}
                                </div>
                                <div class="button-secondary" id="round">round: {{ $min_ratio ?? 0 }}</div>
                            </div>

                        </div>
                        <div class="frame_core_bottom_right_3">
                            @if (!$hasReceivedRatio && !$disableReceiveButton)
                                <button class="neon-button" wire:click="handleClick()" id="saveToLocal">
                                    <span>Nhận Khung Giờ</span>
                                    <div class="glow-wrap">
                                        <div class="glow"></div>
                                    </div>
                                </button>
                            @elseif ($disableReceiveButton)
                                <button class="neon-button" disabled>
                                    <span>Không đủ coin</span>
                                    <div class="glow-wrap">
                                        <div class="glow"></div>
                                    </div>
                                </button>
                            @else
                                <button class="neon-button" disabled>
                                    <span>Đã nhận Khung Giờ</span>
                                    <div class="glow-wrap">
                                        <div class="glow"></div>
                                    </div>
                                </button>
                            @endif

                            <img src="{{ asset('assets/img/1_tmp.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="gameId" name="gameId" value="{{ $gameId }}">
    <input type="hidden" id="minRatio" name="min_ratio" value="{{ $min_ratio }}">
    <input type="hidden" id="maxRatio" name="max_ratio" value="{{ $max_ratio }}">
    <input type="hidden" id="percent" name="percent" value="{{ $percent }}">
    <input type="hidden" id="startTime" name="start_time" value="{{ $startTime }}">
    <input type="hidden" id="endTime" name="end_time" value="{{ $endTimeSave }}">
</div>

<script>
    window.addEventListener('load', function() {

        const gameId = document.getElementById('gameId').value;


        // Kiểm tra gameData trong localStorage cho gameId này
        const gameData = JSON.parse(localStorage.getItem('gameData_' + gameId));

        if (gameData) {

            // Lấy thời gian hiện tại
            const currentTime = new Date();
            // Lấy thời gian kết thúc đã lưu trong localStorage
            const storedEndTime = new Date(gameData.endTime);

            // So sánh thời gian kết thúc với thời gian hiện tại
            if (storedEndTime <= currentTime) {



                console.log('Thời gian đã kết thúc cho gameId: ');
            } else {

                // ráng giá trị round
                const minRatio = gameData.minRatio;
                // const maxRatio = gameData.maxRatio;

                const roundElement = document.getElementById('round');
                if (roundElement) {
                    roundElement.textContent = `round: ${minRatio}`;
                }

                // kết thúc ráng giá trị round

                //ráng giá trị phần trâm
                // const percent = gameData.percent;
                // const ringElement = document.querySelector('.ring h1');
                // if (ringElement) {
                //     ringElement.textContent = `${percent}%`;
                // }

                // kết thúc ráng giá trị phần trâm

                // ráng giá trị time
                const startTime = gameData.startTime;
                const endTime = gameData.endTime;

                const [startHour, startMinute] = startTime.split(':');

                const endTimeWithoutDate = endTime.split(' ')[1];
                const [endHour, endMinute] = endTimeWithoutDate.split(':');
                const timeButton = document.getElementById('timeButton');
                if (timeButton) {
                    timeButton.textContent = `${startHour}:${startMinute} - ${endHour}:${endMinute}`;
                }

                // kết thúc ráng giá trị time

                const saveButton = document.getElementById('saveToLocal');
                if (saveButton) {
                    saveButton.disabled = true;
                    saveButton.style.backgroundColor =
                        '#cccccc';
                    saveButton.style.cursor = 'not-allowed';
                }
                console.log('Thời gian chưa kết thúc cho gameId: ');
            }
        } else {
            console.log('Không tìm thấy dữ liệu game cho gameId: ');
        }
    });

    document.getElementById('saveToLocal').addEventListener('click', function() {
        const scanElement = document.querySelector('.scan');
        const ratioElement = document.querySelector('.ratio_dt');

        if (scanElement) {
            scanElement.style.display = 'block';
        }

        if (ratioElement) {
            ratioElement.style.display = 'none';
        }

        setTimeout(function() {
            if (scanElement) {
                scanElement.style.display = 'none';
            }

            if (ratioElement) {
                ratioElement.style.display = 'block';
            }
        }, 3000);

    });

    document.getElementById('saveToLocal').addEventListener('click', function() {

        setTimeout(function() {
            const gameId = document.getElementById('gameId').value;
            const minRatio = document.getElementById('minRatio').value;
            // const maxRatio = document.getElementById('maxRatio').value;
            // const percent = document.getElementById('percent').value;
            const startTime = document.getElementById('startTime').value;
            const endTime = document.getElementById('endTime').value;

            // Kiểm tra xem các giá trị có tồn tại trước khi lưu
            if (gameId && minRatio && percent && startTime && endTime) {
                const gameData = {
                    gameId: gameId,
                    minRatio: minRatio,
                    // maxRatio: maxRatio,
                    // percent: percent,
                    startTime: startTime,
                    endTime: endTime
                };

                localStorage.setItem('gameData_' + gameId, JSON.stringify(gameData));
            } else {
                console.error("Một số trường không có giá trị hợp lệ.");
            }
        }, 3500);
    });
</script>
