const html = document.querySelector("html"),
	modal = document.querySelector("dialog"),
	openModal = document.querySelector("[name='open-modal']"),
	closeModal = document.querySelector("[name='close-modal'"),
	cards = document.querySelectorAll("article"),
	toCompare = [null, null]

modal.addEventListener("close", () => html.classList.remove("modal-is-open", "modal-is-opening"))

openModal.addEventListener("click", () => {
	html.classList.add("modal-is-open", "modal-is-opening")
	modal.showModal()
})

closeModal.addEventListener("click", () => modal.close())

cards.forEach(card => {
	card.addEventListener("mousedown", () => {
		if (toCompare[0] == card) {
			toCompare[0] = null;
			removeSelection()
			return;
		}

		card.setAttribute("class", "card-selected")

		if (toCompare[0] == null) toCompare[0] = card
		else {
			toCompare[1] = card
			compare()
			removeSelection()
			resetComparition()
		}
	})
})

function compare() {
	const firstBook = toCompare[0].dataset,
		secondBook = toCompare[1].dataset
	
	let output = [
		"Title: They are ",
		"Author: They are writed by ",
		`Number of Pages: ${firstBook.pages}`
	]

	output[0] += firstBook.title === secondBook.title ? "the same book" : "different books"
	output[1] += firstBook.author === secondBook.author? "the same author" : "different authors"
	output[2] += (
		+firstBook.pages > +secondBook.pages ? " > " :
		+firstBook.pages < +secondBook.pages ? " < " : " = "
	) + secondBook.pages
	
	alert(output.join("\n"))
}

function resetComparition() { toCompare[0] = null; toCompare[1] = null }

function removeSelection() {
	toCompare[0].removeAttribute("class")
	toCompare[1].removeAttribute("class")
}
