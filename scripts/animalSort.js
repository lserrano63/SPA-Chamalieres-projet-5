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
        this.buttons = document.querySelectorAll(".btn");
        this.initControls();
    } 

    sort(e){ // sort the animals
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
        if (hasfounditem){ //if the sort find one animal or more we hide the section
            this.messageNoItem.classList.add("not_visible");
        } else {
            this.messageNoItem.classList.remove("not_visible");
        }
    }

    activeButton(e){ // Change CSS for the active button / One button can be active at the same time
        for (let btn of this.buttons) {
            if (btn.classList.contains("activeButton")) {
                btn.classList.remove("activeButton");
            }
        }
        e.target.classList.add("activeButton");
    }

    initControls(){
        this.cats.addEventListener("click", this.sort.bind(this));
        this.cats.addEventListener("click", this.activeButton.bind(this));
        this.dogs.addEventListener("click", this.sort.bind(this));
        this.dogs.addEventListener("click", this.activeButton.bind(this));
        this.hamsters.addEventListener("click", this.sort.bind(this));
        this.hamsters.addEventListener("click", this.activeButton.bind(this));
        this.rats.addEventListener("click", this.sort.bind(this));
        this.rats.addEventListener("click", this.activeButton.bind(this));
        this.rabbits.addEventListener("click", this.sort.bind(this));
        this.rabbits.addEventListener("click", this.activeButton.bind(this));
        this.parrots.addEventListener("click", this.sort.bind(this));
        this.parrots.addEventListener("click", this.activeButton.bind(this));
        this.fishes.addEventListener("click", this.sort.bind(this));
        this.fishes.addEventListener("click", this.activeButton.bind(this));
        this.snakes.addEventListener("click", this.sort.bind(this));
        this.snakes.addEventListener("click", this.activeButton.bind(this));
        this.mouses.addEventListener("click", this.sort.bind(this));
        this.mouses.addEventListener("click", this.activeButton.bind(this));
        this.turtles.addEventListener("click", this.sort.bind(this));
        this.turtles.addEventListener("click", this.activeButton.bind(this));
        this.all.addEventListener("click", this.sort.bind(this));
        this.all.addEventListener("click", this.activeButton.bind(this));
    }
}
var animalSort = new AnimalSort();