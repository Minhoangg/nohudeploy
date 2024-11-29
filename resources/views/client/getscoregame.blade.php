@extends('layouts.client.master-layout')

@section('content')
    @livewire('handle-game', ['gameId' => $GameId])

    <script>
        let x = 0;

        const canvas = document.querySelector('canvas');
        const ctx = canvas.getContext('2d');
        let cw = canvas.width = window.innerWidth;
        let ch = canvas.height = window.innerHeight;

        function draw() {
            x += 4;

            ctx.beginPath();
            ctx.moveTo(x, ch / 2);
            ctx.lineTo(x, Math.random() * ch);
            ctx.strokeStyle = '#4CDC67';
            ctx.stroke();

            if (x > cw * 1.5) {
                x = 0;
                ctx.clearRect(0, 0, cw, ch);
            }
        }

        setInterval(draw, 30);

        draw();
    </script>

    <script>
        // js is for the animation loop for the strokes
        const textElement = document.getElementById("animatedText");

        function restartAnimation() {
            textElement.style.transition = "none";
            textElement.style.strokeDashoffset = "0";

            setTimeout(() => {
                textElement.style.transition = "stroke-dashoffset 3s ease";
                textElement.style.strokeDashoffset = "1000";
            }, 50);
        }

        // Start de animatie direct en in een loop
        restartAnimation();
        setInterval(restartAnimation, 10000);
    </script>
@endsection
