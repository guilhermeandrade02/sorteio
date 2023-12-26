

const list = [];

let loadPage;
let inputValue = document.getElementById('input-list');
let tableList = document.getElementById('lista');
let writeWinner = document.getElementById('win');
let runEvent = document.getElementById('run-evento');
let novoPage = document.getElementById('novo');
let hideHeader = document.getElementById('resultado');
let hideParticipante = document.getElementById('participante');
// const isAlpha = /^[a-zA-Z() ]+$/;

inputValue.addEventListener("keypress", (e) => {
   if(e.key == "Enter"){
       clickMe();
  }
});

function clickMe(){
    if(inputValue.value ===""){
        alert("Nenhum nome para inserir")
    }
    // else if(!inputValue.value.match(isAlpha)){
    //     alert("Inválido");
    // }
    else{
        list.push(inputValue.value);
        let listValue = `<li> ${inputValue.value} </li>`;
        tableList.innerHTML += listValue;
        inputValue.value = "";
        inputValue.focus();
        hideParticipante.style.opacity = "1";
        hideHeader.style.opacity = "1";
        runEvent.style.opacity = "1";
    }

}

function resetBtn() {
    inputValue.value = "";
}

function randomGen() {
    const len = list.length;
  
    if (len < 1) {
        alert("Nenhum nome foi inserido");
    } else {
        function shuffle(array) {
            let currentIndex = array.length;
            let temporaryValue, randomIndex;    
            while (currentIndex !== 0) {
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex--;    
                temporaryValue = array[currentIndex];
                array[currentIndex] = array[randomIndex];
                array[randomIndex] = temporaryValue;
            }    
            return array;
        }    
        const shuffledList = shuffle(list.slice());     
        resultado = shuffledList[0];     
        writeWinner.innerHTML = `
            <div style="display:none;" id="winner" class="animate-bottom">
                <h2>Parabéns,</h2>
                <button type="button" class="btn meu-botao">${resultado}</button>
            </div>
        `;
        runEvent.style.opacity = "0";
        hideHeader.style.color = "transparent";

        // Função para criar confetes
        const count = 200,
            defaults = {
                origin: { y: 0.7 },
            };

        function fire(particleRatio, opts) {
            confetti(
                Object.assign({}, defaults, opts, {
                    particleCount: Math.floor(count * particleRatio),
                })
            );
        }

        // Função para disparar diferentes explosões de confete
        fire(0.25, {
            spread: 26,
            startVelocity: 55,
        });

        fire(0.2, {
            spread: 60,
        });

        fire(0.35, {
            spread: 100,
            decay: 0.91,
            scalar: 0.8,
        });

        fire(0.1, {
            spread: 120,
            startVelocity: 25,
            decay: 0.92,
            scalar: 1.2,
        });

        fire(0.1, {
            spread: 120,
            startVelocity: 45,
        });

        setTimeout(showPage, 2000);
    }
}

function showPage() {
  document.getElementById("winner").style.display = "block";
  novoPage.innerHTML = `
 
  <button  class="btn btn-primary" id="reload-btn" onClick="window.location.href=window.location.href">Novo Sorteio</button>`
  document.getElementById("reload-btn").style.opacity = "1";
}







