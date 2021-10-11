class Menu{
	constructor(idNomeUsuario, idImagemUsuario, questoesObj, visibilidadeHandler){
		this.idNomeUsuario = idNomeUsuario;
		this.idImagemUsuario = idImagemUsuario;
		this.questoesObj = questoesObj;
		this.visibilidadeHandler = visibilidadeHandler;
	}

	isUsuarioLogado(){
		if(localStorage.nomeusuario === undefined || localStorage.emailusuario === undefined || localStorage.nomeusuario === "" || localStorage.emailusuario === ""){
			return false;
		}
		return true;
	}

	logarUsuario(){
		if(localStorage.isprofessor == 1){
			this.mostrarNotificacoesProfessor();
			this.showNotification();
		}else{
			this.hideNotification();
		}
		this.showDeslogar();
		this.hideLogar();
		document.getElementById(this.idNomeUsuario).textContent = localStorage.nomeusuario;
		return false;
	}

	usuarioDeslogado(){
		this.showLogar();
		this.hideDeslogar();
		this.hideNotification();
		localStorage.setItem('nomeusuario', "");
        localStorage.setItem('emailusuario', "");
        localStorage.setItem('isprofessor', 0);
		document.getElementById(this.idNomeUsuario).textContent = "Visitante";
		return false;
	}

	showDeslogar(){
		document.getElementById('deslogar').style.display = 'block';
	}

	hideDeslogar(){
		document.getElementById('deslogar').style.display = 'none';
	}

	showLogar(){
		document.getElementById('logar').style.display = 'block';
	}

	hideLogar(){
		document.getElementById('logar').style.display = 'none';
	}

	hideNotification(){
		document.getElementById('notificationIcon').style.display = 'none';
	}

	showNotification(){
		document.getElementById('notificationIcon').style.display = 'flex';
	}

	mostrarNotificacoesProfessor(){
		document.getElementById('numero_requisicoes').textContent = "";
		document.querySelectorAll('.dropdown-item.d-flex.align-items-center').forEach(e => e.remove());
		
		fetch("../src/Controller/BuscarQuestoesEmAvaliacao.php").then(response => {
			if(response.status == 204){
				return false;
			}
			response.json().then(dadosJson => {
				this.geraItensNotificacao(dadosJson);
			})
		}).catch(_ => {
			return false;
		});
	}

	geraItensNotificacao(arrayDadosQuestoesParaNotificacoes){
		document.getElementById('numero_requisicoes').textContent = arrayDadosQuestoesParaNotificacoes.length;
		let elementoListaNotificacao = document.getElementById('lista_notificacao');
		arrayDadosQuestoesParaNotificacoes.forEach(questaoLinha => {
			let itemLista = document.createElement('a');
			itemLista.onclick = _ => {this.showQuestao(questaoLinha["questaopk"], questaoLinha["ano"], questaoLinha["nrquestao"], questaoLinha["duvida"])}
			itemLista.classList = "dropdown-item d-flex align-items-center";
			itemLista.innerHTML = '<div class="mr-3"><div class="icon-circle bg-warning"><i class="fas fa-exclamation-triangle text-white"></i></div></div>'+'Questão '+questaoLinha["nrquestao"]+' de '+questaoLinha["ano"];
			elementoListaNotificacao.appendChild(itemLista);
		});
	}

	showQuestao(questaopk, ano, nrquestao, duvida){
		this.visibilidadeHandler.mostrarQuestionario();
        this.questoesObj.visualizarQuestao(questaopk, ano, nrquestao, duvida);
	}

}