let removeItem = document.querySelectorAll('.remove');

let cafeteriaButton = document.querySelector('.cafeteria');
let cafeteriaModal = document.querySelector('.modal-cafeteria');
let buttonDisplayNoneModalCafeteria = document.querySelector('.cancel');

cafeteriaButton.addEventListener('click', e => {
	cafeteriaModal.classList.remove('display-none')
});
buttonDisplayNoneModalCafeteria.addEventListener('click', e => {
	cafeteriaModal.classList.add('display-none')
});

removeItem.forEach((btn) =>{
	btn.addEventListener('click', function() {
		confirm('es tu sur de vouloir supprimer cette objet ?');
	})
})