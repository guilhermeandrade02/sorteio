<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorteador</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="centralizar">
        <div class="mt-5 p-2 col-md-6 campos" style="">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="text-center">
                <img class="mt-2" src="{{ url('storage/logomarca.jpg') }}" alt="Sorteio" height="80"
                    width="auto">
            </div>
            <form method="POST" action="{{ route('gerador') }}">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <div class="form-group">
                                <label for="">O resultado terá quantos nomes?</label>
                                <input name="quantidade" class="form-control" placeholder="1"
                                    value="{{ old('quantidade', '1') }}">
                            </div> --}}
                            <div class="mt-5">
                                <textarea name="names" class="form-control" rows="10" placeholder="Digite os nomes aqui">
                                    @if (isset($names))
                                    {{ implode("\n", $names) }}
                                    @endif
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 text-center">
                    <div>
                        <button type="submit" class="btn btn-danger">SORTEAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (isset($ganhadores))
        <div class="modal fade custom-modal" id="resultadoModal" tabindex="-1" aria-labelledby="resultadoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center">
                            <div id="countdown" class="countdown-timer"></div>
                            <h1 class="color-text" id="parabens" style="display: none;">PARABÉNS</h1>
                            <div id="winnerNames"></div>
                        </div>
                    </div>
                    <div class="text-center mb-4 mt-5 modal-foo" id="closeButtonDiv" style="display: none;">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                            aria-label="Close">FECHAR</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.onload = function() {
                var myModal = new bootstrap.Modal(document.getElementById('resultadoModal'), {
                    keyboard: false
                });
                myModal.show();
                const countdownDisplay = document.getElementById('countdown');
                const parabens = document.getElementById('parabens');
                const winnerNames = document.getElementById('winnerNames');
                const closeButtonDiv = document.getElementById('closeButtonDiv');
                var secondsLeft = 5;

                function countdown() {
                    countdownDisplay.textContent = secondsLeft;
                    secondsLeft--;
                    if (secondsLeft >= 0) {
                        setTimeout(countdown, 1000);
                    } else {
                        countdownDisplay.style.display = 'none';
                        parabens.style.display = 'block';                       
                        displayWinnerNames();
                        closeButtonDiv.style.display = 'block';                        
                    }
                }
                countdownDisplay.style.display = 'inline-block';
                countdownDisplay.style.backgroundColor = 'green';
                countdownDisplay.style.color = 'white';
                countdownDisplay.style.fontSize = '35px';
                countdownDisplay.style.padding = '25px';
                countdownDisplay.style.width = '100px'; 
                countdownDisplay.style.height = '100px'; 
                countdownDisplay.style.borderRadius = '50%'; 
                countdownDisplay.style.marginTop = '30px';

                function displayWinnerNames() {
                    var winners = [
                        "<?php echo $ganhadores; ?>",
                    ];
                    var winnerNamesDiv = document.getElementById('winnerNames');
                    winners.forEach(function(winner) {
                        var winnerElement = document.createElement('h3');
                        winnerElement.textContent = winner;
                        winnerNamesDiv.appendChild(winnerElement);
                    });
                    const count = 200,
                        defaults = {
                            origin: {
                                y: 0.7
                            },
                            zIndex: 10000
                        };

                    function fire(particleRatio, opts) {
                        confetti(
                            Object.assign({}, defaults, opts, {
                                particleCount: Math.floor(count * particleRatio),
                            })
                        );
                    }

                    fire(0.25, {
                        spread: 26,
                        startVelocity: 55
                    });
                    fire(0.2, {
                        spread: 60
                    });
                    fire(0.35, {
                        spread: 100,
                        decay: 0.91,
                        scalar: 0.8
                    });
                    fire(0.1, {
                        spread: 120,
                        startVelocity: 25,
                        decay: 0.92,
                        scalar: 1.2
                    });
                    fire(0.1, {
                        spread: 120,
                        startVelocity: 45
                    });
                    setTimeout(() => {}, 2000);
                }
                countdown();
            };
        </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.2/tsparticles.confetti.bundle.min.js"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
