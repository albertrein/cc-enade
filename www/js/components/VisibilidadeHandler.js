class VisibilidadeHandler{
	constructor(){
		this.componentes = [];
		this.login = null;
		this.cadastro = null;
		this.questoes = null;
		this.ranking = null;
		this.inicio = null;
		this.menu = null;
		this.relatorio = null;
	}

	setComponents(login, cadastro, questoes, ranking, inicio, menu, buscarQuestoes, relatorio){
		this.componentes["login"] = login;
		this.componentes["cadastro"] = cadastro;
		this.componentes["questoes"] = questoes;
		this.componentes["ranking"] = ranking;
		this.componentes["inicio"] = inicio;
		this.componentes["menu"] = menu;
		this.componentes["buscarQuestoes"] = buscarQuestoes;
		this.componentes["relatorio"] = relatorio;
	}

	usuarioLogado(){
		this.mostrarQuestionario(true);
		this.componentes.menu.logarUsuario();
	}

	async mostrarLogin(){
		await this.hideComponents();
		this.componentes["login"].show();
	}

	async mostrarCadastro(){
		await this.hideComponents();
		this.componentes["cadastro"].show();
	}

	async mostrarQuestionario(carregarNovaQuestao = false){
		await this.hideComponents();
		this.componentes["questoes"].show(carregarNovaQuestao);
	}

	async mostrarRanking(){
		await this.hideComponents();
		this.componentes["ranking"].show();
	}

	async mostrarInicio(){
		await this.hideComponents();
		this.componentes["inicio"].show();
	}

	async mostrarListaQuestoes(){
		await this.hideComponents();
		this.componentes["buscarQuestoes"].show();
	}

	async mostrarRelatorio(){
		await this.hideComponents();
		this.componentes["relatorio"].show();
	}

	hideComponents = async () => {
		return Promise.all(Object.entries(this.componentes).map(componentObject => {
			try{
				componentObject[1].hide();
			}catch(error){}			
		}))
	}
}