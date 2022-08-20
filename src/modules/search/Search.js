class Search {

    constructor() {
        this.openButton = jQuery(".js-search-trigger");
        this.closeButton = jQuery(".search-overlay__close");
        this.searchOverlay = jQuery(".search-overlay");
        this.events();
    }

    events() {
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
    }

    openOverlay() {
        this.searchOverlay.addClass("search-overlay--active");

    }

    closeOverlay() {
        this.searchOverlay.removeClass("search-overlay--active")
    }

}