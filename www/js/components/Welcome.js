class Welcome{
    constructor(selector, visibilidadeHandler){
        this.componentSelector = selector;
        this.visibilidade = false;
        this.visibilidadeHandler = visibilidadeHandler;
    }

    hide(){
        this.visibilidade = false;
        document.getElementById(this.componentSelector).style.display = 'none';
    }

    show(){
        this.visibilidade = true;
        document.getElementById(this.componentSelector).style.display = 'block';
    }
}