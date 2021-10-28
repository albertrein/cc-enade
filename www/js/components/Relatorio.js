class Relatorio{
    constructor(selector){
        this.componentSelector = selector;
        this.visibilidade = false;
    }
    show(){
        this.visibilidade = true;
        document.getElementById(this.componentSelector).style.display = 'block';
    }
    hide(){
        this.visibilidade = false;
        document.getElementById(this.componentSelector).style.display = 'none';
    }

    carregarRelatorio(){
        this.buscaListaQuestoesMaisErradas();
        return false;
    }

    buscaListaQuestoesMaisErradas(){
        let data = new FormData();
        data.append( "json", JSON.stringify({
            "curso" : this.getCurso()
        }));

        fetch("../src/Controller/QuestoesMaisErradas.php",{method: "POST",body: data}).then(response => {
            if(!response.ok){
                return false;
            }
            response.json().then(jsonData => {
                let labelsGrafico = [];
                let qtdErros = [];
                for(let i = 0; i < jsonData.length; i++){
                    labelsGrafico[i] = "Questão: " + jsonData[i].nrquestao + " - Ano: " + jsonData[i].ano;
                    qtdErros[i] = jsonData[i].erros;
                }
                criaGraficoBarrra(labelsGrafico, qtdErros, "canvasRelatorioQuestoesMaisErradas", "Erros");
            });
        })
    }
    
    getCurso(){
        if(localStorage.curso !== undefined){
            return localStorage.curso;
        }
        return "cc";
    }

}