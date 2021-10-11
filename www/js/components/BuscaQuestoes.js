class BuscaQuestoes{
	constructor(selector, questoesObj, visibilidadeHandler){
        this.componentSelector = selector;
        this.visibilidade = false;
        this.questoesObj = questoesObj;
        this.visibilidadeHandler = visibilidadeHandler;
    }

    hide(){
        this.visibilidade = false;
        document.getElementById(this.componentSelector).style.display = 'none';
    }

    show(){
    	document.getElementById(this.componentSelector).style.display = 'block';  	
        this.visibilidade = true;        
    }


    buscaListaDeQuestoes(){
        var elementoQuestaoBusca = document.getElementById('numeroQuestaoBuscaLista');
        if(elementoQuestaoBusca.value === ""){
            elementoQuestaoBusca = document.getElementById('numeroQuestaoBuscaListaMobile');           
        }
        let data = new FormData();
        data.append( "json", JSON.stringify({
            "numeroquestao" : elementoQuestaoBusca.value
        }));

        fetch("../src/Controller/BuscaListaQuestoes.php",
        {
            method: "POST",
            body: data
        }).then((response) => {
            if(response.status == 204){
                elementoQuestaoBusca.style.color = "red";
                return false;
            }
            response.json().then(data => {
                elementoQuestaoBusca.style.color = "#6e707e";
                this.montaCamposTabela(data);
                this.visibilidadeHandler.mostrarListaQuestoes();
            })
        })
    }

    montaCamposTabela(dados){
        let tbody = document.getElementById('listagemQuestoesCorpoTabela');
        tbody.innerHTML = '';
        let linhaTR = null;
        let primeiraColuna = null;
        let segundaColuna = null;
        let terceiraColuna = null;
        let imagemQuestao = null;
        for(let i = 0; i < dados.length; i++){
            linhaTR = document.createElement('tr');
            primeiraColuna = document.createElement('td');
            segundaColuna = document.createElement('td');
            terceiraColuna = document.createElement('td');
            imagemQuestao = document.createElement('img');
            imagemQuestao.onclick = () => {this.showQuestao(dados[i].questaopk, dados[i].ano, dados[i].nrquestao, dados[i].duvida)};
            imagemQuestao.src = "imagens_questoes/"+dados[i].questaopk+".png";
            primeiraColuna.append(imagemQuestao);
            segundaColuna.textContent = dados[i].nrquestao;
            terceiraColuna.textContent = dados[i].ano;
            linhaTR.append(primeiraColuna);
            linhaTR.append(segundaColuna);
            linhaTR.append(terceiraColuna);

            tbody.append(linhaTR);
        }
        return false;
    }

    showQuestao(questaopk, ano, nrquestao, duvida){
        this.visibilidadeHandler.mostrarQuestionario();
        this.questoesObj.visualizarQuestao(questaopk, ano, nrquestao, duvida);
    }

}
