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
        this.animalsLength = this.animals.length;
        this.test = document.getElementById("all_animals");
        this.initControls();
    } 

    catsSort(){
        this.animals[this.animalsLength].classList.add("not_visible");
        if (!this.animals.hasAttribute("data-animal-type") && data-animal-type === "chat") {
            this.test.innerHTML = '<p>Rien n\'a été trouvé lors de votre recherche !</p>';
        } else {
            this.cats.classList.remove("not_visible");
        }
    }

    initControls(){
        this.cats.addEventListener("click", this.catsSort.bind(this));
    }
}
var animalSort = new AnimalSort();