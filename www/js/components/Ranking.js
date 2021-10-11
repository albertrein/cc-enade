class Ranking{
    constructor(selector){
        this.componentSelector = selector;
        this.visibilidade = false;
    }
    show(){
        this.visibilidade = true;
        document.getElementById(this.componentSelector).style.display = 'block';
        this.buscaRanking();
    }
    hide(){
        this.visibilidade = false;
        document.getElementById(this.componentSelector).style.display = 'none';
    }

    buscaRanking(){
        fetch("../src/Controller/BuscaRanking.php").then(response => {
            if(!response.ok){
                alert('Usuarios não encontrados');
                return false;
            }
            response.json().then(jsonData => {
                let labelsGrafico = [];
                let pontuacaoGrafico = [];
                for(let i = 0; i < jsonData.length; i++){
                    labelsGrafico[i] = jsonData[i].nomeusuario;
                    pontuacaoGrafico[i] = jsonData[i].pontuacaousuario;
                }
                criaRankingBar(labelsGrafico, pontuacaoGrafico);
            });
        })
    }
}