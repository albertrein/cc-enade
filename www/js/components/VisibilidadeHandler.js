class VisibilidadeHandler{
	constructor(){
		this.login = null;
		this.cadastro = null;
		this.questoes = null;
		this.ranking = null;
		this.inicio = null;
		this.menu = null;
	}

	setComponents(login, cadastro, questoes, ranking, inicio, menu, buscarQuestoes){
		this.login = login;
		this.cadastro = cadastro;
		this.questoes = questoes;
		this.ranking = ranking;
		this.inicio = inicio;
		this.menu = menu;
		this.buscarQuestoes = buscarQuestoes;
	}

	usuarioLogado(){
		this.mostrarQuestionario();
		this.menu.logarUsuario();
	}

	mostrarLogin(){
		this.login.show();
		this.cadastro.hide();
		this.questoes.hide();
		this.ranking.hide();
		this.inicio.hide();
		this.buscarQuestoes.hide();
	}

	mostrarCadastro(){
		this.cadastro.show();
		this.login.hide();
		this.questoes.hide();
		this.ranking.hide();
		this.inicio.hide();
		this.buscarQuestoes.hide();
	}

	mostrarQuestionario(){
		this.questoes.show();
		this.login.hide();
		this.cadastro.hide();
		this.ranking.hide();
		this.inicio.hide();
		this.buscarQuestoes.hide();
	}

	mostrarRanking(){
		this.ranking.show();
		this.questoes.hide();
		this.login.hide();
		this.cadastro.hide();
		this.inicio.hide();
		this.buscarQuestoes.hide();
	}

	mostrarInicio(){
		this.inicio.show();
		this.ranking.hide();
		this.questoes.hide();
		this.login.hide();
		this.cadastro.hide();
		this.buscarQuestoes.hide();
	}

	mostrarListaQuestoes(){
		this.buscarQuestoes.show();
		this.inicio.hide();
		this.ranking.hide();
		this.questoes.hide();
		this.login.hide();
		this.cadastro.hide();
	}
}