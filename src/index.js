import axios from 'axios';

class Search {
  constructor() {
    this.addSearchHTML()
    this.resultsDiv = document.querySelector("#search-overlay__results")
    this.openButton = document.querySelectorAll(".js-search-trigger")
    this.closeButton = document.querySelector(".search-overlay__close")
    this.searchOverlay = document.querySelector(".search-overlay")
    this.searchField = document.querySelector("#search-term")
    this.isOverlayOpen = false
    this.isSpinnerVisible = false
    this.previousValue
    this.typingTimer
    this.events()
  }

  events() {
    this.openButton.forEach(el => {
      el.addEventListener("click", e => {
        e.preventDefault()
        this.openOverlay()
      })
    })

    this.closeButton.addEventListener("click", () => this.closeOverlay())
    document.addEventListener("keydown", e => this.keyPressDispatcher(e))
    this.searchField.addEventListener("keyup", () => this.typingLogic())
  }

  typingLogic() {
    if (this.searchField.value != this.previousValue) {
      clearTimeout(this.typingTimer)

      if (this.searchField.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="spinner-loader"></div>'
          this.isSpinnerVisible = true
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750)
      } else {
        this.resultsDiv.innerHTML = ""
        this.isSpinnerVisible = false
      }
    }

    this.previousValue = this.searchField.value
  }

  async getResults() {

    try {
      const response = await axios.get("https://agavecasa.com.br/index.php/wp-json/agavecasa/v1/search?term=" + this.searchField.value)
      const results = response.data
      this.resultsDiv.innerHTML = `
              <div class="row">
                <div class="one-third">
                  <h2 class="search-overlay__section-title">Geral</h2>
                  ${results.generalInfo.length ? '<ul class="link-list min-list">' : "<p>Nenhum resultado foi encontrado. Tente novamente com outro termo.</p>"}
                    ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == "post" ? `by ${item.authorName}` : ""}</li>`).join("")}
                  ${results.generalInfo.length ? "</ul>" : ""}
                </div>
                
                <div class="one-third">
                  <h2 class="search-overlay__section-title">Produtos</h2>
                  ${results.products.length ? '<ul class="link-list min-list">' : `<p>Nenhum produto encontrado. <a href="https://agavecasa.com.br/loja">Ver todos produtos.</a></p>`}
                    ${results.products.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join("")}
                  ${results.products.length ? "</ul>" : ""}
                </div>
              </div>
            `
      this.isSpinnerVisible = false
    } catch (e) {
      console.log(e)
    }
  }

  keyPressDispatcher(e) {
    if (e.keyCode == 83 && !this.isOverlayOpen && document.activeElement.tagName != "INPUT" && document.activeElement.tagName != "TEXTAREA") {
      this.openOverlay()
    }

    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay()
    }
  }

  openOverlay() {
    this.searchOverlay.classList.add("search-overlay--active")
    document.body.classList.add("body-no-scroll")
    this.searchField.value = ""
    setTimeout(() => this.searchField.focus(), 301)
    this.isOverlayOpen = true
    return false
  }

  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active")
    document.body.classList.remove("body-no-scroll")
    this.isOverlayOpen = false
  }

  addSearchHTML() {
    document.body.insertAdjacentHTML(
      "beforeend",
      `
            <div class="search-overlay">
              <div class="search-overlay__top">
                <div class="container container-overlay">
                  <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                  <input type="text" class="search-term" placeholder="Digite o termo de busca..." id="search-term">
                  <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
                </div>
              </div>
              
              <div class="container">
                <div id="search-overlay__results"></div>
              </div>
      
            </div>
          `
    )
  }
}

const search = new Search(axios)