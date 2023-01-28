const html = document.querySelector("html"),
	modal = document.querySelector("dialog"),
	openModal = document.querySelector("[name='open-modal']"),
	closeModal = document.querySelector("[name='close-modal'"),
	cards = document.querySelectorAll("article")

modal.addEventListener("close", () => html.classList.remove("modal-is-open", "modal-is-opening"))

openModal.addEventListener("click", () => {
	html.classList.add("modal-is-open", "modal-is-opening")
	modal.showModal()
})

closeModal.addEventListener("click", () => modal.close())
