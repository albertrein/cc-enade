class Questions{
    constructor(selector, visibilidadeHandler, comentarios){
        this.componentSelector = selector;
        this.comentarios = comentarios;
        this.listaQuestoesVisualizadas = [];
        this.indiceQuestaoVisualizadaAtual = null;
    }

    hide(){
        this.visibilidade = false;
        document.getElementById(this.componentSelector).style.display = 'none';
        this.comentarios.hide();
    }

    show(){
        this.visibilidade = true;
        if(!this.isQuestaoAtiva()){
            this.buscarQuestao();
        }
        document.getElementById(this.componentSelector).style.display = 'block';
    }

    getRespostaDoUsuario(){ return document.querySelector('input[name="alternativa"]:checked').value; }

    buscarProximaQuestao(){
        if(this.listaQuestoesVisualizadas.length > 0){
            this.showBotaoVoltarQuestao();
        }
        if(this.indiceQuestaoVisualizadaAtual === null){
            this.buscarQuestao();
            return true;
        }
        this.indiceQuestaoVisualizadaAtual++;
        if(this.indiceQuestaoVisualizadaAtual == this.listaQuestoesVisualizadas.length){
            this.indiceQuestaoVisualizadaAtual = null;
            this.buscarQuestao();
            return true;
        }
        this.setQuestaoAtual(
            this.listaQuestoesVisualizadas[this.indiceQuestaoVisualizadaAtual]['questaoAtualId'],
            this.listaQuestoesVisualizadas[this.indiceQuestaoVisualizadaAtual]['questaoAtualAno'],
            this.listaQuestoesVisualizadas[this.indiceQuestaoVisualizadaAtual]['questaoAtualNumero'],
            this.listaQuestoesVisualizadas[this.indiceQuestaoVisualizadaAtual]['questaoDuvida']            
        );
        return true;
    }

    voltarQuestaoAnterior(){
        if(this.listaQuestoesVisualizadas.length === 0 || this.indiceQuestaoVisualizadaAtual === 0){
            this.hideBotaoVoltarQuestao();
            return false;
        }
        if(this.indiceQuestaoVisualizadaAtual - 1 === 0){
            this.hideBotaoVoltarQuestao();
        }else{
            this.showBotaoVoltarQuestao();
        }

        if(this.indiceQuestaoVisualizadaAtual === null){
            this.indiceQuestaoVisualizadaAtual = this.listaQuestoesVisualizadas.length - 2;
        }else{
            this.indiceQuestaoVisualizadaAtual--;
            if(this.indiceQuestaoVisualizadaAtual < 0){
                this.indiceQuestaoVisualizadaAtual = 0;
                return false;
            }            
        }

        this.setQuestaoAtual(
            this.listaQuestoesVisualizadas[this.indiceQuestaoVisualizadaAtual]['questaoAtualId'],
            this.listaQuestoesVisualizadas[this.indiceQuestaoVisualizadaAtual]['questaoAtualAno'],
            this.listaQuestoesVisualizadas[this.indiceQuestaoVisualizadaAtual]['questaoAtualNumero'],
            this.listaQuestoesVisualizadas[this.indiceQuestaoVisualizadaAtual]['questaoDuvida']            
        );
        return true;
    }

    showBotaoVoltarQuestao(){
        document.getElementById('botaoVoltarQuestao').style.display = "inline-flex";
    }

    hideBotaoVoltarQuestao(){
        document.getElementById('botaoVoltarQuestao').style.display = "none";
    }
    
    isQuestaoAtiva(){
        if(sessionStorage.questaoAtualAno === undefined || sessionStorage.questaoAtualAno == "" || sessionStorage.questaoAtualNumero === undefined || sessionStorage.questaoAtualNumero == ""){
            return false;
        }
        return true;
    }

    responder(){
        let dadosParaEnviar = {
            "respostaUsuario": this.getRespostaDoUsuario(),
            "emailUsuario": this.getUserEmail(),
            "ano" : sessionStorage.questaoAtualAno,
            "nrquestao" : sessionStorage.questaoAtualNumero
        };

        let data = new FormData();
        data.append( "json", JSON.stringify( dadosParaEnviar ) );

        fetch("../src/Controller/RespondeQuestionario.php",
        {
            method: "POST",
            body: data
        }).then((response) => {
            response.json().then(data => {
                if(data.resposta === this.getRespostaDoUsuario().toLocaleUpperCase()){
                    this.showSuccessMessage();
                }else{
                    this.showErrorMessage(data.resposta);
                    this.comentarios.buscaComentarios();
                }
                this.desabilitaBotaoResponder();
            })
        })
    }

    buscarQuestao(){
        fetch("../src/Controller/BuscaQuestao.php").then((response) => {
            response.json().then(data => {
                if(data.questaopk !== null && data.questaopk !== "" ){
                    this.setQuestaoAtual(data.questaopk, data.ano, data.nrquestao, data.duvida);
                    this.salvaQuestaoAtual();
                }else{
                   console.log('N Encontrado')
                }
            })
        })
    }

    insereDadosQuestao(){
        document.getElementById('questao_titulo').textContent = "Questão "+sessionStorage.questaoAtualNumero+" - "+sessionStorage.questaoAtualAno;
        document.getElementById('questao_imagem').src = "../imagens_questoes/"+sessionStorage.questaoAtualId+".png";
    }

    getUserEmail(){
        return localStorage.emailusuario === undefined ? "visitante" : localStorage.emailusuario; 
    }

    visualizarQuestao(questaoid, ano, numeroquestao, duvida){
        this.setQuestaoAtual(questaoid, ano, numeroquestao, duvida);
    }

    getQuestaoAtual(){
        let dadosQuestaoAtual = [];
        dadosQuestaoAtual['questaoAtualId'] = sessionStorage.questaoAtualId;
        dadosQuestaoAtual['questaoAtualAno'] = sessionStorage.questaoAtualAno;
        dadosQuestaoAtual['questaoAtualNumero'] = sessionStorage.questaoAtualNumero;
        dadosQuestaoAtual['questaoDuvida'] = sessionStorage.questaoDuvida;
        return dadosQuestaoAtual;
    }

    setQuestaoAtual(questaoid, ano, numeroquestao, duvida){
        sessionStorage.setItem('questaoAtualId', questaoid);
        sessionStorage.setItem('questaoAtualAno', ano);
        sessionStorage.setItem('questaoAtualNumero', numeroquestao);
        sessionStorage.setItem('questaoDuvida', duvida);
        this.insereDadosQuestao();
        this.habilitaBotaoResponder();
        this.removeAlternativaChecked();
        this.escondeMensagens();
        this.comentarios.hide();
    }

    showSuccessMessage(){
        document.getElementById('mensagem_sucesso').style.display = "block";
    }

    showErrorMessage(respostaCerta){
        document.getElementById('mensagem_erro').style.display = "block";
        document.getElementById('texto_mensagem_erro').textContent = "Sinto muito, resposta certa é: "+respostaCerta;
    }

    escondeMensagens(){
        document.getElementById('mensagem_sucesso').style.display = "none";
        document.getElementById('mensagem_erro').style.display = "none";
    }

    desabilitaBotaoResponder(){
        document.getElementById('botao_responder').style.pointerEvents = "none";
    }

    habilitaBotaoResponder(){
        document.getElementById('botao_responder').style.pointerEvents = "";
    }

    removeAlternativaChecked(){ try{document.querySelector('input[name="alternativa"]:checked').checked = false;}catch(exception){} }

    requisitarAjudaDoProfessor(){
        if(sessionStorage.questaoAtualId === undefined){
            return false;
        }
        let data = new FormData();        
        data.append( "json", JSON.stringify( {'numeroquestao': sessionStorage.questaoAtualId} ));

        fetch("../src/Controller/RequisitaAjuda.php", { method: "POST", body: data });
        return true;
    }

    salvaQuestaoAtual(){
        this.listaQuestoesVisualizadas.push(this.getQuestaoAtual());
    }

}