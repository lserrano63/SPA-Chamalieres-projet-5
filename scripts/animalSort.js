class AnimalSort {
	constructor() {
        this.cats = document.getElementById("chat");
        this.dogs = document.getElementById("chien");
        this.hamsters = document.getElementById("hamster");
        this.rats = document.getElementById("rat");
        this.rabbits = document.getElementById("lapin");
        this.parrots = document.getElementById("perroquet");
        this.fishes = document.getElementById("poisson");
        this.snakes = document.getElementById("serpent");
        this.mouses = document.getElementById("souris");
        this.turtles = document.getElementById("tortue");
        this.animals = document.querySelectorAll(".animals");
        this.all = document.getElementById("all");
        this.messageNoItem = document.getElementById("messageNoItem");
        
        this.initControls();
    } 

    sort(e){
        let hasfounditem = false;
        let filter = e.target.id;
        for (let item of this.animals) {
            if (item.dataset.animalType === filter || filter === "all") {
                hasfounditem = true;
                item.classList.remove("not_visible");
            } else {
                item.classList.add("not_visible");
            }
        }
        if (hasfounditem){
            this.messageNoItem.classList.add("not_visible");
        } else {
            this.messageNoItem.classList.remove("not_visible");
        }
    }



    initControls(){
        this.cats.addEventListener("click", this.sort.bind(this));
        this.all.addEventListener("click", this.sort.bind(this));
    }
}
var animalSort = new AnimalSort();