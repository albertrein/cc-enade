class Comentarios{
	constructor(selector){
        this.componentSelector = selector;
        this.visibilidade = false;
    }

    hide(){
        this.visibilidade = false;
        document.getElementById(this.componentSelector).style.display = 'none';
    }

    show(){
    	document.getElementById(this.componentSelector).style.display = 'block';  	
        this.visibilidade = true;        
    }

    showComentariosVazios(){
        document.getElementById('sem_comentarios').style.display = 'block'; 
    }

    hideComentariosVazios(){
        document.getElementById('sem_comentarios').style.display = 'none'; 
    }

    showNovoComentario(){
        document.getElementById('container_novo_comentario').style.display = 'flex';
        if(this.isProfessor() && this.isDuvida()){
            document.getElementById('duvida_respondida').style.display = 'block';
            return true;
        }
        document.getElementById('duvida_respondida').style.display = 'none';            
        return true;
    }

    hideNovoComentario(){
        document.getElementById('container_novo_comentario').style.display = 'none'; 
    }

    isProfessor(){
        if(localStorage.isprofessor == 1){
            return true;
        }
        return false;
    }

    isDuvida(){
        if(sessionStorage.questaoDuvida == 1){
            return true;
        }
        return false;
    }

    isUsuarioLogado(){
        if(localStorage.nomeusuario === undefined || localStorage.emailusuario === undefined || localStorage.nomeusuario === "" || localStorage.emailusuario === ""){
            return false;
        }
        return true;
    }

    buscaComentarios(){
        if(this.isUsuarioLogado()){
            this.showNovoComentario();
        }else{
            this.hideNovoComentario();
        }
    	var dadosParaEnviar = {
            "idquestao": sessionStorage.questaoAtualId
        };
        var data = new FormData();
        data.append( "json", JSON.stringify( dadosParaEnviar ) );

    	fetch("../src/Controller/BuscaComentarios.php", {
            method: "POST",
            body: data
        }).then((response) => {
            this.show();
        	if(!response.ok){
                this.showComentariosVazios();
                return false;
            }
            response.json().then(data => {
                this.hideComentariosVazios();
                this.removeComentariosAntigos();
                this.apresentaComentarios(data);
            })
        });
    }

    limpaSubElementoComentarios(){document.querySelector('#comentarios > div > div').innerHTML = "";}

    removeComentariosAntigos(){
        if(document.querySelectorAll('.col-xl-6.col-md-6.mb-4').length > 0){
            document.querySelectorAll('.col-xl-6.col-md-6.mb-4').forEach(e => e.remove());
        }
    }

    apresentaComentarios(listaComentarios){
    	let subElementoComentarios = document.querySelector('#comentarios > div > div');
        for(let i = 0; i < listaComentarios.length; i++){
            subElementoComentarios.appendChild(this.criaComentario(listaComentarios[i].nomeUsuario,listaComentarios[i].mensagem));
        }
    }

    criaComentario(nomeUsuario, mensagem){
    	let primeiraDiv = document.createElement('div');
    	primeiraDiv.className = "col-xl-6 col-md-6 mb-4";

    	let corpoComentario = '<div class="card border-left-primary shadow h-100 py-2"><div class="card-body"><div class="row no-gutters align-items-center"><div class="col mr-2"><div id="comentario_usuario" class="text-xs font-weight-bold text-primary text-uppercase mb-1"></div><div id="comentario_mensagem" class="h7 mb-0 text-gray-800"></div></div></div></div></div>';
    
		primeiraDiv.innerHTML = corpoComentario;
		primeiraDiv.querySelector('#comentario_usuario').textContent = nomeUsuario;
		primeiraDiv.querySelector('#comentario_mensagem').textContent = mensagem;
    	
    	return primeiraDiv;
    }

    limpaCampoComentario(){
    	document.getElementById('comentario_nova_mensagem').value = "";
    }

    limpaCampoDuvida(){
       document.querySelector('#duvida_respondida input').checked = false;
    }

    getNovaMensagem(){
    	return document.getElementById('comentario_nova_mensagem').value;
    }

    getDuvidaRespondida(){
        let elementoCheckboxDuvidaRespondida = document.querySelector('#duvida_respondida input');
        if(elementoCheckboxDuvidaRespondida.checked === true){
            return 0;
        }
        return 1;
    }

    salvarNovoComentario(){
    	let dadosParaEnviar = {
            "idquestao": sessionStorage.questaoAtualId,
            "emailUsuario": localStorage.emailusuario,
            "novaMensagem": this.getNovaMensagem()
        };
        if(this.isDuvida() && this.isProfessor()){
            dadosParaEnviar["duvida"] = this.getDuvidaRespondida();
        }
        
        let data = new FormData();
        data.append( "json", JSON.stringify( dadosParaEnviar ) );

    	fetch("../src/Controller/SalvaNovoComentario.php", {
            method: "POST",
            body: data
        }).then((response) => {
        	if(response.status != 204){
                this.buscaComentarios();
            }
            this.limpaCampoComentario();
            this.limpaCampoDuvida();
        });
    }
}